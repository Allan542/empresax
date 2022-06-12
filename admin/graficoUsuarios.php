<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Allan Carlos">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js-library/RGraph.common.core.js"></script>
        <script src="../js-library/RGraph.common.tooltips.js"></script>
        <script src="../js-library/RGraph.common.dynamic.js"></script>
        <script src="../js-library/RGraph.bar.js"></script>
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
            $dadosNome="";
            while ($i <= $aux-1){
                if ($i == $aux-1){
                    $dadosNome = $dadosNome . "'" .$nome[$i] . "'";
                }
                else {
                    $dadosNome = $dadosNome . "'" . $nome[$i] . "',";
                }
                $i++;
            }
            $dadosNome = join(",",array($dadosNome));
            $dadosNome = "[$dadosNome]";
        ?>

        <script>
            window.onload = function (){
                bar = new RGraph.Bar({
                    id: 'cvs',
                    data: <?php echo $dadosIdades; ?>,
                    options: {
                        
                        // Add some X-axis labels - you can use a newline character (\n) to make
                        // the label span multiple lines
                        colors: ['#00CED1'],
                        title: 'Idade dos usuários cadastrados',
                        titleSize: 14,
                        titleBold: true,
                        xaxis: true,
                        yaxis: true,
                        marginLeft: 0,
                        marginRight: 0,
                        marginTop: 50,
                        tooltips: '%{property:myNames[%{index}]} %{property:xaxisLabels[%{dataset}]} tem %{value} anos.',
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
                        xaxisLabelsAngle: 45,
                        xaxisLabelsOffsety: 2,
                        yaxisTitle: 'Idade',
                        yaxisTitleBold: true
                    }
                }).draw().responsive([
                    {maxWidth:null,width:700,height:350,options: {textSize:12,xaxisLabels: <?php echo $dadosNome; ?>, marginInner: 5}, parentCss: {textAlign: 'center'}},
                    {maxWidth:900,width:984,height:400, options: {textSize:12,xaxisLabels: <?php echo $dadosNome; ?>, marginInner: 5}, parentCss: {textAlign: 'center'}}
                ])
            }
        </script>
    </head>
    <body>
        <div id="conteudo">
        <?php 
            if(!isset($_SESSION['login'])) $_SESSION['login'] = false;
            if($_SESSION['login']){
        ?>
                <h1>Gráfico de Usuários Cadastrados</h1>
                <div class="borda"></div>
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