<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Repository\VideoRepository;

class EditarVideosController implements Controller
{
    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(): void
    {
        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            $video = [
                'id' => '',
                'url' => '',
                'title' => ''
            ];

            $id = $_REQUEST['id'];

            if ($id && !is_nan($id)) {
                $video = $this->exibirFormVideo($id);
            }
            
            require_once __DIR__ . '/../views/formulario.php';
        }

        session_destroy();
        header('location: /login');
    }

    public function exibirFormVideo(int $id): array
    {
        return $this->repository->getVideo($_REQUEST['id']);
    }

    // public function editaVideo(Video $video)
    // {
    //     if (!$video->getId() || !$video->getUrl() || !$video->getTitle()) {
    //         throw new InvalidArgumentException("Objeto 'Video' incompleto.");
    //     }

    //     $videoRepository = new VideoRepository();
    //     $videoRepository->updateVideo($video);
    // }
}