<?php

namespace Alura\CursoMvc\Repository;

use Alura\CursoMvc\Entity\Video;
use Connection;
use InvalidArgumentException;
use PDO;

class VideoRepository extends Connection
{
    private PDO $pdo;
    private Connection $conn;

    public function __construct() 
    {
        $this->conn = new Connection();
        $this->pdo = $this->conn->getPdo();
    }

    public function getVideo(?int $id): array
    {
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            throw new InvalidArgumentException();
        }

        $sql = "SELECT * FROM videos WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllVideos(): array
    {
        $statement = $this->pdo->query("SELECT * FROM videos;");
        $videoList = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function (array $videoData) {
            return new Video(
                $videoData['id'], 
                $videoData['url'], 
                $videoData['title']
            );
        }, $videoList);
    }

    public function addVideo(Video $video): bool
    {
        $sql = "INSERT INTO videos (url, title) VALUES (?, ?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->getUrl(), PDO::PARAM_STR);
        $statement->bindValue(2, $video->getTitle(), PDO::PARAM_STR);
        
        return $statement->execute();
    }

    public function removeVideo(int $id): bool
    {
        $sql = "DELETE FROM videos WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        return $statement->execute();
    }

    public function updateVideo(Video $video): bool
    {
        $sql = "UPDATE videos SET url = ?, title = ? WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->getUrl());
        $statement->bindValue(2, $video->getTitle());
        $statement->bindValue(3, $video->getId());
        
        return $statement->execute();
    }
}