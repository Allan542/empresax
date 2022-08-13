<?php
    session_start();
    include '../conexao.php';
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
        <h1>Sistema de login e senha criptografados - Verificando Informações</h1>
        <div class="borda"></div>
        <?php
            $recebeEmail = trim($_POST['email']);
            $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS); // retira os caracteres especiais html
            $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES); // adiciona \ em caracteres como: ', ", NULL e a própria \
            
            $recebeSenha = $_POST['senha'];
            $filtraSenha = filter_var($recebeSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraSenha = filter_var($filtraSenha, FILTER_SANITIZE_ADD_SLASHES);

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
            } else {
                echo "<p>Nome de Usuário ou Senha informada não confere. Por favor, <a href='javascript:history.back();'>volte</a> e tente novamente!</p>";
            }
        ?>
    </div>
</body>
</html>