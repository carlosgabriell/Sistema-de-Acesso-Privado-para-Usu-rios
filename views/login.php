<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar o CPF e a senha no banco de dados (código de autenticação)

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

    // Obtém o CPF e a senha digitados no formulário de login
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Remove todos os caracteres não numéricos do CPF
    $cpf = preg_replace("/[^0-9]/", "", $cpf);

    // Consulta para verificar se o CPF corresponde a um usuário válido
    $sql = "SELECT * FROM respondente WHERE cpf = '$cpf'";

    // Executa a consulta
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a consulta retornou algum resultado
    if (mysqli_num_rows($resultado) > 0) {
        $respondente = mysqli_fetch_assoc($resultado);

if ($senha === $respondente['senha']) {
    // Definir a variável de sessão com o CPF do usuário autenticado
    $_SESSION['cpf'] = $cpf;

    // Verifica se o usuário deve trocar a senha
    if ($respondente['mudou_senha'] == 0) {
        $_SESSION['troca_senha'] = true; // Definir como true para obrigar a troca de senha
        header("Location: /views/troca_senha.php");
        exit;
    } else {
        $_SESSION['troca_senha'] = false; // Definir como false para não obrigar a troca de senha
        header("Location: /includes/dados_user.php");
        exit;
    }
}
    }
    // Libera a memória do resultado da consulta
    mysqli_free_result($resultado);

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
        <style>
/* login.css */
/* login.css */
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

h1 {
    text-align: center;
    margin-bottom: 20px;
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

input[type="text"],
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

    <form method="POST" action="login.php">
        <h1>Login</h1>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>

</body>
</html>
