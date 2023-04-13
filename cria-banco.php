<?php

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$dbSql = "
    CREATE TABLE videos (
        id INTEGER PRIMARY KEY,
        url TEXT,
        title TEXT
    );
";