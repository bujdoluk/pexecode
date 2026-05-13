<?php

namespace App;

use PDO;

class Database
{
    private static ?PDO $instance = null;

    public static function get(): PDO
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                'pgsql:host=%s;port=%s;dbname=%s',
                $_ENV['DB_HOST'] ?? 'postgres',
                $_ENV['DB_PORT'] ?? '5432',
                $_ENV['DB_NAME'] ?? 'pexeso'
            );
            self::$instance = new PDO(
                $dsn,
                $_ENV['DB_USER'] ?? 'pexeso',
                $_ENV['DB_PASS'] ?? 'pexeso',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$instance;
    }
}
