<?php

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$dbSql = "
    CREATE TABLE IF NOT EXISTS videos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        url TEXT,
        title TEXT
    );
";
$statemant = $pdo->prepare($dbSql);
$statemant->execute();