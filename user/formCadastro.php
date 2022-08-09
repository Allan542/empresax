<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Allan Carlos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Sistema de Login e Senha Criptografados</title>
</head>
<body>
    <div id="conteudo">
        <h1>Sistema de login e senha criptografados - Cadastro de usuário</h1>
        <div class="borda"></div>
        <p>Para ter acesso ao conteúdo exclusivo, por favor, cadastre-se utilizando o formulário abaixo!</p>
        <form action="cadastro.php" method="post" id="validaAcesso">
            <fieldset>
                <legend>Faça seu cadastro abaixo!</legend>
                <label for="nome">Seu nome:</label>
                <input type="text"
                    name="nome" 
                    class="txtDados" 
                    placeholder="Digite seu nome..." 
                    required 
                    autofocus
                >

                <div class="clear"></div>
                <label for="email">Email:</label>
                <input type="email"
                    name="email"
                    class="txtDados"
                    placeholder="Digite seu email..." 
                    required
                >

                <div class="clear"></div>
                <label for="idade">Idade:</label>
                <input type="number"
                    name="idade"
                    class="txtDados"
                    placeholder="Digite sua idade..."
                    required
                >

                <div class="clear"></div>
                <label for="senha">Senha:</label>
                <input type="password"
                    name="senha"
                    class="txtDados"
                    placeholder="Digite sua senha..."
                    required
                >

                <div class="clear"></div>
                <label for="conf_senha">Senha Novamente:</label>
                <input type="password"
                    name="conf_senha"
                    class="txtDados"
                    placeholder="Confirme sua senha..." 
                    required
                >

                <div class="clear"></div>
                <label for="pergunta">Pergunta secreta:</label>
                <div class="select-div">
                    <select name="pergunta" class="select-box">
                        <option value="">Selecione...</option>
                        <option>O nome do seu pet</option>
                        <option>O nome do(a) seu/sua primeiro(a) professor(a)</option>
                        <option>O seu primeiro endereço</option>
                        <option>A sua cor favorita</option>
                        <option>O seu animal favorito</option>
                    </select>
                </div>
                <label for="Resposta">Resposta secreta:</label>
                <input type="text"
                    name="resposta"
                    class="txtDados txtResposta"
                    placeholder="Digite a sua resposta..."
                    required
                >
                <div class="clear"></div>

                <input type="submit" value="Efetuar cadastro" class="botaoForm">
            </fieldset>
        </form>
        <p>Se você possui cadastro, <a href="../index.php">clique aqui</a> para acessar o Conteúdo Exclusivo! </p>
    </div>
</body>
</html>