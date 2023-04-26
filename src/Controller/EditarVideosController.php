<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\Video;
use Alura\CursoMvc\Helpers\FlashMessageTrait;
use Alura\CursoMvc\Repository\VideoRepository;
use InvalidArgumentException;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EditarVideosController implements Controller
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
            $video = [
                'id' => '',
                'url' => '',
                'title' => ''
            ];

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $params = $request->getQueryParams();
                $id = filter_var($params['id'], FILTER_VALIDATE_INT);

                if ($id && !is_nan($id)) {
                    $video = $this->exibirFormVideo($id);
                }
                
                return new Response(
                    302, [
                    'location' => '/editar'
                ]);
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $params = $request->getParsedBody();
                $imagePath = filter_var($params['imagePath']);
                
                if ($_FILES && is_array($_FILES) && array_key_exists('img', $_FILES) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $imgExtension = explode('/', $_FILES['img']['type'])[1];
                    $imagePath = 'img/uploads/' . uniqid('uploaded_') . '.' . $imgExtension;

                    move_uploaded_file(
                        $_FILES['img']['tmp_name'],
                        $imagePath
                    );
                }
                
                $id = filter_var($params['id'], FILTER_VALIDATE_INT);
                $url = filter_var($params['url'], FILTER_VALIDATE_URL);
                $title = filter_var($params['titulo']);

                $video = new Video(
                    $id, 
                    $url, 
                    $title, 
                    $imagePath
                );
                
                $this->editaVideo($video);
                $this->addMessage("Editado com sucesso!");
                return new Response(
                    302, [
                        'location' => '/editar?id='.$id
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

    public function exibirFormVideo(int $id): array
    {
        return $this->repository->getVideo($_REQUEST['id']);
    }

    public function editaVideo(Video $video): void
    {
        if (!$video->getId() || !$video->getUrl() || !$video->getTitle()) {
            throw new InvalidArgumentException("Objeto 'Video' incompleto.");
        }

        $videoRepository = new VideoRepository();
        $videoRepository->updateVideo($video);
    }
}