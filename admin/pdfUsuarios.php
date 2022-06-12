<?php
    require_once __DIR__ . '/../composer/vendor/autoload.php';
    include "../conexao.php";

    session_start();
    session_cache_expire(5);

    $sql=mysqli_query($conecta, "SELECT * FROM tblusuario ORDER BY nome_tblusuario") or die(mysqli_error($conecta));

    $html = "<!DOCTYPE html>";
    $html = $html . "<html lang='pt_BR'>";
    $html = $html . "<head>";
    $html = $html . "<meta charset='UTF-8'>";
    $html = $html . "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    $html = $html . "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    $html = $html . "<link rel='stylesheet' href='../css/style.css'>";
    $html = $html . "<link rel='stylesheet' href='../css/style-pdf.css'>";
    $html = $html . "<title>Gerar Relatório de Usuários Cadastrados</title>";
    $html = $html . "</head>";

    if (!isset($_SESSION['login'])) $_SESSION['login'] = false;
    $html = $html . "<body>";
    $html = $html . "<div id='conteudo'>";

    if (!$_SESSION['login']) {
        $html = $html . "<h1>Sistema de login e senha criptografados</h1>";
        $html = $html . "<div class='borda'></div>";
        $html = $html . "<p>Proibido o acesso por esse meio!</p>";
    }
    else {
        $html = $html . "<h1>Gerar Relatório de Usuários Cadastrados</h1>";
        $html = $html . "<div class='borda'></div>";
        $html = $html . "<div class='clear'></div>";
        $html = $html . "<div class='pdf-texto'>Listagem da tabela: tblusuario</div>";
        $html = $html . "<div class='pdf-texto'>Foram encontrados ". mysqli_num_rows($sql) ." registros</div>";
        $html = $html . "<div class='clear'></div>";
        $html = $html . "<div class='dheader pdf-reg_header'>Reg</div>";
        $html = $html . "<div class='dheader pdf-header'>Nome</div>";
        $html = $html . "<div class='dheader pdf-header'>Email</div>";
        $html = $html . "<div class='clear'></div>";
        while ($result=mysqli_fetch_assoc($sql)){
            $i++;
            $html = $html . "<div class='content pdf-reg_content'>" . $i . "</div>";
            $html = $html . "<div class='content pdf-content'>" . $result['nome_tblusuario'] . "</div>";
            $html = $html . "<div class='content pdf-content'>" . $result['email_tblusuario'] . "</div>";
        }
    }
    $html = $html . "</div>";
    $html = $html . "</body>";
    $html = $html . "</html>";

    

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
?>