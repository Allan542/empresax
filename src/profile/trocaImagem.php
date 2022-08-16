<?php
    include "../conexao.php";
    session_cache_expire(5);
    session_start();

    echo '<!DOCTYPE html>';
    echo '<html lang="pt-BR">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="stylesheet" href="../../assets/css/style.css">';
    echo '<title>Trocar Imagem</title>';
    echo '</head>';

    if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
    if($_SESSION['login']){
        $script = '';
        $img = $_FILES["image"];
        $botao = $_POST['botao'];

        if($botao == "Confirmar"){
            if(($img["type"] == "image/png"  || $img["type"] == "image/jpg" || 
                $img["type"] == "image/jpeg") && $img["size"] < 3 * 1024 * 1024 ) {
                move_uploaded_file($img["tmp_name"], "../../assets/images/profile/" . $img['name']);
                $sql = mysqli_query($conecta, "UPDATE tblusuario SET foto_perfil_tblusuario = '" . $img['name'] . "' WHERE id_tblusuario = " . $_SESSION['id_usuario']) or die(mysqli_error($conecta));
                $script = '<script>history.back()</script>';
            } else {
                $script = '<script>'. "\n" . 
                 'alert("ERRO! Arquivo inválido")' . "\n" . 
                 'history.back()' . "\n" . 
                 '</script>';
            }
            exit($script);
        } else {
            
        }
    } else {
        echo '<body>';
        echo '<div id="conteudo">';
        echo '<h1>Sistema de login e senha criptografados</h1>';
        echo '<div class="borda"></div>';
        echo '<p>Proibido o acesso por esse meio. Volte e informe os dados corretamente!</p>';
        echo '<p><a href="../index.php">Página inicial</a></p>';
        echo '</div>';
        echo '</body>';
        echo '</html>';
    }
?>

