<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Exclusão de dados</title>
    </head>
    <body>
        <div id="conteudo">
        <?php
            include "../conexao.php";
            session_cache_expire(5);
            session_start();

            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if($_SESSION['login']){
                $recebeId = $_GET['id'];
                $query = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE id_tblusuario = $recebeId") or die(mysqli_error($conecta));
                $result = mysqli_fetch_assoc($query);

                if(($_SESSION['tipo_usuario'] == "Master" && $_SESSION['id_usuario'] != $result['id_tblusuario']) ||
                    $result['tipo_tblusuario'] == "Usuário"){
                    $filtraId = filter_var($recebeId, FILTER_SANITIZE_SPECIAL_CHARS);
                    $filtraId = filter_var($filtraId, FILTER_SANITIZE_ADD_SLASHES);

                    $sql="DELETE FROM tblusuario WHERE id_tblusuario = $filtraId";
        ?>
                    <h1>Exclusão de dados</h1>
                    <div class="borda"></div>
        <?php
                    if(mysqli_query($conecta, $sql)){
                        echo "<p>Registro excluído com sucesso!</p>";
                        echo "<p><a href='javascript:history.back();'>Volte</a> para a página anterior! Obrigado!</p>";
                    }
                    else {
                        echo "<p>Erro ao excluir o registro!</p>";
                        echo "<p><a href='javascript:history.back();'>Volte</a> para a página anterior! Obrigado!</p>";
                    }
                } else {
                    $script = "<script>\n";
                    $script .= "window.alert('ERRO! Você só pode excluir outros usuários que não sejam Administradores, o Master ou você mesmo!')\n";
                    $script .= "history.back()\n";
                    $script .= "</script>\n";
                    echo $script;
                }
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