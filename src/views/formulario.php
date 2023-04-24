<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https:/fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos-form.css">
    <link rel="stylesheet" href="../css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <!-- Cabecalho -->
    <header>

        <nav class="cabecalho">
            <a class="logo" href="/"></a>

            <div class="cabecalho__icones">
                <a href="/adicionar" class="cabecalho__videos"></a>
                <a href="/login" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <main class="container">

        <form class="container__formulario" method="post"  
            action="/<?php echo ($id) ? 'editar' : 'adicionar'?>">
            <h2 class="formulario__titulo">Envie um vídeo!</h3>
                <input type="hidden" id="id" name="id" value="<?php echo (is_array($video) && array_key_exists('id', $video)) ? $video['id'] : ''; ?>" />
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url" class="campo__escrita" required
                        placeholder="Por exemplo: https:/www.youtube.com/embed/FAY1K2aUg5g" id='url' 
                        value="<?php echo (is_array($video) && array_key_exists('url', $video)) ? $video['url'] : ''; ?>" />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input name="titulo" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
                        id='titulo' value="<?php echo (is_array($video) && array_key_exists('title', $video)) ? $video['title'] : ''; ?>" />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>

</body>

</html>