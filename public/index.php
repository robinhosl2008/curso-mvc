<?php

use Alura\CursoMvc\Controller\VideoController;
use Alura\CursoMvc\Entity\Video;

require_once '../vendor/autoload.php';

$acao = filter_input(INPUT_GET, 'acao');

if ($acao === "editar-video") {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $url = filter_input(INPUT_POST, 'url');
    $title = filter_input(INPUT_POST, 'titulo');

    $video = new Video($id, $url, $title);
    $videoController = new VideoController();
    $videoController->updateVideo($video);
}


if (!array_key_exists('PATH_INFO', $_SERVER)) {
    require_once __DIR__.'/../src/views/home.php';
} else {
    $path = $_SERVER['PATH_INFO'];

    switch ($path) {
        case '/login':
            require_once __DIR__.'/../pages/login.php';
            break;

        case '/':
        case '/home':
            require_once __DIR__.'/../src/views/home.php';
            break;
        
        case '/adicionar':
            require_once __DIR__.'/../src/views/formulario.php';
            break;
        
        case '/editar':
            require_once __DIR__.'/../src/views/formulario.php';
            break;
        
        case '/remover':
            require_once __DIR__.'/../src/views/formulario.php';
            break;
    }
}