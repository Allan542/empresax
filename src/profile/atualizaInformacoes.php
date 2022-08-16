<?php
    include "../conexao.php";
    session_cache_expire(5);
    session_start();
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
        <h1>Atualizar Informações</h1>
        <div class="borda"></div>
    <?php
        if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
        if ($_SESSION['login']){
            function criptoSenha($criptoSenha){
                return md5($criptoSenha);
            }
            
            $refresh = "<meta http-equiv='refresh' content='5; url=formPerfil.php'>";

            $idUserLogado = $_SESSION['id_usuario'];

            $recebeNome = trim(ucwords($_POST['nome']));
            $filtraNome = filter_var($recebeNome, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraNome = filter_var($filtraNome, FILTER_SANITIZE_ADD_SLASHES);
            
            $recebeIdade = $_POST['idade'];
            $filtraIdade = filter_var($recebeIdade, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraIdade = filter_var($filtraIdade, FILTER_SANITIZE_ADD_SLASHES);

            $confereSenha = $_POST['conf_pass'];
            $filtra_confereSenha = filter_var($confereSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtra_confereSenha = filter_var($filtra_confereSenha, FILTER_SANITIZE_ADD_SLASHES);

            $cripto_confereSenha = criptoSenha($filtra_confereSenha);

            $confere_chkAttPergunta = isset($_POST['chk-att-pergunta']);

            if ($confere_chkAttPergunta){
                $recebePergunta = $_POST['pergunta'];

                $recebeResposta = trim($_POST['resposta']);
                $filtraResposta = filter_var($recebeResposta, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtraResposta = filter_var($filtraResposta, FILTER_SANITIZE_ADD_SLASHES);
            
            }

            $sql = mysqli_query($conecta, "SELECT senha_tblusuario FROM tblusuario WHERE id_tblusuario=$idUserLogado") or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);

            if($result['senha_tblusuario'] == $cripto_confereSenha) {
                if (isset($recebePergunta) && $recebePergunta == ""){
                    echo '<p>A pergunta secreta precisa ser selecionada.</p>';
                    echo '<p><a href="javascript:history.back()">Clique aqui</a> para voltar e tente novamente!</p>';
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
                echo '<p><a href="javascript:history.back()">Clique aqui</a> para voltar e tente novamente!</p>';
            }

        }
        else {
    ?>
            <h1>Sistema de login e senha criptografados</h1>
            <div class="borda"></div>
            <p>Proibido o acesso por esse meio. Volte e informe os dados corretamente!</p>
            <p><a href="../index.php">Página inicial</a></p>
    <?php } ?>
    </div>
</body>
</html>