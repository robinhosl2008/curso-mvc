<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Repository\VideoRepository;

class RemoverVideoController implements Controller
{
    private VideoRepository $repository;

    public function __construct()
    {
        $this->repository = new VideoRepository();
    }

    public function processaRequisicao(): void
    {
        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            if (!is_array($_REQUEST) && !array_key_exists('id', $_REQUEST)) {
                throw new \InvalidArgumentException('Erro ao remover vídeo');
            }

            $id = $_REQUEST['id'];
            $acao = $_REQUEST['acao'];

            switch ($acao) {
                case 'remover-video':
                    $this->repository->removeVideo($id);
                    $_SESSION['message'] = "Vídeo removido com sucesso!";
                    break;
                case 'remover-capa':
                    $this->repository->removeCapa($id);
                    $_SESSION['message'] = "Capa removida com sucesso!";
                    break;
            }

            header("location: /");
            exit();
        }

        session_destroy();
        header('location: /login');
    }
}