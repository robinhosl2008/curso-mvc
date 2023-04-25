<?php

declare(strict_types=1);

use Alura\CursoMvc\Controller\homeVideosController;
use Alura\CursoMvc\Controller\LoginController;
use Alura\CursoMvc\Controller\EditarVideosController;
use Alura\CursoMvc\Controller\AdicionarVideoController;
use Alura\CursoMvc\Controller\RemoverVideoController;

return [
    'GET|' => homeVideosController::class,
    'GET|/' => homeVideosController::class,
    'GET|/home' => homeVideosController::class,
    'GET|/login' => LoginController::class,
    'POST|/logar' => LoginController::class,
    'GET|/adicionar' => AdicionarVideoController::class,
    'POST|/adicionar' => AdicionarVideoController::class,
    'GET|/editar' => EditarVideosController::class,
    'POST|/editar' => EditarVideosController::class,
    'GET|/remover' => RemoverVideoController::class,
];