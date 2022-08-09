<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Atualização de dados cadastrais do usuário</title>
</head>
<body>
    <div id="conteudo">
    <?php
        include "../conexao.php";
        session_cache_expire(5);
        session_start();

        if (!isset($_SESSION['login'])) $_SESSION['login'] = false;
        if ($_SESSION['login']){
            $recebeId = $_GET['id'];
            $filtraId = filter_var($recebeId, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraId = filter_var($filtraId, FILTER_SANITIZE_ADD_SLASHES);

            $sql=mysqli_query($conecta, "SELECT * FROM tblusuario WHERE id_tblusuario = $filtraId") or die(mysqli_error($conecta));
            $result=mysqli_fetch_assoc($sql);

            if($_SESSION['tipo_usuario'] == "Master" ||
                ($_SESSION['tipo_usuario'] == "Administrador" && 
                    $_SESSION['id_usuario'] == $result['id_tblusuario']) || 
                        $result['tipo_tblusuario'] == "Usuário"){
    ?>
                <h1>Atualização de dados cadastrais do usuário</h1>
                <div class="borda"></div>
                <div class="espaco"></div>
                <a href="usuariosCadastrados.php">
                    <button class="botao">Voltar aos Usuários Cadastrados</button>
                </a>
                <div class="clear"></div>
                <form action="update.php" method="post">
                    <fieldset>
                        <legend>Dados cadastrais</legend>
                        <input type="hidden" name="id" id="id" value="<?php echo $result['id_tblusuario']; ?>">

                        <label for="nome">Nome:</label>
                        <input type="text" 
                            name="nome" 
                            class="txtDados" 
                            value="<?php echo $result['nome_tblusuario']; ?>"
                            autofocus
                        >
                        
                        <div class="clear"></div>
                        <label for="email">Email:</label>
                        <input type="email"
                            name="email"
                            class="txtDados" 
                            value="<?php echo $result['email_tblusuario'];?>" 
                            <?php echo $_SESSION['tipo_usuario'] != "Master" ? "readonly" : ""; ?>
                        >
                        
                        <div class="clear"></div>
                        <label for="idade">Idade:</label>
                        <input type="number"
                            name="idade"
                            class="txtDados"
                            value="<?php echo $result['idade_tblusuario']; ?>"
                        >
                        
                        <div class="clear"></div>
                        <label for="senha">Senha Nova:</label>
                        <input type="password" 
                            name="new_pass" 
                            class="txtDados" 
                            required
                        >
                        
                        <div class="clear"></div>
                        <label for="senha">Senha novamente:</label>
                        <input type="password"
                            name="conf_new_pass"
                            class="txtDados"
                            required
                            >

                        <div class="clear"></div>

                    <?php if ($_SESSION['tipo_usuario'] == 'Master') {?>
                            <label for="chk_admin">Administrador:</label>
                            <input type="checkbox"
                                name="chk_admin"
                                class="checkbox" 
                                <?php 
                                    echo $result['tipo_tblusuario'] == "Administrador" ? "checked" : "";echo $result['tipo_tblusuario'] == "Master" ? "disabled" : ""; 
                                ?>
                                value="Administrador"
                            >
                    <?php
                        } else {   
                    ?>
                            <label for="chk_admin">Administrador:</label>
                            <input type="checkbox"
                                name="chk_admin"
                                class="checkbox" 
                                <?php 
                                    echo $result['tipo_tblusuario'] == "Administrador" ? "checked" : ""; 
                                ?> 
                                value="Administrador"
                            >
                    <?php } ?>
                        <div class="clear"></div>
                        <input type="submit" value="Atualizar" class="botaoForm">
                    </fieldset>
                </form>
    <?php
            } else {
                $script = "<script>\n";
                $script .= "window.alert('ERRO! Você pode alterar apenas seus dados e de outros usuários, mas não de administradores.')\n";
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