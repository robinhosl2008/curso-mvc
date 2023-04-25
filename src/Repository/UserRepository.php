<?php

namespace Alura\CursoMvc\Repository;

use Alura\CursoMvc\Entity\User;
use Connection;
use PDO;

class UserRepository extends Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $conn = new Connection();
        $this->pdo = $conn->getPdo();
    }

    public function updatePassword(int $id, string $password): void
    {
        $sql = "UPDATE users SET password = ? WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $password);
        $statement->bindValue(2, $id);
        $statement->execute();
    }

    public function getUser(User $user): array
    {
        $sql = "SELECT * FROM users WHERE email = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->getEmail());
        $statement->execute();

        $arr = [
            'result' => $statement->fetch(PDO::FETCH_ASSOC)
        ];

        return $arr;
    }
}