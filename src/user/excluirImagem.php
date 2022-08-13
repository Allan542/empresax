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
    echo '<title>Excluir Imagem</title>';
    echo '</head>';

    if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
    if($_SESSION['login']) {
        $idUserLogado = $_SESSION['id_usuario'];

        $sql = mysqli_query($conecta, "SELECT foto_perfil_tblusuario
            FROM tblusuario WHERE id_tblusuario=$idUserLogado")
            or die(mysqli_error($conecta))
        ;
        $result = mysqli_fetch_assoc($sql);
        
        if($result['foto_perfil_tblusuario'] == '') {
            $script = "<script>\n" . 
                "alert('ERRO! Você não tem uma foto de perfil para ser excluída.')\n" . 
                "history.back()\n" . 
                "</script>"
            ;
        } else {
                $deletaFoto = mysqli_query($conecta, "UPDATE tblusuario
                    SET foto_perfil_tblusuario=NULL WHERE id_tblusuario=$idUserLogado")
                    or die(mysqli_error($conecta))
                ;
                $script = '<script>history.back()</script>';
        }
        exit($script);
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