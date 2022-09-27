<?php
    session_start();
    include '../conexao.php';

    if(!empty($_POST)){
        $_SESSION['prox_pagina'] = "./user/validaAcesso.php";
        $_SESSION['post'] = $_POST;
        exit(header("Location: ../recarregar.php"));
    }
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Sistema de login e senha criptografados - Verificando Informações</title>
</head>
<body>
    <div id="conteudo">
        <?php
        if(isset($_SESSION['post'])){
            echo "<h1>Sistema de login e senha criptografados - Verificando Informações</h1>";
            echo "<div class='borda'></div>";
            $recebeEmail = trim($_SESSION['post']['email']);
            $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS); // retira os caracteres especiais html
            $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES); // adiciona \ em caracteres como: ', ", NULL e a própria \
            
            $recebeSenha = $_SESSION['post']['senha'];
            $filtraSenha = filter_var($recebeSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraSenha = filter_var($filtraSenha, FILTER_SANITIZE_ADD_SLASHES);

            unset($_SESSION['post']);

            // Função para criptografar a senha
            function criptoSenha($criptoSenha) {
                return md5($criptoSenha); 
            }
            $criptoSenha = criptoSenha($filtraSenha);
            $consultaInformacoes = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE email_tblusuario = '$filtraEmail' AND senha_tblusuario = '$criptoSenha'") or die(mysqli_error($conecta));
            $verificaInformacoes = mysqli_num_rows($consultaInformacoes);
            if($verificaInformacoes == 1) {
                $result = mysqli_fetch_assoc($consultaInformacoes);
                $_SESSION['login']=true;
                $_SESSION['id_usuario']=$result['id_tblusuario'];
                $_SESSION['nome_usuario']=$result['nome_tblusuario'];
                $_SESSION['tipo_usuario']=$result['tipo_tblusuario'];

                header("Location: ../content/conteudoExclusivo.php");
                return false;
            } else {
                echo "<p>Nome de Usuário ou Senha informada não confere.</p>";
                echo "<p>Por favor, <a href='javascript:history.back()'>clique aqui</a> para voltar e tente novamente.</p>";
                return false;
            }
        }  else {
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