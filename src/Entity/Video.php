<?php

namespace Alura\CursoMvc\Entity;

class Video
{
    public readonly ?int $id;
    public readonly string $url;
    public readonly string $title;

    public function __construct(
        ?int $id,
        string $url,
        string $title
    )
    {
        if (is_int($id)) {
            $this->setId($id);
        }

        $this->setUrl($url);
        $this->setTitle($title);
    }

    public function setId(int $id): void
    {
        if (filter_var($id, FILTER_VALIDATE_INT) === false) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
    }

    public function setUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException();
        }

        $this->url = $url;
    }

    public function setTitle(string $title): void
    {
        if (!is_string($title)) {
            throw new \InvalidArgumentException();
        }

        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}