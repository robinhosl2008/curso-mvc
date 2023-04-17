<?php

require_once '../vendor/autoload.php';

use Alura\CursoMvc\Repository\VideoRepository;

$dbPath = __DIR__ . "/db.sqlite";
$pdo = new PDO("sqlite:{$dbPath}");

$repository = new VideoRepository($pdo);
$videos = $repository->getAllVideos();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https:/fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>
<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="./"></a>

            <div class="cabecalho__icones">
                <a href="./adicionar" class="cabecalho__videos"></a>
                <a href="./login" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <ul class="videos__container" alt="videos alura">
        <?php
        foreach ($videos as $video):
            if (str_starts_with($video->getUrl(), "http")) {
        ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?php echo $video->getUrl(); ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video->getTitle(); ?></h3>
                    <div class="acoes-video">
                        <a href="/editar?id=<?php echo $video->getId(); ?>">Editar</a>
                        <a href="/remover?id=<?php echo $video->getId(); ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php
            } else {
        ?>
            <li class="videos__item">
                <img src="/img/error-404-1.png" class="img-404" title="404"></img>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video->getTitle(); ?></h3>
                    <div class="acoes-video">
                        <a href="/editar?id=<?php echo $video->getId(); ?>">Editar</a>
                        <a href="/remover?id=<?php echo $video->getId(); ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php
            }
        endforeach;
        ?>
    </ul>
</body>

</html>