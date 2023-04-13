<?php

$id = $_GET['id'];

if ($_GET['id']) {
    $dbPath = __DIR__ . "/db.sqlite";
    $pdo = new PDO("sqlite:{$dbPath}");

    $sql = "DELETE FROM videos WHERE id = ?;";
    $statemant = $pdo->prepare($sql);
    $statemant->bindValue(1, $id);

    if ($statemant->execute() === true) {
        header("location: /index.php?success=true");
    } else {
        header("location: /index.php?success=false");
    }
} else {
    throw new InvalidArgumentException("ID do vídeo não informado.");
}