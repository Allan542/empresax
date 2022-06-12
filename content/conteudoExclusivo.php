<?php
    session_cache_expire(5);
    session_start();
    include "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Conteúdo Exclusivo</title>
</head>
<body>
    <div id="conteudo">
        <?php
            if (!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if ($_SESSION['login']){
        ?>
                <h1 style="margin-top:8px;">
                    <span class="destaca"><?php echo $_SESSION['nome_usuario']; ?></span>, seja bem-vindo ao Conteúdo Exclusivo
                </h1>
                <div class="borda"></div>
                <div class="clear"></div>
                <div class="espaco"></div>
                <?php if ($_SESSION['tipo_usuario'] == "Administrador" || $_SESSION['tipo_usuario'] == "Master") { ?>
                    <a href="../admin/usuariosCadastrados.php">
                        <button class="botao">Acessar usuários conectados</button>
                    </a>
                <?php } ?>
                <div class="clear"></div>
                <div class="logout">
                    <p class="sairSistema">
                        <a href="../user/logout.php">Clique aqui</a> para sair do sistema
                    </p>
                </div>
                <div class="clear"></div>
                <h3>Conteúdo exclusivo 01</h3>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae doloribus aut odio dicta sequi eum in iste cum laborum, et consequuntur blanditiis eius quia enim ipsa doloremque. Doloribus, magni vitae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum excepturi iusto vel repellendus laudantium. Totam accusamus ipsum alias dolores, id delectus repellendus nisi repudiandae rerum, aliquid officia magni, inventore deleniti! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam dignissimos facilis voluptas possimus debitis nobis assumenda beatae ipsam placeat ratione qui officia iusto a, veniam rem quam delectus, optio harum.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis mollitia officia qui. Exercitationem voluptates sequi velit repudiandae laboriosam inventore! Dicta minima perferendis laborum labore reiciendis quidem aliquam adipisci corrupti non. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione, laborum. Eveniet eaque culpa distinctio qui, eos quo expedita harum quod ipsa. Maxime asperiores maiores eaque sapiente? Natus ab totam est? Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, quidem consequuntur magni cumque fugiat porro harum assumenda blanditiis ea perspiciatis aperiam minima sunt aut laborum itaque dolor quo excepturi magnam?
                </p>
                <div class="borda"></div>
                <h3>Conteúdo exclusivo 02</h3>
                <p>
                    Neste conteúdo, estará disponível alguns discos de três bandas e um gráfico mostrando quantos discos no total tem cada uma delas.
                </p>
                <p>
                    <a href="graficoBandas.php">Clique aqui</a> para acessar este conteúdo!
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