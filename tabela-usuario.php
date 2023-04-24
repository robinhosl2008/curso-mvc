<?php

declare(strict_types=1);

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new \PDO("sqlite:{$dbPath}");

// $sqlUsuario = "
//     CREATE TABLE users (
//         id INTEGER PRIMARY KEY,
//         email TEXT,
//         password TEXT
//     );
// ";

// $statement = $pdo->exec($sqlUsuario);

// $email = $argv[1];
// $password = $argv[2];
// $hash = password_hash($password, PASSWORD_ARGON2ID);

// $sqlUserInsert = "INSERT INTO users (email, password) VALUES (?, ?);";
// $statement = $pdo->prepare($sqlUserInsert);
// $statement->bindValue(1, $email);
// $statement->bindValue(2, $hash);
// $statement->execute();

// $sqlDeleteUser = "DELETE FROM users WHERE id > 0;";
// $pdo->exec($sqlDeleteUser);

$stmt = $pdo->query('SELECT * FROM users;');
$users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

var_dump($users);