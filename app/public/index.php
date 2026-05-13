<?php

use Slim\Factory\AppFactory;
use Slim\Psr7\Response;
use App\GameService;
use App\PhpConcepts;

require __DIR__ . '/../vendor/autoload.php';

session_start();

if (!isset($_SESSION['game_id'])) {
    $_SESSION['game_id'] = bin2hex(random_bytes(16));
}

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// Home - render game board
$app->get('/', function ($request, $response) {
    $sessionId = $_SESSION['game_id'];
    $service = new GameService();
    $game = $service->getOrCreateGame($sessionId);
    $concepts = PhpConcepts::getAll();
    $conceptMap = array_column($concepts, null, 'id');

    ob_start();
    require __DIR__ . '/../src/views/game.php';
    $html = ob_get_clean();

    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});

// Flip a card
$app->post('/flip/{row}/{col}', function ($request, $response, $args) {
    $sessionId = $_SESSION['game_id'];
    $service = new GameService();
    $result = $service->flipCard($sessionId, (int)$args['row'], (int)$args['col']);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

// Unflip unmatched cards
$app->post('/unflip', function ($request, $response) {
    $sessionId = $_SESSION['game_id'];
    $service = new GameService();
    $result = $service->unflipUnmatched($sessionId);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json');
});

// Reset game
$app->post('/reset', function ($request, $response) {
    $sessionId = $_SESSION['game_id'];
    $service = new GameService();
    $service->resetGame($sessionId);

    return $response->withHeader('Location', '/')->withStatus(302);
});

$app->run();
