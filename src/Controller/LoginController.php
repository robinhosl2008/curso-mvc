<?php

namespace Alura\CursoMvc\Controller;

use Alura\CursoMvc\Entity\User;
use Alura\CursoMvc\Repository\UserRepository;

class LoginController implements Controller
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function processaRequisicao(): void
    {
        if (array_key_exists('PATH_INFO', $_SERVER) && $_SERVER['PATH_INFO'] === "/logar") {
            $this->logar();
            exit();
        }

        if ($_SESSION && array_key_exists('logado', $_SESSION) && $_SESSION['logado'] == 1) {
            session_destroy();
        }

        require_once __DIR__ . '/../views/login.php';
    }

    public function logar(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $newUser = new User(null, $email, $password);
        $user = $this->repository->getUser($newUser);
        
        $passwordSuccess = password_verify($password, $user['result']['password'] ?? '');
        
        if ($passwordSuccess) {
            if (password_needs_rehash($user['result']['password'], PASSWORD_ARGON2ID)) {
                $this->repository->updatePassword($user['result']['id'], password_hash($password, PASSWORD_ARGON2ID));
            }

            session_start();
            $_SESSION['logado'] = 1;
            header('location: /');
        } else {
            $_SESSION['error-message'] = "Usuário ou senha inválidos!";
            header('location: /login');
        }
    }
}