# Sistema de Acesso Privado

Este sistema web permite que os usuários façam login e acessem suas informações privadas de forma segura. Desenvolvido em PHP com integração ao banco de dados MySQL, o sistema inclui funcionalidades de cadastro, envio de senha provisória por e-mail, login seguro, troca de senha e gerenciamento de dados pessoais.

## Funcionalidades

- **Cadastro de Usuários**: Os usuários podem se cadastrar no sistema fornecendo seu CPF ou e-mail.
- **Envio de Senha Provisória**: Após o cadastro, uma senha provisória e um link de login são enviados automaticamente para o e-mail do usuário.
- **Login Seguro**: O usuário faz login utilizando o CPF ou e-mail e a senha provisória.
- **Troca de Senha**: No primeiro acesso, o usuário deve alterar a senha provisória para uma senha de sua escolha.
- **Gestão de Dados**: O usuário pode visualizar e editar suas informações, adicionar ou remover e-mails, e excluir sua conta.

## Instruções de Uso

1. **Configuração do Ambiente**:
   - Certifique-se de que seu ambiente de desenvolvimento local esteja configurado corretamente.
   - Recomendamos o uso do [XAMPP](https://www.apachefriends.org/index.html) para simular um servidor local.

2. **Executar o Projeto**:
   - Abra a pasta do projeto no seu servidor local (por exemplo, no `htdocs` do XAMPP).
   - Inicie o Apache e o MySQL no painel de controle do XAMPP.

3. **Cadastro de Usuário**:
   - Abra o arquivo `cadastro.html` no seu navegador para realizar o cadastro.
   - Insira as informações solicitadas e finalize o cadastro.
   - Um e-mail será enviado com a senha provisória e um link para o login.

4. **Login**:
   - Acesse o link recebido no e-mail ou abra o arquivo `login.php` no seu navegador.
   - Realize o login utilizando o CPF (ou e-mail) e a senha provisória.

5. **Troca de Senha**:
   - Após o primeiro login, você será redirecionado para a página de troca de senha (`troca_senha.php`).
   - Insira uma nova senha de sua escolha para continuar.

6. **Gerenciamento de Dados**:
   - Na página de dados (`dados_user.php`), você pode:
     - Alterar seu nome e senha.
     - Adicionar e remover e-mails (exceto o e-mail principal).
     - Excluir sua conta, o que desativará seu acesso ao sistema.

## Estrutura do Projeto

- **/assets**: Contém os arquivos CSS e JavaScript.
- **/includes**: Scripts PHP para conexão ao banco de dados e envio de e-mails.
- **/views**: Contém as páginas principais do sistema (cadastro, login, troca de senha, etc.).

## Requisitos

- PHP 7.x ou superior
- MySQL 5.x ou superior
- Servidor local (recomendado XAMPP)

## Como Contribuir

Se você deseja contribuir com este projeto, sinta-se à vontade para enviar um pull request ou abrir uma issue para discutirmos melhorias.

## Licença

Este projeto é licenciado sob a [MIT License](LICENSE).
