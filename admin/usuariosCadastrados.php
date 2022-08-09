<?php
    include "../conexao.php";

    session_cache_expire(5);
    session_start();
    $sql=mysqli_query($conecta, "SELECT * FROM tblusuario ORDER BY nome_tblusuario")  or die(mysqli_error($conecta));
?>

<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Listagem de conteúdo</title>
    </head>
    <body>
        <div id="conteudo">
        <?php
            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if ($_SESSION['login']){
        ?>
                <h1>Tabela de Usuários Cadastrados</h1>
                <div class="borda"></div>
                <div class="espaco"></div>
                <a href="../content/conteudoExclusivo.php">
                    <button class="botao">Voltar ao Conteúdo</button>
                </a>
                <div class="clear"></div>
                <div class="logout">
                    <p class="sairSistema">
                        <a href="../user/logout.php">Clique aqui</a> para sair do sistema
                    </p>
                </div>
                <div class="clear"></div>
                <p>
                    Olá, <strong class="<?php echo $_SESSION['tipo_usuario'] == "Master" ? "destaca" : "admin"; ?>">
                        <?php echo $_SESSION['nome_usuario']; ?></strong>!
                        Selecione um usuário para atualizar seus dados ou para excluí-lo!
                </p>
                <p>
                    Cor amarela com preenchimento representa o Master e a cor vermelha, os Administradores.
                </p>
                <div class="dheader">Nome</div>
                <div class="dheader">Email</div>
                <div class="dheader">Ação</div>
                <div class="clear"></div>
                <?php
                    while ($result=mysqli_fetch_assoc($sql)){
                        $cor_user = $result['tipo_tblusuario'] == "Administrador" ? "admin" : 
                        ($result['tipo_tblusuario'] == "Master" ? "master destaca" : ""); 
                ?>
                        <div class="content <?php echo $cor_user; ?>">
                            <?php echo $result['nome_tblusuario']; ?>
                        </div>
                        <div class="content <?php echo $cor_user; ?>">
                            <?php echo $result['email_tblusuario']; ?>
                        </div>
                        <div class="content acao">
                            <a href="formUpdate.php?id=<?php echo $result['id_tblusuario'];?>">Atualizar</a>
                        </div>
                        <div class="content acao">
                            <a href="excluir.php?id=<?php echo $result['id_tblusuario'];?>">Excluir</a>
                        </div>
                        <div class="clear"></div>
                <?php } ?>
                <p>
                    <a href="graficoUsuarios.php">Clique aqui</a> para abrir o relatório por idade de usuários cadastrados!
                </p>
                <p>
                    <a href="pdfUsuarios.php" target="_blank">Imprimir Tabela em PDF</a>
                </p>
        <?php } else { ?>
                <h1>Sistema de login e senha criptografados</h1>
                <div class="borda"></div>
                <p>Proibido o acesso por esse meio. Volte e informe os dados corretamente!</p>
                <p><a href="../index.php">Página inicial</a></p>
        <?php } ?>
        </div>
    </body>
</html>