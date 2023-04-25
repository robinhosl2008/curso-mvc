<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\Video;
use Alura\CursoMvc\Repository\VideoRepository;
use InvalidArgumentException;

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

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                if ($id && !is_nan($id)) {
                    $video = $this->exibirFormVideo($id);
                }
                
                require_once __DIR__ . '/../views/formulario.php';
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $imagePath = $_REQUEST['imagePath'];
                if ($_FILES && is_array($_FILES) && array_key_exists('img', $_FILES) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $imgExtension = explode('/', $_FILES['img']['type'])[1];
                    $imagePath = 'img/uploads/' . uniqid('uploaded_') . '.' . $imgExtension;

                    move_uploaded_file(
                        $_FILES['img']['tmp_name'],
                        $imagePath
                    );
                }

                $video = new Video(
                    $id, 
                    $_REQUEST['url'], 
                    $_REQUEST['titulo'], 
                    $imagePath
                );
                
                $this->editaVideo($video);
                header("location: /?error=0");
            }

            exit();
        }

        session_destroy();
        header('location: /login');
    }

    public function exibirFormVideo(int $id): array
    {
        return $this->repository->getVideo($_REQUEST['id']);
    }

    public function editaVideo(Video $video)
    {
        if (!$video->getId() || !$video->getUrl() || !$video->getTitle()) {
            throw new InvalidArgumentException("Objeto 'Video' incompleto.");
        }

        $videoRepository = new VideoRepository();
        $videoRepository->updateVideo($video);
    }
}