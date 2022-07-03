<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Sistema de Login e Senha Criptografados</title>
        <?php
            include '../conexao.php';

            $recebeEmail = $_POST['email'];
            $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);

            $sql = mysqli_query($conecta, "SELECT opc_pergunta_secreta FROM tblusuario WHERE email_tblusuario = '$filtraEmail'") or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);
            print_r($result);
        ?>
    </head>
    <body>
        <div id="conteudo">
                <h1>Sistema de Login e Senha Criptografados - Recuperação de Senha</h1>
                <div class="borda"></div>
            <?php
                if($result['opc_pergunta_secreta'] != ""){ 
            ?>
                <p>Informe a pergunta secreta, para que uma nova senha seja enviada!</p>
                <form action="enviaSenha.php" method="post">
                    <fieldset>
                        <legend>Recuperar senha</legend>
                        <input type="hidden" name="email" value="<?php echo $filtraEmail; ?>">
                        <label for="Pergunta"><?php $result['opc_pergunta_secreta']?>:</label>
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
                <p>Entre em contato com o administrador do sistema.</p>
                <p><a href="../index.php">Clique aqui</a> para voltar à página inicial.</p>
                <p>Obrigado.</p>
        <?php } ?>
        </div>
    </body>
</html>