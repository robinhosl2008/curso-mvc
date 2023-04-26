<?php

use Alura\CursoMvc\Controller\VideoController;
use Alura\CursoMvc\Controller\AllVideosController;
use Alura\CursoMvc\Entity\Video;
use Nyholm\Psr7\Factory\Psr17Factory;

require_once '../vendor/autoload.php';
$routes = require_once __DIR__ . "/../config/routes.php";

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
session_regenerate_id();

$key = "$httpMethod|$pathInfo";
if (!array_key_exists($key, $routes)) {
    throw new DomainException("Rota não encontrada");
}

$psr17Factory = new Psr17Factory();
$request = $psr17Factory->createRequest($httpMethod, $pathInfo);

$controllerClass = $routes["$httpMethod|$pathInfo"];

$controller = new $controllerClass();
$response = $controller->processaRequisicao($request);

// var_dump($response); exit();
$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logado', $_SESSION) && !$isLoginRoute) {
    header('location: /login');
    exit();
}
