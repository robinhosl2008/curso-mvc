<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("location: /index.php?success=false");
    exit();
}

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$sql = "DELETE FROM videos WHERE id = ?;";
$statemant = $pdo->prepare($sql);
$statemant->bindValue(1, $id);

if ($statemant->execute() === true) {
    header("location: /index.php?success=true");
    exit();
}

header("location: /index.php?success=false");