<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\Video;
use Alura\CursoMvc\Helpers\FlashMessageTrait;
use Alura\CursoMvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdicionarVideoController implements Controller
{
    use FlashMessageTrait;

    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
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

                return new Response(
                    302, [
                        'location' => '/adicionar'
                    ]
                );
            } else {
                $this->addNovoVideo($request);
                return new Response(
                    302, [
                        'location' => '/'
                    ]
                );
            }
        } else {
            session_destroy();
            return new Response(
                302, [
                    'location' => '/login'
                ]
            );
        }
    }

    public function addNovoVideo(ServerRequestInterface $request): void
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

        $params = $request->getParsedBody();
        $url = filter_var($params['url'], FILTER_VALIDATE_URL);
        $title = filter_var($params['titulo']);

        $objVideo = new Video(null, $url, $title, $imgPath);
        $this->repository->addVideo($objVideo);
        
        $this->addMessage("Novo vídeo adicionado!");
    }
}