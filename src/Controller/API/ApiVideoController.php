<?php

declare(strict_types=1);

namespace Alura\CursoMvc\Controller\API;

use Alura\CursoMvc\Repository\VideoRepository;

class ApiVideoController
{
    private VideoRepository $repository;
    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao()
    {
        $arrVideos = $this->repository->getAllVideos();
        echo json_encode($arrVideos);
    }
}