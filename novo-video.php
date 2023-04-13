<?php

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$statemant = $pdo->prepare("INSERT INTO videos (url, title) VALUES (?, ?);");
$statemant->bindValue(1, $_POST['url']);
$statemant->bindValue(2, $_POST['titulo']);

if ($statemant->execute() === true) {
    header("location: /index.php?success=true");
} else {
    header("location: /index.php?success=false");
}