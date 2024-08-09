<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: /views/login.php");
    exit;
}

// Configurações do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bdname = "trabalho_web";

// Conexão com o banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $bdname);

// Verifica se a conexão foi estabelecida com sucesso
if (!$conexao) {
    die("A conexão falhou: " . mysqli_connect_error());
}

// Obtém o CPF do usuário
$cpf = $_SESSION['cpf'];

// Verifica se o formulário foi submetido para realizar a troca de senha
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém a senha nova digitada no formulário de troca de senha
    $senha_nova = $_POST['senha_nova'];
    $senha_confirmacao = $_POST['senha_confirmacao'];

    // Verifica se a senha nova e a confirmação coincidem
    if ($senha_nova === $senha_confirmacao) {
        // Atualiza a senha no banco de dados
        $sql_atualizar_senha = "UPDATE respondente SET senha = '$senha_nova', mudou_senha = 1 WHERE cpf = '$cpf'";
        if (mysqli_query($conexao, $sql_atualizar_senha)) {
            // Redireciona para a página principal após trocar a senha
            $_SESSION['troca_senha'] = false;
            header("Location: /includes/dados_user.php");
            exit;
        } else {
            echo "<p>Erro ao atualizar a senha: " . mysqli_error($conexao) . "</p>";
        }
    } else {
        echo "<p>As senhas não coincidem. Tente novamente.</p>";
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trocar Senha</title>
        <style>
/* troca_senha.css */
body {
    font-family: Arial, sans-serif;
    background-color: #0b090a;
    justify-content: center;
    align-items: center;
}

.container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #0f0c0e;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, p {
    text-align: center;
    margin-bottom: 5px;
    color: #fff;
}

form {
    justify-content: center;
    display: flex;
    flex-direction: column;
    width: 500px;
    margin-left: 600px;
    margin-top: 250px;
}

label {
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #fff;
}

input[type="password"] {
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 10px;
}

button {
            padding: 10px 20px;
            background-color: #3c096c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
}

button:hover {
    background-color: #240046;
}

    </style>
</head>
<body>

    <form method="POST" action="troca_senha.php">
        <h1>Trocar Senha</h1>
        <p>Por motivos de segurança, você precisa criar uma nova senha antes de continuar.</p>
        <label for="senha_nova">Nova Senha:</label>
        <input type="password" id="senha_nova" name="senha_nova" required><br>
        <label for="senha_confirmacao">Confirmar Nova Senha:</label>
        <input type="password" id="senha_confirmacao" name="senha_confirmacao" required><br>
        <button type="submit">Trocar Senha</button>
    </form>

</body>
</html>
