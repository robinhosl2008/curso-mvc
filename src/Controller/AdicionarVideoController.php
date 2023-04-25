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
        $imgPath = '';
        if (is_array($_FILES) && array_key_exists('img', $_FILES) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Verificando se realmente veio um arquivo do tipo imagem.
            $fInfo = new \finfo(FILEINFO_MIME_TYPE);
            $fType = $fInfo->file($_FILES['img']['tmp_name']);

            if (str_starts_with($fType, 'image/')) {
                $imgExtension = explode('/', $fType)[1];
                $imgPath = 'img/uploads/' . uniqid('uploaded_') . '.' . $imgExtension;

                move_uploaded_file(
                    $_FILES['img']['tmp_name'],
                    $imgPath
                );
            }
        }

        $objVideo = new Video(null, $_REQUEST['url'], $_REQUEST['titulo'], $imgPath);
        $this->repository->addVideo($objVideo);
        
        header("location: /?message=Vídeo Salvo");
        exit();
    }
}