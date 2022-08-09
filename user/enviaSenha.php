<?php
    include "../conexao.php";
    $recebeEmail = $_POST['email'];
    $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
    $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);

    $recebeResposta = $_POST['resposta'];
    $filtraResposta = filter_var($recebeResposta, FILTER_SANITIZE_SPECIAL_CHARS);
    $filtraResposta = filter_var($filtraResposta, FILTER_SANITIZE_ADD_SLASHES);
    $filtraResposta = strtolower($filtraResposta);

    $sql_pesq = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE email_tblusuario = '$filtraEmail'") or die (mysqli_error($conecta));
    $result = mysqli_fetch_assoc($sql_pesq);
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Sistema de Login e Senha Criptografados</title>
</head>
<body>
    <div id="conteudo">
        <?php if (strtolower($result['resp_pergunta_secreta']) != $filtraResposta) { ?>
            <h1>Pergunta secreta!</h1>
            <div class="borda"></div>
            <p>Desculpe, mas a pergunta secreta está incorreta!</p>
            <p>Se quiser tentar novamente, <a href="formSenha.php">clique aqui</a>.</p>
            <p>Obrigado.</p>
        <?php } 
        else {
            $id_usuario = $result['id_tblusuario'];
            $nome = $result['nome_tblusuario'];
            $email = $result['email_tblusuario'];

            // função que gera uma nova senha aleatória
            function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
                $lmin = 'abcdefghijklmnopqrstuvwxyz';
                $lmai = strtoupper($lmin);
                $num = '1234567890';
                $simb = '!@#$%*-';
                $retorno = '';
                $caracteres = '';

                $caracteres .= $lmin;
                if($maiusculas) $caracteres .= $lmai;
                if ($numeros) $caracteres .= $num;
                if ($simbolos) $caracteres .= $simb;
                $len = strlen($caracteres);

                for($n = 1; $n <= $tamanho; $n++){
                    $rand = mt_rand(1, $len);
                    $retorno .= $caracteres[$rand-1];
                }
                return $retorno;
            }

            $novasenha = geraSenha(9, true, false); // gera uma nova senha de 9 caracteres com letras maiusculas e sem números e símbolos para ser mandada por email
            $senhamd5 = md5($novasenha); // criptografa a senha gerada

            $query = "UPDATE tblusuario SET senha_tblusuario = '$senhamd5' where id_tblusuario= ".$id_usuario;
            $rs = mysqli_query($conecta, $query) or die(mysqli_error($conecta));

            $formato = "\nContent-type: text/html";
            $msg = "Olá $nome. Recebemos uma solicitação para renovar sua senha.<br><br>";
            $msg .= "Seu usuário: <strong>$usuario</strong><br>";
            $msg .= "Sua <strong>nova</strong> senha: <strong>$novasenha</strong><br><br>";
            $msg .= "Caso não tenha solicitado esta ação. Acesse a sua conta e altere sua senha novamente.<br><br>";
            $msg .= "Obrigado.<br>";
            mail($email,"Nova Senha", $msg, "From: Sistema <allan@allan.com>" . $formato);
        ?>
        <h2>Senha enviada!</h2>
        <p>Parabéns. Sua senha foi enviada para o e-mail solicitado.</p>
        <p>Após verificar seu e-mail, retorne à página de login.</p>
        <p>Se preferir, <a href="../index.php">clique aqui</a>.</p>
        <p>Obrigado!</p>
        <?php } ?>
    </div>
</body>
</html>