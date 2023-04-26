<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeVideosController implements Controller
{
    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            $videos = $this->allVideos();

            return new Response(
                302, [
                'location' => '/'
            ]);
        } else {
            session_destroy();
            return new Response(
                302, [
                'location' => '/login'
            ]);
        }
    }

    public function allVideos(): array
    {
        $videos = $this->repository->getAllVideos();

        return $videos;
    }
}