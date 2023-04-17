<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\Video;
use Alura\CursoMvc\Repository\VideoRepository;
use InvalidArgumentException;

class VideoController
{
    private VideoRepository $videoRepository;

    public function __construct()
    {
        $this->videoRepository = new VideoRepository();
    }
    public function updateVideo(Video $video)
    {
        if (!$video->getId() || !$video->getUrl() || !$video->getTitle()) {
            throw new InvalidArgumentException("Objeto 'Video' incompleto.");
        }

        $videoRepository = new VideoRepository();
        $videoRepository->updateVideo($video);
        
        header("location: /?msg=Vídeo Atualizado");
    }
}