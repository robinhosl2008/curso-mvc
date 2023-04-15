<?php

if (!array_key_exists('PATH_INFO', $_SERVER)) {
    require_once './home.php';
} else {
    $path = $_SERVER['PATH_INFO'];

    switch ($path) {
        case '/login':
            require_once './pages/login.php';
            break;

        case '/':
        case '/home':
            require_once './home.php';
            break;
        
        case '/adicionar':
            require_once './pages/formulario.php';
            break;
        
        case '/editar':
            require_once './pages/formulario.php';
            break;
        
        case '/remover':
            require_once './pages/formulario.php';
            break;
    }
}