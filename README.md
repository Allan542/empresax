# Empresa X :adult:
Projeto desenvolvido para aprender um pouco sobre o funcionamento da linguagem PHP, sendo ele um sistema de *cadastro de usuários* que utiliza **SESSION** para manter o usuário logado durante 5 minutos no máximo⚠️.

## Funcionalidades Implementadas :ballot_box_with_check:

 - [X] O cadastro de usuários será guardado no banco de dados **MySQL**. Se alguém tentar o acesso em alguma página que exige login, mas sem estar logado, o sistema mostrará uma mensagem de erro e pedirá que faça login para poder acessar o conteúdo;
  
 - [X] Conta com a criptografia hash md5 para criptografar as senhas antes de lançar elas no banco de dados e autenticação de inserção de caracteres inválidos no e-mail, a fim de evitar *SQL Injections* (primeira vez que eu fiz isso);
  
 - [X] Sistema de controle de usuários que mostra todos os que estão cadastrados. Também, tem uma opção que mostra um ***gráfico*** de usuários cadastrados, mostrando a idade deles. Por último, tem uma opção para *imprimir* as informações de nome e e-mail destes usuários. Há 3 tipos de usuários diferentes neste sistema:
  
   - O **Master** 🤵  que pode mexer em todas as funcionalidades do sistema, pode acessar tudo e pode excluir/atualizar qualquer usuário;
  
   - O **Administrador** 👷 que pode excluir/atualizar apenas usuários comuns ou ele mesmo, mas não pode fazer nada com outros administradores. Também, pode acessar o sistema para controle de usuários e acessar o conteúdo;

   - O **Usuário** 👨 comum que apenas tem acesso ao conteúdo disponibilizado pelo sistema.
 
 - [X] Conteúdo que pode ser acessado após estar logado. Ele conta com um texto para leitura e um ***gráfico*** com três bandas previamente cadastradas no banco de dados, mostrando quantos discos no total tem cada uma delas. Os dados cadastrados também servem para mostrar a foto do álbum de cada um dos discos separados por cada banda a quem esta pertence e, quando clicadas, a mesma foto é ampliada no meio da tela. Também, há uma opção para *imprimir* a página, porém sem o ***gráfico***;

 - [X] Um sistema de "*esqueci a senha*" para autenticar se o usuário cadastrado existe e se ele acertou a pergunta secreta que ele mesmo colocou quando fez o cadastro no sistema. Caso atenda os dois requisitos, o sistema manda um e-mail para o usuário;
   - Obs: nem todos os usuários possuem a pergunta secreta, pois ela foi implementada durante o desenvolvimento, então eu fiz uma pequena autenticação dessa parte para não quebrar o sistema.

- [X] Um perfil que contará com as informações do usuário e mostrará as informações que o usuário cadastrou. Nessa mesma tela, o usuário terá como atualizar os seus dados cadastrais, exceto e-mail por razões de segurança.

## Screenshots do projeto

  ### Tela Principal
  ![Tela Principal](./assets/images/screenshots/principal.png "Tela Principal")

  ### Tela de Cadastro
  ![Tela de Cadastro](./assets/images/screenshots/cadastro.png "Tela de Cadastro")

  ### Tela de Esqueceu a Senha (Email)
  ![Tela de Esqueceu a Senha (Email)](./assets/images/screenshots/esqueceu-senha-email.png "Tela de Esqueceu a Senha (Email)")

  ### Tela de Esqueceu a Senha (Pergunta Secreta)
  ![Tela de Esqueceu a Senha (Pergunta Secreta)](./assets/images/screenshots/esqueceu-senha-pergunta.png "Tela de Esqueceu a Senha (Pergunta Secreta)")

  ### Tela de Conteúdo Exclusivo
  ![Tela de Conteúdo Exclusivo](./assets/images/screenshots/conteudo-exclusivo.png "Tela de Conteúdo Exclusivo")

  ### Tela do Gráfico e Fotos das Bandas
  ![Gráfico das Bandas](./assets/images/screenshots/bandas-grafico.png "Gráfico das Bandas")
  
  ![Foto das Bandas](./assets/images/screenshots/bandas-fotos-2.png "Foto das Bandas")
  ![Foto das Bandas](./assets/images/screenshots/bandas-fotos-3.png "Foto das Bandas")
  ![Foto das Bandas](./assets/images/screenshots/bandas-fotos-4.png "Foto das Bandas")
  ![Foto das Bandas](./assets/images/screenshots/bandas-fotos-5.png "Foto das Bandas")

  #### Foto de uma Banda Expandida

  ![Foto expandida de uma banda](./assets/images/screenshots/bandas-foto-expandida.png "Foto expandida de uma banda")

  #### Relatório das Bandas em PDF

  ![Relatório das Bandas em PDF](./assets/images/screenshots/bandas-relatorio.png "Relatório das Bandas em PDF")



  ### Tela de Usuários Cadastrados
  ![Tela de Usuários Cadastrados](./assets/images/screenshots/usuarios-cadastrados.png "Tela de Usuários Cadastrados")

  #### Gráfico de Usuários Cadastrados
  ![Gráfico de Usuários Cadastrados](./assets/images/screenshots/usuarios-cadastrados-grafico.png "Gráfico de Usuários Cadastrados")

  #### Relatório de Usuários Cadastrados
  ![Relatório de Usuários Cadastrados](./assets/images/screenshots/usuarios-cadastrados-relatorio.png "Relatório de Usuários Cadastrados")

  ### Tela de Perfil
  ![Tela de Perfil](./assets/images/screenshots/perfil.png "Tela de Perfil")

  #### Atualizar Informações/Senha

  ![Tela de Perfil: Atualizar Informações/Senha](./assets/images/screenshots/perfil-2.png "Tela de Perfil: Atualizar Informações/Senha")

  #### Foto de Perfil expandida

  ![Foto de Perfil expandida](./assets/images/screenshots/perfil-foto-expandida.png "Foto de Perfil expandida")

  #### Mudar Foto de Perfil

  ![Mudar Foto de Perfil](./assets/images/screenshots/perfil-mudar-imagem.png "Mudar Foto de Perfil")

  #### Excluir Foto de Perfil

  ![Excluir Foto de Perfil](./assets/images/screenshots/perfil-excluir.png "Excluir Foto de Perfil")

  ![Excluir Foto de Perfil](./assets/images/screenshots/perfil-excluir-2.png "Excluir Foto de Perfil")

É isso😃