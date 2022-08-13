<?php
    require_once __DIR__ . '/../../components/composer/vendor/autoload.php';
    include "../conexao.php";

    session_cache_expire(5);
    session_start();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->showImageErrors = false;
    $sqlbandas=mysqli_query($conecta, "SELECT * FROM tbl_bandas") or die(mysqli_error($conecta));

    $html = "<!DOCTYPE html>";
    $html = $html . "<html lang='pt_BR'>";
    $html = $html . "<head>";
    $html = $html . "<meta charset='UTF-8'>";
    $html = $html . "<meta name='author' content='Allan Carlos'>";
    $html = $html . "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    $html = $html . "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $html = $html . "<link rel='stylesheet' href='../../assets/css/style.css'>";
    $html = $html . "<link rel='stylesheet' href='../../assets/css/style-pdf.css'>";
    $html = $html . "<title>Gerar relatório de Bandas</title>";
    $html = $html . "</head>";

    $html = $html . "<body>";
    $html = $html . "<div id='conteudo'>";

    if (!isset($_SESSION['login'])) $_SESSION['login'] = false;
    if (!$_SESSION['login']) {
        $html = $html . "<h1>Sistema de login e senha criptografados</h1>";
        $html = $html . "<div class='borda'></div>";
        $html = $html . "<p>Proibido o acesso por esse meio!</p>";
    }
    else {
        $html = $html . "<h1>Gerar relatório de Bandas</h1>";
        $html = $html . "<div class='borda'></div>";
        $html = $html . "<div class='pdf-texto'>Listagem das tabelas: tbl_bandas e tbl_discos</div>";
        $html = $html . "<div class='borda'></div>";
        $html = $html . "<div class='clear'></div>";
        while ($resultbandas=mysqli_fetch_assoc($sqlbandas)){
            $sqldiscos=mysqli_query($conecta, "SELECT * FROM tbl_discos WHERE id_tbl_bandas = " . $resultbandas['id_tbl_bandas']) or die(mysqli_error($conecta));
            $html = $html . "<div class='espaco'></div>";
            $html = $html . "<h1>". $resultbandas['nome_tbl_bandas'] . "</h1>";
            $html = $html . "<div class='borda'></div>";
            $html = $html . "<div class='pdf-texto'>Foram encontrados " . mysqli_num_rows($sqldiscos) . " discos do " . $resultbandas['nome_tbl_bandas'] . "</div>";
            while ($resultdiscos=mysqli_fetch_assoc($sqldiscos)){
                $html = $html . "<div class='pdf-discos'>";
                $html = $html . "<span class='pdf-titulo_disco'>" .  $resultdiscos['titulo_tbl_discos'] ." (" . $resultdiscos['ano_tbl_discos'] . ")</span><br>";
                $html = $html . "<img class='pdf-img' src='../../assets/" . $resultdiscos['capa_tbl_discos'] . "' alt='Capa do álbum'>";
                $html = $html . "</div>";
            }
            $html = $html . "<div class='clear'></div>";
        }
    }
    $html = $html . "</div>";
    $html = $html . "</body>";
    $html = $html . "</html>";

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
?>