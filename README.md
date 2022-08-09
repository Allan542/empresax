# Empresa X :adult:
Projeto desenvolvido para aprender um pouco sobre o funcionamento da linguagem PHP, sendo ele um sistema de *cadastro de usuários* que utiliza **SESSION** para manter o usuário logado durante 5 minutos no máximo⚠️.

## Funcionalidades Implementadas :ballot_box_with_check:

 - [X] O cadastro de usuários será guardado no banco de dados **MySQL**. Se alguém tentar o acesso em alguma página que exige login, mas sem estar logado, o sistema mostrará uma mensagem de erro e pedirá que faça login para poder acessar o conteúdo;
  
 - [X] Conta com a criptografia hash md5 para criptografar as senhas antes de lançar elas no banco de dados e autenticação de inserção de caracteres inválidos no e-mail, a fim de evitar *SQL Injections* (primeira vez que eu fiz isso);
  
 - [X] Sistema de controle de usuários que mostra todos os que estão cadastrados. Também, tem uma opção que mostra um ***gráfico*** de usuários cadastrados, mostrando a idade deles. Por último, tem uma opção para *imprimir* as informações de nome e e-mail destes usuários. Há 3 tipos de usuários diferentes neste sistema:
  
   - O **Master** 🤵  que pode mexer em todas as funcionalidades do sistema, pode acessar tudo e pode excluir/atualizar qualquer usuário;
  
   - O **Administrador** 👷 que pode excluir/atualizar apenas usuários comuns ou ele mesmo, mas não pode fazer nada com outros administradores. Também, pode acessar o sistema para controle de usuários e acessar o conteúdo;

   - O **Usuário** 👨 comum que apenas tem acesso ao conteúdo disponibilizado pelo sistema.
 
 - [X] Conteúdo que pode ser acessado após estar logado. Ele conta com um texto para leitura e um ***gráfico*** com três bandas previamente cadastradas no banco de dados, mostrando quantos discos no total tem cada uma delas. Os dados cadastrados também servem para mostrar a foto do álbum de cada um dos discos separados por cada banda a quem esta pertence e, quando clicadas, a mesma foto é ampliada no meio da tela. Também, há uma opção para *imprimir* a página, porém sem o ***gráfico***.

 - [ ] Um sistema de "*esqueci a senha*" para autenticar se o usuário cadastrado existe e se ele acertou a pergunta secreta que ele mesmo colocou quando fez o cadastro no sistema. Caso atenda os dois requisitos, o sistema manda um e-mail para o usuário;

## Funcionalidades em Desenvolvimento 🔧

- [ ] Um perfil que contará com as informações do usuário e mostrará as informações que o usuário cadastrou. Nessa mesma tela, o usuário terá como atualizar os seus dados cadastrais, exceto e-mail por razões de segurança;

- [ ] Um terceiro conteúdo, porém ainda estou sem ideias do que colocar.

## Informação Complementar

Por enquanto o projeto não será desenvolvido, pois estou focado num bootcamp para desenvolvimento web full stack. Quando acabar este bootcamp, irei dar continuidade. 

É isso😃