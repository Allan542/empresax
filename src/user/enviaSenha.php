<?php
    session_start();
    include "../conexao.php";

    if(!empty($_POST)){
        $_SESSION['prox_pagina'] = "./user/enviaSenha.php";
        $_SESSION['post'] = $_POST;
        exit(header("Location: ../recarregar.php"));
    }
    if(isset($_SESSION['post'])){

        $recebeEmail = $_SESSION['post']['email'];
        $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
        $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);
    
        $recebeResposta = trim($_SESSION['post']['resposta']);
        $filtraResposta = filter_var($recebeResposta, FILTER_SANITIZE_SPECIAL_CHARS);
        $filtraResposta = filter_var($filtraResposta, FILTER_SANITIZE_ADD_SLASHES);
        $filtraResposta = strtolower($filtraResposta);

        unset($_SESSION['post']);
    
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
            <link rel="stylesheet" href="../../assets/css/style.css">
            <title>Sistema de Login e Senha Criptografados</title>
        </head>
        <body>
            <div id="conteudo">
        <?php if (strtolower($result['resp_pergunta_secreta']) != $filtraResposta) { ?>
                <h1>Sistema de Login e Senha Criptografados - Recuperação de Senha</h1>
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
            $querySenhas = "INSERT INTO senhas_antigas (nome_senhas_antigas, senha_antiga, id_tblusuario)
                VALUES ('" . $result['nome_tblusuario'] . "', '" . $result['senha_tblusuario'] . "', " . $id_usuario . ")"
            ;

            $sqlSenhas = mysqli_query($conecta, $querySenhas) or die(mysqli_error($conecta));
            $rs = mysqli_query($conecta, $query) or die(mysqli_error($conecta));

            $formato = "\nContent-type: text/html";
            $msg = "Olá $nome. Recebemos uma solicitação para renovar sua senha.<br><br>";
            $msg .= "Seu usuário: <strong>" . $result['email_tblusuario'] . "</strong><br>";
            $msg .= "Sua <strong>nova</strong> senha: <strong>$novasenha</strong><br><br>";
            $msg .= "Caso não tenha solicitado esta ação. Acesse a sua conta e altere sua senha novamente.<br><br>";
            $msg .= "Obrigado.<br>";
            mail($email,"Nova Senha", $msg, "From: Sistema <allan@allan.com>" . $formato);
        ?>
        <h1>Sistema de Login e Senha Criptografados - Recuperação de Senha</h1>
        <div class="borda"></div>
        <p>Parabéns. Sua senha foi enviada para o e-mail solicitado.</p>
        <p>Após verificar seu e-mail, retorne à página de login.</p>
        <p>Se preferir, <a href="../index.php">clique aqui</a>.</p>
        <p>Obrigado!</p>
    <?php 
        }        
    } else {
        $refresh = "<meta http-equiv='refresh' content='0; url=../index.php'>";
        echo "<script>";
        echo "alert('Não é possível recarregar esta página. Portanto, faça da maneira correta, enviando novamente os dados nos respectivos campos.')";
        echo "</script>";
        exit($refresh);
    }
    ?>
    </div>
</body>
</html>