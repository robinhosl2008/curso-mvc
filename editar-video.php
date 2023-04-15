<?php

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id !== false) {
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    $title = filter_input(INPUT_POST, 'titulo');
    
    if ($url && $title) {
        $dbPath = __DIR__ . "\db.sqlite";
        $pdo = new \PDO("sqlite:{$dbPath}");

        $sqlUpdate = "UPDATE videos SET url = ?, title = ? WHERE id = ?;";
        $statement = $pdo->prepare($sqlUpdate);
        $statement->bindValue(1, $url);
        $statement->bindValue(2, $title);
        $statement->bindValue(3, $id);
        
        if ($statement->execute()) {
            header("location: ./?success=1&message=Vídeo Atualizado");
            exit();
        }

        header("location: ./?success=0&message=Erro ao atualizar o vídeo");
    }
}