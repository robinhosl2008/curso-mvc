<?php 

namespace Alura\CursoMvc\Helpers;

trait FlashMessageTrait2
{
    private function addMessage(string $msg): void
    {
        $_SESSION['message'] = $msg;
    }
}