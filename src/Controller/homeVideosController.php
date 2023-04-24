<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Repository\VideoRepository;

class HomeVideosController implements Controller
{
    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(): void
    {
        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            $videos = $this->allVideos();
            require_once __DIR__ . "/../views/home.php";
            exit();
        }

        session_destroy();
        header('location: /login');
    }

    public function allVideos(): array
    {
        $videos = $this->repository->getAllVideos();

        return $videos;
    }
}