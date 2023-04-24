<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\Video;
use Alura\CursoMvc\Repository\VideoRepository;
use InvalidArgumentException;

class AdicionarVideoController implements Controller
{
    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(): void
    {
        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            $httpMethod = $_SERVER['REQUEST_METHOD'];

            if ($httpMethod === 'GET') {
                $video = [
                    'id' => '',
                    'url' => '',
                    'title' => ''
                ];

                $id = null;

                require_once __DIR__ . '/../views/formulario.php';
                exit();
            }

            $this->addNovoVideo();
        }

        session_destroy();
        header('location: /login');
    }

    public function addNovoVideo(): void
    {
        $objVideo = new Video(null, $_REQUEST['url'], $_REQUEST['titulo']);
        $this->repository->addVideo($objVideo);
        
        header("location: /?message=Vídeo Salvo");
    }
}