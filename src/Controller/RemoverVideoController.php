<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Helpers\FlashMessageTrait;
use Alura\CursoMvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RemoverVideoController implements Controller
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
            $queryParams = $request->getQueryParams();
            $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

            if (is_nan($id)) {
                throw new \InvalidArgumentException('Erro ao remover vídeo');
            }

            $id = $_REQUEST['id'];
            $acao = $_REQUEST['acao'];

            switch ($acao) {
                case 'remover-video':
                    $this->repository->removeVideo($id);
                    $this->addMessage("Vídeo removido com sucesso!");
                    break;
                case 'remover-capa':
                    $this->repository->removeCapa($id);
                    $this->addMessage("Capa removida com sucesso!");
                    break;
            }

            return new Response(
                301, [
                    'location' => '/'
                ]
            );
        } else {
            session_destroy();
            return new Response(
                302, [
                'location' => '/login'
            ]);
        }
    }
}