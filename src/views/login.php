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

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
</head>

<body>

    <!-- Cabecalho -->
    <header>

        <nav class="cabecalho">
            <a class="logo" href="./"></a>

            <div class="cabecalho__icones">
                <a href="/adicionar" class="cabecalho__videos"></a>
                <a href="/login" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    
    

    <main class="container">

        <form method="post" action="/logar" class="container__formulario form-group">
            <h2 class="msg"><?php 
                echo ($_SESSION && array_key_exists('error-message', $_SESSION)) ? $_SESSION['error-message'] : ''; 
                unset($_SESSION['error-message']);    
            ?></h2>
            <h2 class="formulario__titulo">Efetue login</h3>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="email">E-mail</label>
                    <input type="email" id='email' name="email" class="campo__escrita form-control" required placeholder="Digite seu usuário" />
                </div>

                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="password">Senha</label>
                    <input type="password" id='password'name="password" class="campo__escrita form-control" required placeholder="Digite sua senha" />
                </div>

                <input type="submit" class="btn btn-primary btn__login" value="Entrar" />
        </form>

    </main>

    <script src="js/video.js"></script>

</body>

</html>