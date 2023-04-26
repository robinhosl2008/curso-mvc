<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\User;
use Alura\CursoMvc\Helpers\FlashMessageTrait;
use Alura\CursoMvc\Helpers\FlashMessageTrait2;
use Alura\CursoMvc\Repository\UserRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController implements Controller
{
    use FlashMessageTrait, FlashMessageTrait2 {
        FlashMessageTrait::addMessage insteadof FlashMessageTrait2;
        FlashMessageTrait2::addMessage as flashMessage;
    }

    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function processaRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        if (array_key_exists('PATH_INFO', $_SERVER) && $_SERVER['PATH_INFO'] === "/logar") {
            $this->logar($request);
            exit();
        }

        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            session_destroy();
        }

        return new Response(
            302, 
            [
                'location' => '/login'
            ]
        );
    }

    public function logar(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $email = filter_var($requestBody['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($requestBody['password']);

        $newUser = new User(null, $email, $password);
        $user = $this->repository->getUser($newUser);
        
        $passwordSuccess = password_verify($password, $user['result']['password'] ?? '');
        
        if ($passwordSuccess) {
            if (password_needs_rehash($user['result']['password'], PASSWORD_ARGON2ID)) {
                $this->repository->updatePassword($user['result']['id'], password_hash($password, PASSWORD_ARGON2ID));
            }

            session_start();
            $_SESSION['logado'] = 1;
            return new Response(302, [
                'location' => '/'
            ]);
        } else {
            $this->flashMessage("Usuário e senha inválidos!");
            return new Response(302, [
                'location' => '/login'
            ]);
        }
    }
}