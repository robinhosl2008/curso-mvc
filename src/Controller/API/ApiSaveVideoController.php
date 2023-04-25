<?php

declare(strict_types=1);

namespace Alura\CursoMvc\Controller\API;

use Alura\CursoMvc\Controller\Controller;
use Alura\CursoMvc\Entity\Video;
use Alura\CursoMvc\Repository\VideoRepository;

class ApiSaveVideoController implements Controller
{
    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(): void
    {
        $request = file_get_contents("php://input");
        $videoData = json_decode($request, true);
        
        $video = new Video(null, $videoData['url'], $videoData['title'], null);
        $this->repository->addVideo($video);

        http_response_code(201);
    }
}