<?php

declare(strict_types=1);

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$pdo->exec("ALTER TABLE videos ADD COLUMN imagePath TEXT;");