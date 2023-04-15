<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("location: /?success=false");
    exit();
}

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$sql = "DELETE FROM videos WHERE id = ?;";
$statemant = $pdo->prepare($sql);
$statemant->bindValue(1, $id);

if ($statemant->execute() === true) {
    header("location: /?success=true");
    exit();
}

header("location: /?success=false");