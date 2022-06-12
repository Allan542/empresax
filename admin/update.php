
<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Atualização de dados</title>
    </head>
    <body>
        <div id="conteudo">
        <?php
            include "../conexao.php";

            session_cache_expire(5);
            session_start();

            function criptoSenha($criptoSenha){
                return md5($criptoSenha);
            }

            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if($_SESSION['login']){
                $refresh = "<meta http-equiv='refresh' content='5; url=usuariosCadastrados.php'>";

                $recebeId = $_POST['id'];
                $filtraId = filter_var($recebeId, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtraId = filter_var($filtraId, FILTER_SANITIZE_ADD_SLASHES);

                $recebeNome = $_POST['nome'];
                $filtraNome = filter_var($recebeNome, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtraNome = filter_var($filtraNome, FILTER_SANITIZE_ADD_SLASHES);

                $recebeEmail = $_POST['email'];
                $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);
                
                $recebeIdade = $_POST['idade'];
                $filtraIdade = filter_var($recebeIdade, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtraIdade = filter_var($filtraIdade, FILTER_SANITIZE_ADD_SLASHES);

                $newSenha = $_POST['new_pass'];
                $filtra_newSenha = filter_var($newSenha, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtra_newSenha = filter_var($filtra_newSenha, FILTER_SANITIZE_ADD_SLASHES);

                $conf_newSenha = $_POST['conf_new_pass'];
                $filtra_conf_newSenha = filter_var($conf_newSenha, FILTER_SANITIZE_SPECIAL_CHARS);
                $filtra_conf_newSenha = filter_var($filtra_conf_newSenha, FILTER_SANITIZE_ADD_SLASHES);

                $cripto_newSenha = criptoSenha($filtra_newSenha);
                $cripto_conf_newSenha = criptoSenha($filtra_conf_newSenha);

                $sql=mysqli_query($conecta, "SELECT * FROM tblusuario WHERE id_tblusuario = $filtraId") or die(mysqli_error($conecta));
                $result=mysqli_fetch_assoc($sql);

                $recebe_chkAdmin = isset($_POST['chk_admin']) ? $_POST['chk_admin'] : 
                    ($_SESSION['tipo_usuario'] == "Master" && $_SESSION['id_usuario'] == $result['id_tblusuario'] ? "Master" : "Usuário");
        ?>
                <h1>Atualização de dados</h1>
                <div class="borda"></div>
        <?php
                if ($cripto_newSenha != $cripto_conf_newSenha){
                    echo "<p>A nova senha e a confirmação da nova senha não são iguais. Por favor, <a href='javascript:history.back();'>volte</a> e tente novamente!</p>";
                    return false;
                }
                else {
                    if ($recebe_chkAdmin == "Administrador"){
                        $query = "UPDATE tblusuario SET nome_tblusuario = '$filtraNome', email_tblusuario = '$filtraEmail',  idade_tblusuario = '$filtraIdade', senha_tblusuario = '$cripto_newSenha', tipo_tblusuario='$recebe_chkAdmin' WHERE id_tblusuario = " . $filtraId;
                    } else if ($recebe_chkAdmin == "Usuário"){
                        $_SESSION['login'] = $result['tipo_tblusuario'] == "Administrador" && $_SESSION['id_usuario'] == $result['id_tblusuario'] ? false : true;

                        $query = "UPDATE tblusuario SET nome_tblusuario = '$filtraNome', email_tblusuario = '$filtraEmail', idade_tblusuario = '$filtraIdade', senha_tblusuario = '$cripto_newSenha', tipo_tblusuario = '$recebe_chkAdmin' WHERE id_tblusuario = " . $filtraId;
                    } else {
                        $query = "UPDATE tblusuario SET nome_tblusuario = '$filtraNome', email_tblusuario = '$filtraEmail',  idade_tblusuario = '$filtraIdade', senha_tblusuario = '$cripto_newSenha' WHERE id_tblusuario = " . $filtraId;
                    }
                    mysqli_query($conecta, $query) or die(mysqli_error($conecta));
                    echo "<p>Dados atualizados com sucesso!";
                    exit($refresh);
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
