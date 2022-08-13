<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <title>Sistema de Login e Senha Criptografados</title>
        <?php
            include '../conexao.php';

            $msgErro = '<p>Desculpe, mas você não está cadastrado no nosso sistema!</p>
                <p><a href="../index.php">Clique aqui</a> para voltar à tela anterior e informe um e-mail válido.</p>
                <p>Obrigado.</p>';

            $recebeEmail = trim($_POST['email']);
            $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);

            $sql = mysqli_query($conecta, "SELECT opc_pergunta_secreta, email_tblusuario FROM tblusuario WHERE email_tblusuario = '$filtraEmail'") or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);
        ?>
    </head>
    <body>
        <div id="conteudo">
                <h1>Sistema de Login e Senha Criptografados - Recuperação de Senha</h1>
                <div class="borda"></div>
            <?php
                if(!isset($result)) exit($msgErro);
                if($result['opc_pergunta_secreta'] != ""){
            ?>
                <p>Informe a resposta secreta, para que uma nova senha seja enviada!</p>
                <form action="enviaSenha.php" method="post">
                    <fieldset>
                        <legend>Recuperar senha</legend>
                        <input type="hidden" name="email" value="<?php echo $filtraEmail; ?>">
                        <label for="Pergunta"><?php echo $result['opc_pergunta_secreta']; ?>:</label>
                        <input type="text"
                            name="resposta"
                            class="txtDados txtResposta"
                            placeholder="Digite sua resposta..."
                            required
                            autofocus
                        >
                        <input type="submit" value="Enviar" class="botaoForm">
                    </fieldset>
                </form>
                <p><a href="formSenha.php">Clique aqui</a> para voltar à página anterior!</p>
        <?php
            } else {
        ?>
                <p>Desculpe, mas você não tem uma pergunta secreta informada!</p>
                <p>Entre em contato com o administrador do sistema ou faça login e configure uma nova pergunta.</p>
                <p><a href="formSenha.php">Clique aqui</a> para voltar à página anterior.</p>
                <p>Obrigado.</p>
        <?php } ?>
        </div>
    </body>
</html>