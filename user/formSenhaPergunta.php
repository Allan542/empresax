<!DOCTYPE html>
<html lang="pt_BR" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sistema de Login e Senha Criptografados</title>
    <?php
         $recebeEmail = $_POST['email'];
         $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
         $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);

         $sql = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE email_tblusuario = '$filtraEmail'");
         $result = mysqli_fetch_assoc($sql);
    ?>
</head>
<body>
    <div id="conteudo">
        <h1>Sistema de Login e Senha Criptografados - Recuperação de Senha</h1>
        <div class="borda"></div>
        <p>Informe a pergunta secreta, para que uma nova senha seja enviada!</p>
        <form action="enviaSenha.php" method="post">
            <fieldset>
                <legend>Recuperar senha</legend>
                <input type="hidden" name="email" value="<?php echo $filtraEmail; ?>">
                <label for="Pergunta">Email:</label>
                <input type="text"
                    name="email"
                    class="txtDados txtResposta"
                    placeholder="Digite sua resposta..."
                    required
                    autofocus
                >
                <input type="submit" value="Enviar" class="botaoForm">
            </fieldset>
        </form>
        <p><a href="formSenha.php">Clique aqui</a> para voltar à página anterior!</p>
    </div>
</body>
</html>