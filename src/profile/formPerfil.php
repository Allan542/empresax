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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style-perfil.css">
    <script src="../../assets/js/perfil.js"></script>
    <script src="../../assets/js/expandeFoto.js"></script>
    <title>Perfil de Usuário</title>
</head>
<body>
    <div id="conteudo">
    <div class="expandir" onclick="expandeFoto('')">
        <img class="expandir-foto" alt="Foto Ampliada">
    </div>
    <?php
        if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
        if($_SESSION['login']){
            $sql = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE id_tblusuario = " . $_SESSION['id_usuario']) or die(mysqli_error($conecta));
            $result = mysqli_fetch_assoc($sql);

            $img = '';
            if($result['foto_perfil_tblusuario'] != '') {
                $img = $result['foto_perfil_tblusuario'];
            } else {
                $img = 'default/default.png';
            }
    ?>
            <div class="box-troca-img">
                <form action="trocaImagem.php" method="post" enctype="multipart/form-data" class="form-troca-img">
                    <input type="file" name="image" id="image" accept="image/*">
                    <input type="submit" name="botao" value="Confirmar" class="botao botao-troca-img">
                </form>
                <div class="box-exclui-img">
                    <button class="botao botao-exclui-img" onclick="perguntaExcluirFoto()"><a class="link-exclui-foto"><div>Excluir foto atual</div></a></button>
                </div>
                <button class="botao botao-esconder" onclick="mostraMudarFotoPerfil()">Cancelar</button>
            </div>

            <h1>Perfil de Usuário</h1>
            <div class="borda"></div>
            <div class="espaco"></div>
            
            <a href="../content/conteudoExclusivo.php">
                <button class="botao">Voltar para o conteúdo</button>
            </a>
            <div class="clear"></div>

            <div class="logout">
                <p class="sairSistema">
                    <a href="../user/logout.php">Clique aqui</a> para sair do sistema
                </p>
            </div>
            <div class="clear"></div>

            <div id="perfil">
                <img
                    src="../../assets/images/profile/<?php echo $img; ?>"
                    alt="Foto de perfil"
                    class="perfil-foto"
                    onclick="expandeFoto('../../assets/images/profile/<?php echo $img; ?>', 'perfil')"
                >
                <div class='perfil-nome'><?php echo $result['nome_tblusuario'] . ', ' . $result['idade_tblusuario'] . ' anos'; ?></div>
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
                <button class="botao" onclick="mostraMudarFotoPerfil()">Mudar foto</button>
            </div>
            <div class="clear"></div>

            <div class="espaco"></div>
            <div class="borda"></div>
            <div class="espaco"></div>

            <button class="botao botao-perfil" onclick="mostraAtualizarDados('.atualiza-infos')">Atualizar perfil</button>
            <button class="botao botao-perfil" onclick="mostraAtualizarDados('.atualiza-senha')">Atualizar senha</button>

            <div class="clear"></div>
            <form action="atualizaInformacoes.php" method="post" class="atualiza-infos">
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
                        name="idade"
                        class="txtDados"
                        required
                        value="<?php echo $result['idade_tblusuario']; ?>"
                    >

                    <div class="clear"></div>
                    <div class="box-chk-att-pergunta">
                        <label for="chk-att-pergunta">Deseja atualizar a pergunta secreta?</label>
                        <div>
                            <input 
                                type="checkbox"
                                name="chk-att-pergunta"
                                value="Sim"
                                onchange="mostraPerguntaSecreta(<?php echo '\'' . $result['opc_pergunta_secreta'] . '\'';?>)"
                                <?php echo $result['opc_pergunta_secreta'] == "" ? "checked" : ""; ?>
                            >
                            <span>Sim</span>
                            </div>
                    </div>

                    <div class="clear"></div>
                    <div class="box-pergunta-secreta">
                        <label for="pergunta">Pergunta secreta:</label>
                        <div class="select-div">
                            <select name="pergunta" class="select-box">
                                <option
                                    value=""
                                >Selecione...</option>
                                <option
                                    <?php echo $result['opc_pergunta_secreta'] == 
                                        "O nome do seu pet" ? "selected" : ""; ?>
                                >O nome do seu pet</option>
                                <option
                                    <?php echo $result['opc_pergunta_secreta'] == 
                                        "O nome do(a) seu/sua primeiro(a) professor(a)"? "selected" : ""; ?>
                                >O nome do(a) seu/sua primeiro(a) professor(a)</option>
                                <option
                                    <?php echo $result['opc_pergunta_secreta'] == 
                                        "O seu primeiro endereço" ? "selected" : ""; ?>
                                >O seu primeiro endereço</option>
                                <option
                                    <?php echo $result['opc_pergunta_secreta'] == 
                                        "A sua cor favorita" ? "selected" : ""; ?>
                                >A sua cor favorita</option>
                                <option
                                    <?php echo $result['opc_pergunta_secreta'] == 
                                        "O seu animal favorito" ? "selected" : ""; ?>
                                >O seu animal favorito</option>
                            </select>
                        </div>
                        
                        <label for="Resposta">Resposta secreta:</label>
                        <input type="text"
                            name="resposta"
                            class="txtDados txtResposta"
                            placeholder="Digite a sua resposta..."
                            required
                        >
                    </div>

                    <div class="clear"></div>
                    <label for="conf_pass">Confirme sua Senha:</label>
                    <input type="password"
                        name="conf_pass"
                        class="txtDados"
                        required
                        placeholder="Confirme sua senha..."
                    >
                    
                    <div class="clear"></div>
                    <input type="submit" value="Enviar" class="botaoForm">
                </fieldset>
            </form>

            <div class="espaco"></div>
            <form action="atualizaSenha.php" method="post" class="atualiza-senha">
                <p>Atualize sua senha abaixo.</p>
                <fieldset>
                    <legend>Atualizar Senha</legend>
                    <label for="senha">Senha atual:</label>
                    <input type="password"
                    name="current_pass"
                    class="txtDados"
                    required
                    placeholder="Senha atual..."
                    >
                    
                    <div class="clear"></div>
                    <label for="senha">Nova senha:</label>
                    <input type="password"
                    name="new_pass"
                    class="txtDados"
                    required
                    placeholder="Nova senha..."
                    >
                    
                    <div class="clear"></div>
                    <label for="senha">Senha novamente:</label>
                    <input type="password"
                    name="conf_new_pass"
                    class="txtDados"
                    required
                    placeholder="Repita a nova senha..."
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