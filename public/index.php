<?php

use Alura\CursoMvc\Controller\VideoController;
use Alura\CursoMvc\Controller\AllVideosController;
use Alura\CursoMvc\Entity\Video;

require_once '../vendor/autoload.php';
$routes = require_once __DIR__ . "/../config/routes.php";

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();

$key = "$httpMethod|$pathInfo";
if (!array_key_exists($key, $routes)) {
    throw new DomainException("Rota não encontrada");
}

$controllerClass = $routes["$httpMethod|$pathInfo"];

$controller = new $controllerClass();
$controller->processaRequisicao();

$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('location: /login');
    return;
}
