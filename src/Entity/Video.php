<?php

namespace Alura\CursoMvc\Entity;

class Video
{
    public ?int $id;
    public string $url;
    public string $title;
    public ?string $imgPath;

    public function __construct(
        ?int $id,
        string $url,
        string $title,
        ?string $imgPath
    )
    {
        if (is_int($id)) {
            $this->setId($id);
        }

        $this->setUrl($url);
        $this->setTitle($title);

        if (is_string($imgPath)) {
            $this->setImgPath($imgPath);
        }
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

    public function setImgPath(string $imgPath): void
    {
        if (!is_string($imgPath)) {
            throw new \InvalidArgumentException();
        }

        $this->imgPath = $imgPath;
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

    public function getImgPath(): string
    {
        return $this->imgPath;
    }
}