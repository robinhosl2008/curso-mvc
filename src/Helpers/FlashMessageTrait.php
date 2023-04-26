<?php

declare(strict_types=1);

namespace Alura\CursoMvc\Helpers;

trait FlashMessageTrait
{
    private function addMessage(string $msg): void
    {
        $_SESSION['message'] = $msg;
    }
}