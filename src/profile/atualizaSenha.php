<?php
    include "../conexao.php";
    session_cache_expire(5);
    session_start();

    if(!empty($_POST)){
        $_SESSION['prox_pagina'] = "./profile/atualizaSenha.php";
        $_SESSION['post'] = $_POST;
        unset($_POST);
        exit(header("Location: ../recarregar.php"));
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Atualizar Senha</title>

</head>
<body>
    <div id="conteudo">
        <h1>Atualizar Senha</h1>
        <div class="borda"></div>
    <?php
        if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
        if ($_SESSION['login'] && isset($_SESSION['post'])){
            function criptoSenha($criptoSenha){
                return md5($criptoSenha);
            }
            
            $refresh = "<meta http-equiv='refresh' content='5; url=formPerfil.php'>";

            $idUserLogado = $_SESSION['id_usuario'];
            
            $senhaAtual = $_SESSION['post']['current_pass'];
            $filtra_senhaAtual = filter_var($senhaAtual, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtra_senhaAtual = filter_var($filtra_senhaAtual, FILTER_SANITIZE_ADD_SLASHES);

            $newSenha = $_SESSION['post']['new_pass'];
            $filtra_newSenha = filter_var($newSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtra_newSenha = filter_var($filtra_newSenha, FILTER_SANITIZE_ADD_SLASHES);

            $conf_newSenha = $_SESSION['post']['conf_new_pass'];
            $filtra_conf_newSenha = filter_var($conf_newSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtra_conf_newSenha = filter_var($filtra_conf_newSenha, FILTER_SANITIZE_ADD_SLASHES);

            $cripto_senhaAtual = criptoSenha($filtra_senhaAtual);
            $cripto_newSenha = criptoSenha($filtra_newSenha);
            $cripto_conf_newSenha = criptoSenha($filtra_conf_newSenha);

            if(isset($_SESSION['post'])) unset($_SESSION['post']);

            unset($_SESSION['post']);

            $sql = mysqli_query($conecta, "SELECT nome_tblusuario, senha_tblusuario FROM tblusuario WHERE id_tblusuario = $idUserLogado") or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);
            $nomeUser = $result['nome_tblusuario'];

            $sql_senha = mysqli_query($conecta, "SELECT * FROM senhas_antigas WHERE senha_antiga = '$cripto_newSenha' AND id_tblusuario = $idUserLogado") or die(mysqli_error($conecta));
            $count_rows = mysqli_num_rows($sql_senha);
            $result_senha = mysqli_fetch_assoc($sql_senha);

            if($result['senha_tblusuario'] == $cripto_senhaAtual) {
                if ($result['senha_tblusuario'] == $cripto_newSenha || $count_rows > 0) {
                    echo '<p>A nova senha não pode ser igual a uma senha anterior que já foi utilizada.</p>';
                    echo '<p><a href="javascript:history.back()">Clique aqui</a> para voltar e tente novamente!</p>';
                    return false;
                } else if ($cripto_newSenha != $cripto_conf_newSenha) {
                    echo '<p>As novas senhas digitadas não conferem.</p>';
                    echo '<p><a href="javascript:history.back()">Clique aqui</a> para voltar e tente novamente!</p>';
                    return false;
                } else {
                    $sqlUpdate = "UPDATE tblusuario SET senha_tblusuario='$cripto_newSenha' WHERE id_tblusuario=$idUserLogado";
                    $atualizaDados = mysqli_query($conecta, $sqlUpdate) or die(mysqli_error($conecta));
                    $insereDados = mysqli_query($conecta, "INSERT INTO senhas_antigas (senha_antiga, nome_senhas_antigas,id_tblusuario) VALUES ('$cripto_senhaAtual', '$nomeUser', $idUserLogado)");
                    echo "<p>Sua senha foi atualizada com sucesso.</p>";
                    exit($refresh);
                }
            } else {
                echo '<p>A senha atual informada não confere com a senha cadastrada.</p>';
                echo '<p><a href="javascript:history.back()">Clique aqui</a> para voltar e tente novamente!</p>';
            }
        } else if(!isset($_SESSION['post'])){
            $refresh = "<meta http-equiv='refresh' content='0; url=formPerfil.php'>";
            echo "<script>";
            echo "alert('Não é possível recarregar esta página. Portanto, faça da maneira correta, enviando novamente os dados nos respectivos campos.')";
            echo "</script>";
            exit($refresh);
        } else {
    ?>
            <h1>Sistema de login e senha criptografados</h1>
            <div class="borda"></div>
            <p>Proibido o acesso por esse meio. Volte e informe os dados corretamente!</p>
            <p><a href="../index.php">Página inicial</a></p>
    <?php } ?>
    </div>
</body>
</html>