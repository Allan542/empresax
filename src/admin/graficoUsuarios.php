<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <script src="../../assets/js-library/RGraph.common.core.js"></script>
        <script src="../../assets/js-library/RGraph.common.tooltips.js"></script>
        <script src="../../assets/js-library/RGraph.common.dynamic.js"></script>
        <script src="../../assets/js-library/RGraph.bar.js"></script> <!-- bibliotecas que renderizarão o gráfico -->
        <script src="../../assets/js/graficos.js"></script> <!-- importando o gráfico aqui -->
        <title>Gráfico de Usuários Cadastrados</title>
        <?php
            include "../conexao.php";
            session_cache_expire(5);
            session_start();

            $sql=mysqli_query($conecta, "SELECT * FROM tblusuario ORDER BY idade_tblusuario");
            $i=0;
            while($result = mysqli_fetch_assoc($sql)){
                $nome[$i] = $result['nome_tblusuario'];
                $idade[$i] = $result['idade_tblusuario'];
                $i++;
            }
            $aux=$i;
            $i=0;
            $dadosIdades="";
            while ($i <= $aux-1){
                if ($i == $aux-1){
                    $dadosIdades = $dadosIdades . $idade[$i];
                }
                else {
                    $dadosIdades = $dadosIdades . $idade[$i] . ",";
                }
                $i++;
            }
            $dadosIdades = join(",",array($dadosIdades));
            $dadosIdades = "[$dadosIdades]";

            $i=0;
            $dadosNomes="";
            while ($i <= $aux-1){
                if ($i == $aux-1){
                    $dadosNomes = $dadosNomes . "'" .$nome[$i] . "'";
                }
                else {
                    $dadosNomes = $dadosNomes . "'" . $nome[$i] . "',";
                }
                $i++;
            }
            $dadosNomes = join(",",array($dadosNomes));
            $dadosNomes = "[$dadosNomes]";
        ?>
        <script> /* Chama a função que renderizará o gráfico no momento que a tela carregar*/
            window.onload = function (){
                graficoUsuarios(<?php echo $dadosIdades . ", " . $dadosNomes; ?>) // parameters via php
            }
        </script>
    </head>
    <body>
        <div id="conteudo">
        <?php 
            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if($_SESSION['login']){
                $sqlImg = mysqli_query($conecta, "SELECT foto_perfil_tblusuario FROM tblusuario WHERE id_tblusuario=" . $_SESSION['id_usuario']) or die(mysqli_error($conecta));
                $result = mysqli_fetch_assoc($sqlImg);
                $img = $result['foto_perfil_tblusuario'] == ""? "default/default.png" : $result['foto_perfil_tblusuario'];
        ?>
                <h1>Gráfico de Usuários Cadastrados</h1>

                <div class="borda"></div>
                <div class="espaco"></div>
                <div class="box-icone-foto" title="Acessar perfil">
                    <a href="../profile/formPerfil.php">
                        <img 
                            src="../../assets/images/profile/<?php echo $img; ?>"
                            alt="Foto de perfil"
                            class="icone-foto-perfil"
                        >
                        <span class="texto-icone-foto">Acessar perfil</span>
                    </a>
                </div>

                <div class="clear"></div>
                <div class="espaco"></div>
                <a href="usuariosCadastrados.php">
                    <button class="botao">Voltar aos Usuários Cadastrados</button>
                </a>

                <div class="clear"></div>
                <div class="logout">
                    <p class="sairSistema">
                        <a href="../user/logout.php">Clique aqui</a> para sair do sistema
                    </p>
                </div>

                <div class="clear"></div>
                <div style="width: 1000px; height: 500px;">
                    <canvas id="cvs" width="984" height="400">[No canvas support]</canvas>
                </div>

                <div class="dheader">Nome</div>
                <div class="dheader">Email</div>
                <div class="dheader">Idade</div>
                
                <div class="borda"></div>
                <div class="clear"></div>
            <?php
                $sql1=mysqli_query($conecta, "SELECT * FROM tblusuario ORDER BY idade_tblusuario")  or die(mysqli_error($conecta));
                while ($resulta=mysqli_fetch_assoc($sql1)){
                    $cor_user = $resulta['tipo_tblusuario'] == "Administrador" ? "admin" : 
                    ($resulta['tipo_tblusuario'] == "Master" ? "master destaca" : ""); 
            ?>
                    <div class="content <?php echo $cor_user; ?>">
                        <?php echo $resulta['nome_tblusuario']; ?>
                    </div>
                    <div class="content <?php echo $cor_user; ?>">
                        <?php echo $resulta['email_tblusuario']; ?>
                    </div>
                    <div class="content <?php echo $cor_user; ?>">
                        <?php echo $resulta['idade_tblusuario']; ?>
                    </div>
                    <div class="clear"></div>
        <?php 
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