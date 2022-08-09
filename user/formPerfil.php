<?php
    session_cache_expire(5);
    session_start();
    include "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/atualizaPerfil.js"></script>
    <title>Perfil de Usuário</title>
</head>
<body>
    <div id="conteudo">
    <?php
        if($_SESSION['login']){
            $sql = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE id_tblusuario = " . $_SESSION['id_usuario']) or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);
    ?>
            <div class="box-troca-img" onclick="mostraMudarImagem()">
                <form action="trocaImagem.php" method="post" class="form-troca-img">
                    <input type="file" name="image" accept="image/*">
                    <input type="submit" value="Confirmar" class="botao botao-troca-img">
                </form>
            </div>

            <h1>Perfil de Usuário</h1>
            <div class="borda"></div>
            <div class="espaco"></div>
            
            <a href="../content/conteudoExclusivo.php">
                <button class="botao">Voltar para o conteúdo</button>
            </a>
            <div class="clear"></div>

            <div id="perfil">
                <img src="../assets/images/profile/default.png" alt="Foto de perfil" class="perfil-foto">
                <div class='perfil-nome'><?php echo $result['nome_tblusuario'] . ', ' . $result['idade_tblusuario'] . ' Anos'; ?></div>
                <div class='perfil-email'><?php echo $result['email_tblusuario']; ?></div>
            <?php
                if($result['opc_pergunta_secreta'] != ''){
            ?>
                    <div class="perfil-pergunta-secreta">
                        <div><strong>PERGUNTA SECRETA:</strong></div>
                        <div>
                            <?php echo $result['opc_pergunta_secreta'] . ': ' . $result['resp_pergunta_secreta']; ?>
                        </div>
                    </div>
            <?php } ?>
            </div>

            <div class="espaco"></div>
            <div class="centralizar">
                <button class="botao" onclick="mostraMudarImagem()">Mudar Imagem</button>
            </div>
            <div class="clear"></div>

            <div class="espaco"></div>
            <div class="borda"></div>
            <div class="espaco"></div>

            <button class="botao botao-perfil" onclick="mostraAtualizaPerfil()">Atualizar perfil</button>

            <div class="clear"></div>
            <form action="atualizaPerfil.php" method="post" class="form-perfil">
                <p>Atualize as informações abaixo, porém apenas o e-mail não é permitido ser atualizado. Para isso, contate um administrador.</p>
                <fieldset>
                    <legend>Atualizar Informações</legend>
                    <label for="nome">Nome:</label>
                    <input type="text"
                        name="nome"
                        class="txtDados"
                        value="<?php echo $result['nome_tblusuario']; ?>"
                    >
                    
                    <div class="clear"></div>
                    <label for="email">Email:</label>
                    <input type="email"
                        name="email"
                        class="txtDados"
                        disabled
                        value="<?php echo $result['email_tblusuario']; ?>"
                    >
                    
                    <div class="clear"></div>
                    <label for="idade">Idade:</label>
                    <input type="idade"
                        name=""
                        class="txtDados"
                        required
                        value="<?php echo $result['idade_tblusuario']; ?>"
                    >
                    
                    <div class="clear"></div>
                    <label for="senha">Senha atual:</label>
                    <input type="password"
                        name="old_pass"
                        class="txtDados"
                        required
                    >
                    
                    <div class="clear"></div>
                    <label for="senha">Senha nova:</label>
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
                    <input type="submit" value="Enviar" class="botaoForm">
                </fieldset>
            </form>
    <?php     
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