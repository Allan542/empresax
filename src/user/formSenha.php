<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Sistema de Login e Senha Criptografados</title>
</head>
<body>
    <div id="conteudo">
        <h1>Sistema de Login e Senha Criptografados - Recuperação de Senha</h1>
        <div class="borda"></div>
        <p>Informe o email utilizado no login, para que uma nova senha seja enviada!</p>
        <form action="formSenhaPergunta.php" method="post">
            <fieldset>
                <legend>Recuperar senha</legend>
                <label for="email">Email:</label>
                <input type="email"
                    name="email"
                    class="txtDados"
                    placeholder="Digite seu email..."
                    required
                    autofocus
                >
                <input type="submit" value="Enviar" class="botaoForm">
            </fieldset>
        </form>
        <p><a href="../index.php">Clique aqui</a> para voltar à página de acesso!</p>
    </div>
</body>
</html>