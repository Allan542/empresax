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
        <script src="../../assets/js/manipulaFoto.js"></script> <!-- Arquivo que contém a função para expandir fotos -->
        <title>Gráfico de Bandas Cadastradas</title>
        <?php
            include "../conexao.php";

            $sqlbandas=mysqli_query($conecta, "SELECT * FROM tbl_bandas");
            session_cache_expire(5);
            session_start();

            $i=1;
            while($result = mysqli_fetch_assoc($sqlbandas)){
                $bandas[$i] = $result['nome_tbl_bandas'];
                $idbanda[$i] = $result['id_tbl_bandas'];
                $sqldiscos=mysqli_query($conecta, "SELECT * FROM tbl_discos WHERE id_tbl_bandas = $i");
                $result = mysqli_fetch_assoc($sqldiscos);
                $qte[$i] = mysqli_num_rows($sqldiscos);
                $i++;
            }
            $aux=$i;
            $i=1;
            $dadosBandas="";
            while ($i <= $aux-1){
                if ($i == $aux-1){
                    $dadosBandas = $dadosBandas . $qte[$i];
                }
                else {
                    $dadosBandas = $dadosBandas . $qte[$i] . ",";
                }
                $i++;
            }
            $dadosBandas = join(",",array($dadosBandas));
            $dadosBandas = "[$dadosBandas]";

            $i=1;
            $nomeBandas="";
            while ($i <= $aux-1){
                if ($i == $aux-1){
                    $nomeBandas = $nomeBandas . "'" . $bandas[$i] . "'";
                }
                else {
                    $nomeBandas = $nomeBandas . "'" . $bandas[$i] . "',";
                }
                $i++;
            }
            $nomeBandas = join(",",array($nomeBandas));
            $nomeBandas = "[$nomeBandas]";
        ?>
        <script> /* Chama a função que renderizará o gráfico no momento que a tela carregar */
            window.onload = function () {
                graficoBandas(<?php echo $dadosBandas . ", " . $nomeBandas; ?>) // parameters via php
            }
        </script>
    </head>
    <body>
        <div id="conteudo">
            <div class="expandir" onclick="expandeFoto('')">
                <img class="expandir-foto" alt="Foto Ampliada">
            </div>
        <?php
            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if($_SESSION['login']){
                $sqlImg = mysqli_query($conecta, "SELECT foto_perfil_tblusuario FROM tblusuario WHERE id_tblusuario=" . $_SESSION['id_usuario']) or die(mysqli_error($conecta));
                $result = mysqli_fetch_assoc($sqlImg);
                $img = $result['foto_perfil_tblusuario'] == ""? "default/default.png" : $result['foto_perfil_tblusuario'];
        ?>
                <h1>Gráfico de Bandas Cadastradas</h1>
                <div class="borda"></div>
                <div class="espaco"></div>

                <div class="box-icone-foto">
                    <a href="../user/formPerfil.php"><img 
                        src="../../assets/images/profile/<?php echo $img; ?>"
                        alt="Foto de perfil"
                        class="icone-foto-perfil"
                    ><span class="texto-icone-foto">Acessar perfil</span></a>
                </div>

                <div class="clear"></div>
                <div class="espaco"></div>
                <a href="conteudoExclusivo.php">
                    <button class="botao">Voltar ao conteúdo</button>
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

                <p><a href="pdfBandas.php" target="_blank">Imprimir discos das bandas</a></p>
                <div class="clear"></div>
                <?php
                    $sqlbandas=mysqli_query($conecta, "SELECT * FROM tbl_bandas");
                    while ($resulta=mysqli_fetch_assoc($sqlbandas)){
                ?>
                        <h1><?php echo $resulta['nome_tbl_bandas']; ?></h1>
                        <div class="borda"></div>
                        <?php
                            $sqldiscos=mysqli_query($conecta, "SELECT * FROM tbl_discos WHERE id_tbl_bandas = " . $resulta['id_tbl_bandas'])  or die(mysqli_error($conecta));
                            while ($resultdiscos=mysqli_fetch_assoc($sqldiscos)){
                        ?>
                                <div class="discos">
                                    <span class="titulo_disco"><?php echo $resultdiscos['titulo_tbl_discos']; ?></span>
                                    <img 
                                        src="../../assets/<?php echo $resultdiscos['capa_tbl_discos']; ?>"
                                        alt="Capa do álbum"
                                        title="<?php echo $resultdiscos['titulo_tbl_discos']; ?>"
                                        onclick="expandeFoto('../../assets/<?php echo $resultdiscos['capa_tbl_discos']; ?>')"
                                    >
                                </div>
                        <?php } ?>
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