<?php
    session_cache_expire(5); // sessão dura 5 minutos
    session_start();
    if (!isset($_SESSION['login'])) $_SESSION['login'] = false;
    if (!$_SESSION['login']){
?>
    <!DOCTYPE html>
    <html lang="pt_BR">
        <head>
            <meta charset="UTF-8">
            <meta name="author" content="Allan Carlos">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../assets/css/style.css">
            <title>Sistema de Login e Senha criptografados - Acesso ao Conteúdo Exclusivo</title>
        </head>
        <body>
            <div id="conteudo">
                <h1>Sistema de Login e Senha criptografados - Acesso ao Conteúdo Exclusivo</h1>
                <div class="borda"></div>
                <p>Para ter acesso ao <strong>Conteúdo Exclusivo</strong>, por favor, logue-se utilizando o formulário abaixo!</p>
                <p>Ainda não é cadastrado em nosso sistema, <a href="./user/formCadastro.php">Cadastre-se</a>!</p>
                <form action="./user/validaAcesso.php" method="post" id="validaAcesso" enctype="application/x-www-form-urlencoded">
                    <fieldset>
                        <legend>Login</legend>
                        <label for="email">Email:</label>
                        <input type="email"
                            placeholder="Digite seu email..."
                            name="email"
                            class="txtDados"
                            required
                            autofocus
                        >
                        <div class="clear"></div>
                        <label for="senha">Senha:</label>
                        <input type="password"
                            placeholder="Digite sua senha..."
                            name="senha"
                            class="txtDados"
                            required
                            >
                        <div class="clear"></div>
                        <input type="submit" value="Acessar o sistema" class="botaoForm">
                    </fieldset>
                </form>
                <p>
                    <small>
                        Esqueceu seus dados? <a href="user/formSenha.php">Clique aqui!</a>
                    </small>
                </p>
            </div>
        </body>
    </html>
<?php 
    }
    else {
        header("Location: ./content/conteudoExclusivo.php");
    }
?>
