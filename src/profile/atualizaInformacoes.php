<?php
    include "../conexao.php";
    session_cache_expire(5);
    session_start();

    if(!empty($_POST)){
        $_SESSION['prox_pagina'] = "./profile/atualizaInformacoes.php";
        $_SESSION['post'] = $_POST;
        exit(header("Location: ../recarregar.php"));
    }

    $refresh = "<meta http-equiv='refresh' content='2; url=formPerfil.php'>";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Atualizar Informações</title>

</head>
<body>
    <div id="conteudo">
    <?php
        if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
        if ($_SESSION['login'] && isset($_SESSION['post'])){
            echo "<h1>Atualizar Informações</h1>";
            echo "<div class='borda'></div>";

            function criptoSenha($criptoSenha){
                return md5($criptoSenha);
            }

            $idUserLogado = $_SESSION['id_usuario'];

            $recebeNome = trim(ucwords($_SESSION['post']['nome']));
            $filtraNome = filter_var($recebeNome, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraNome = filter_var($filtraNome, FILTER_SANITIZE_ADD_SLASHES);
            
            $recebeIdade = $_SESSION['post']['idade'];
            $filtraIdade = filter_var($recebeIdade, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraIdade = filter_var($filtraIdade, FILTER_SANITIZE_ADD_SLASHES);

            $confereSenha = $_SESSION['post']['conf_pass'];
            $filtra_confereSenha = filter_var($confereSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtra_confereSenha = filter_var($filtra_confereSenha, FILTER_SANITIZE_ADD_SLASHES);

            $cripto_confereSenha = criptoSenha($filtra_confereSenha);

            $confere_chkAttPergunta = isset($_SESSION['post']['chk-att-pergunta']);

            if ($confere_chkAttPergunta){
                $recebePergunta = $_SESSION['post']['pergunta'];

                $recebeResposta = trim($_SESSION['post']['resposta']);
                $filtraResposta = filter_var($recebeResposta, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtraResposta = filter_var($filtraResposta, FILTER_SANITIZE_ADD_SLASHES);
            
            }
            unset($_SESSION['post']);

            

            $sql = mysqli_query($conecta, "SELECT senha_tblusuario FROM tblusuario WHERE id_tblusuario=$idUserLogado") or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);

            if($result['senha_tblusuario'] == $cripto_confereSenha) {
                if (isset($recebePergunta) && $recebePergunta == ""){
                    echo '<p>A pergunta secreta precisa ser selecionada.</p>';
                    exit($refresh);
                } 
                else {
                    $sqlUpdate = $confere_chkAttPergunta ?
                        "UPDATE tblusuario SET nome_tblusuario = '$filtraNome', 
                        idade_tblusuario = $filtraIdade, opc_pergunta_secreta = '$recebePergunta', 
                        resp_pergunta_secreta='$filtraResposta' WHERE id_tblusuario=$idUserLogado"
                    :
                        "UPDATE tblusuario SET nome_tblusuario = '$filtraNome', 
                        idade_tblusuario = $filtraIdade WHERE id_tblusuario=$idUserLogado"
                    ;
                    $atualizaDados = mysqli_query($conecta, $sqlUpdate) or die(mysqli_error($conecta));
                    echo "<p>Seus dados foram atualizados com sucesso.</p>";
                    exit($refresh);
                }
            } else {
                echo '<p>A senha foi digitada incorretamente.</p>';
                exit($refresh);
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