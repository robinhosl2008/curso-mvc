<?php

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if (!$url) {
    header("location: /?success=false&message=\"URL inválida.\"");
    exit();
}

$title = filter_input(INPUT_POST, 'titulo');

if (!$title) {
    header("location: /?success=false&message=\"O 'Título' é obrigatório.\"");
    exit();
}

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$statemant = $pdo->prepare("INSERT INTO videos (url, title) VALUES (?, ?);");
$statemant->bindValue(1, $url);
$statemant->bindValue(2, $_POST['titulo']);

if ($statemant->execute() === true) {
    header("location: /?success=true");
} else {
    header("location: /?success=false");
}