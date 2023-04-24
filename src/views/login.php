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
            <a class="logo" href="./"></a>

            <div class="cabecalho__icones">
                <a href="/adicionar" class="cabecalho__videos"></a>
                <a href="/login" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <main class="container">

        <form method="post" action="/logar" class="container__formulario">
            <h2 class="formulario__titulo">Efetue login</h3>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="email">E-mail</label>
                    <input type="email" id='email' name="email" class="campo__escrita" required placeholder="Digite seu usuário" />
                </div>

                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="password">Senha</label>
                    <input type="password" id='password'name="password" class="campo__escrita" required placeholder="Digite sua senha" />
                </div>

                <input type="submit" class="formulario__botao" value="Entrar" />
        </form>

    </main>

</body>

</html>