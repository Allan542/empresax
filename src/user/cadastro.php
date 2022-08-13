<?php
    include '../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Sistema de Login e Senha Criptografados</title>
</head>
<body>
    <div id="conteudo">
        <h1>Sistema de login e senha criptografados</h1>
        <div class="borda"></div>
        <?php
            $refresh = '<meta http-equiv="refresh" content="5; url=../index.php">'; // meta tag para voltar à página inicial

            $recebeNome = trim(ucwords($_POST['nome']));
            $filtraNome = filter_var($recebeNome, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraNome = filter_var($filtraNome, FILTER_SANITIZE_ADD_SLASHES);
            
            $recebeEmail = trim($_POST['email']);
            $filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_ADD_SLASHES);
            
            $recebeIdade = $_POST['idade'];
            $filtraIdade = filter_var($recebeIdade, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraIdade = filter_var($filtraIdade, FILTER_SANITIZE_ADD_SLASHES);

            $recebeSenha = $_POST['senha'];
            $filtraSenha = filter_var($recebeSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraSenha = filter_var($filtraSenha, FILTER_SANITIZE_ADD_SLASHES);
            
            $recebe_confSenha = $_POST['conf_senha'];
            $filtra_confSenha = filter_var($recebe_confSenha, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtra_confSenha = filter_var($filtra_confSenha, FILTER_SANITIZE_ADD_SLASHES);

            $recebePergunta = $_POST['pergunta'];

            $recebeResposta = trim($_POST['resposta']);
            $filtraResposta = filter_var($recebeResposta, FILTER_SANITIZE_SPECIAL_CHARS);
            $filtraResposta = filter_var($filtraResposta, FILTER_SANITIZE_ADD_SLASHES);

            // Função para criptografar a senha
            function criptoSenha($criptoSenha){
                return md5($criptoSenha);
            }

            $criptoSenha = criptoSenha($filtraSenha);
            $cripto_confSenha = criptoSenha($filtra_confSenha);
            $consultaBanco = mysqli_query($conecta, "SELECT * FROM tblusuario WHERE email_tblusuario = '$recebeEmail'") or die(mysqli_error($conecta));
            $verificaBanco = mysqli_num_rows($consultaBanco);
            
            if ($verificaBanco == 1) {
                echo "<p>Prezado(a) <strong>$recebeNome</strong>, o endereço de e-mail informado (<strong><em>$recebeEmail</em></strong>) já consta em nossa base de dados!</p>";
                echo "<p><a href='javascript:history.back();'>Volte</a> para a página anterior e informe um novo endereço! Obrigado!</p>";
                return false;
            }
            else {
                if($criptoSenha != $cripto_confSenha){
                    echo "<p>Senha e confirmação de senha não conferem!</p>";
                    echo "<p><a href='javascript:history.back();'>Volte</a> para a página anterior e informe a senha corretamente! Obrigado!</p>";
                }
                else if($recebePergunta == ""){
                    echo "<p>Por favor, selecione uma opção de pergunta!</p>";
                    echo "<p><a href='javascript:history.back();'>Volte</a> para a página anterior e informe a senha corretamente! Obrigado!</p>";
                }
                else if ($filtraIdade <= 13 || $filtraIdade > 120) {
                    echo "<p>Sua idade ultrapassa o limite do sistema de: maior que 13 anos ou menor que 120.</p>";
                    echo "<p><a href='javascript:history.back();'>Volte</a> para a página anterior e informe a idade corretamente! Obrigado!</p>";
                }
                else{
                    $insereDados = mysqli_query($conecta, "INSERT INTO tblusuario (nome_tblusuario, email_tblusuario, idade_tblusuario, senha_tblusuario, opc_pergunta_secreta, resp_pergunta_secreta, tipo_tblusuario) 
                        VALUES ('$filtraNome', '$filtraEmail', $filtraIdade,'$criptoSenha', '$recebePergunta', '$filtraResposta', 'Usuário')") or die(mysqli_error($conecta));

                    echo "<p>Seu cadastro foi efetuado com sucesso!<br>";
                    echo "As informações cadastradas foram: <br>";
                    echo "<strong>Nome</strong>: $filtraNome<br>";
                    echo "<strong>Email</strong>: $filtraEmail<br>";
                    echo "<strong>Idade</strong>: $filtraIdade<br>";
                    echo "<strong>Pergunta</strong>: $recebePergunta<br>";
                    echo "<strong>Resposta</strong>: $filtraResposta</p>";
                    exit($refresh);
                }
            }
        ?>
    </div>
</body>
</html>