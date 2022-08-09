<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <script src="../js-library/RGraph.common.core.js"></script>
        <script src="../js-library/RGraph.common.tooltips.js"></script>
        <script src="../js-library/RGraph.common.dynamic.js"></script>
        <script src="../js-library/RGraph.bar.js"></script>
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

        <script>
            window.onload = function (){
                bar = new RGraph.Bar({
                    id: 'cvs',
                    data: <?php echo $dadosBandas; ?>,
                    options: {
                        
                        // Add some X-axis labels - you can use a newline character (\n) to make
                        // the label span multiple lines
                        colors: ['#00CED1'],
                        title: 'Bandas Cadastradas',
                        titleSize: 14,
                        titleBold: true,
                        xaxis: true,
                        yaxis: true,
                        marginLeft: 0,
                        marginRight: 0,
                        marginTop: 50,
                        tooltips: '%{property:myNames[%{index}]} %{property:xaxisLabels[%{dataset}]} tem %{value} discos.',
                        tooltipsCss: {
                            fontSize: '10pt',
                            backgroundColor: '#f9fac1',
                            color: 'black'
                        },
                        tooltipsEvent: 'mousemove',
                        backgroundBarsColor1: 'white',
                        backgroundBarsColor2: 'white',
                        textFont: 'Georgia',
                        shadow: true,
                        shadowBlur: 5,
                        shadowOffsetY: -3,
                        grouping: 'stacked',
                        // xaxisLabelsAngle: 45,
                        xaxisLabelsOffsety: 2,
                        yaxisTitle: 'Número de discos cadastrados',
                        yaxisTitleBold: true
                    }
                }).draw().responsive([
                    {maxWidth:null,width:700,height:350,options: {textSize:12,xaxisLabels: <?php echo $nomeBandas; ?>, marginInner: 5}, parentCss: {textAlign: 'center'}},
                    {maxWidth:900,width:984,height:400, options: {textSize:12,xaxisLabels: <?php echo $nomeBandas; ?>, marginInner: 5}, parentCss: {textAlign: 'center'}}
                ])
            }
        </script>
        <script src="../assets/js/manipulaFoto.js"></script>
    </head>
    <body>
        <div id="conteudo">
            <div class="expandir" onclick="expandeFoto('')">
                <img class="expandir-foto" alt="Foto Ampliada">
            </div>
        <?php
            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if($_SESSION['login']){
        ?>
                <h1>Gráfico de Bandas Cadastradas</h1>
                <div class="borda"></div>
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
                                        src="../assets/<?php echo $resultdiscos['capa_tbl_discos']; ?>"
                                        alt="Capa do álbum"
                                        title="<?php echo $resultdiscos['titulo_tbl_discos']; ?>"
                                        onclick="expandeFoto('../assets/<?php echo $resultdiscos['capa_tbl_discos']; ?>')"
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