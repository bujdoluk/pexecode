<?php

namespace App;

use PDO;

class GameService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::get();
    }

    public function getOrCreateGame(string $sessionId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM games WHERE session_id = ?');
        $stmt->execute([$sessionId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $row['board'] = json_decode($row['board'], true);
            return $row;
        }

        return $this->createGame($sessionId);
    }

    private function createGame(string $sessionId): array
    {
        $all = PhpConcepts::getAll();
        shuffle($all);
        $concepts = array_slice($all, 0, 50); // 50 random concepts × 2 copies = 100 cards
        $cards = [];
        foreach ($concepts as $concept) {
            for ($i = 0; $i < 2; $i++) {
                $cards[] = [
                    'concept_id' => $concept['id'],
                    'flipped' => false,
                    'matched' => false,
                ];
            }
        }
        shuffle($cards);

        // Build 10x10 grid
        $board = [];
        $idx = 0;
        for ($r = 0; $r < 10; $r++) {
            $board[$r] = [];
            for ($c = 0; $c < 10; $c++) {
                $board[$r][$c] = $cards[$idx++];
            }
        }

        $stmt = $this->db->prepare(
            'INSERT INTO games (session_id, board, score, moves) VALUES (?, ?, 0, 0) RETURNING *'
        );
        $stmt->execute([$sessionId, json_encode($board)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row['board'] = json_decode($row['board'], true);
        return $row;
    }

    public function flipCard(string $sessionId, int $row, int $col): array
    {
        $game = $this->getOrCreateGame($sessionId);
        $board = $game['board'];
        $score = (int)$game['score'];
        $moves = (int)$game['moves'];

        $card = &$board[$row][$col];

        if ($card['matched'] || $card['flipped']) {
            return ['status' => 'noop', 'game' => $game];
        }

        // Count currently flipped (not matched)
        $flippedCards = [];
        for ($r = 0; $r < 10; $r++) {
            for ($c = 0; $c < 10; $c++) {
                if ($board[$r][$c]['flipped'] && !$board[$r][$c]['matched']) {
                    $flippedCards[] = ['r' => $r, 'c' => $c];
                }
            }
        }

        if (count($flippedCards) >= 2) {
            return ['status' => 'max_flipped', 'game' => $game];
        }

        $card['flipped'] = true;
        $flippedCards[] = ['r' => $row, 'c' => $col];

        $matched = false;
        $unflipAll = false;

        if (count($flippedCards) === 2) {
            $moves++;
            $a = $flippedCards[0];
            $b = $flippedCards[1];
            $conceptA = $board[$a['r']][$a['c']]['concept_id'];
            $conceptB = $board[$b['r']][$b['c']]['concept_id'];

            if ($conceptA === $conceptB) {
                $board[$a['r']][$a['c']]['matched'] = true;
                $board[$b['r']][$b['c']]['matched'] = true;
                $score++;
                $matched = true;
            } else {
                $unflipAll = true;
            }
        }

        $this->saveGame($sessionId, $board, $score, $moves);

        $concepts = PhpConcepts::getAll();
        $conceptMap = array_column($concepts, null, 'id');

        return [
            'status' => 'ok',
            'matched' => $matched,
            'unflip_after' => $unflipAll,
            'score' => $score,
            'moves' => $moves,
            'card' => [
                'row' => $row,
                'col' => $col,
                'concept' => $conceptMap[$card['concept_id']],
            ],
            'board' => $board,
        ];
    }

    public function unflipUnmatched(string $sessionId): array
    {
        $game = $this->getOrCreateGame($sessionId);
        $board = $game['board'];

        for ($r = 0; $r < 10; $r++) {
            for ($c = 0; $c < 10; $c++) {
                if ($board[$r][$c]['flipped'] && !$board[$r][$c]['matched']) {
                    $board[$r][$c]['flipped'] = false;
                }
            }
        }

        $this->saveGame($sessionId, $board, $game['score'], $game['moves']);
        return ['status' => 'ok', 'board' => $board];
    }

    public function resetGame(string $sessionId): array
    {
        $stmt = $this->db->prepare('DELETE FROM games WHERE session_id = ?');
        $stmt->execute([$sessionId]);
        return $this->createGame($sessionId);
    }

    private function saveGame(string $sessionId, array $board, int $score, int $moves): void
    {
        $stmt = $this->db->prepare(
            'UPDATE games SET board = ?, score = ?, moves = ?, updated_at = NOW() WHERE session_id = ?'
        );
        $stmt->execute([json_encode($board), $score, $moves, $sessionId]);
    }
}
