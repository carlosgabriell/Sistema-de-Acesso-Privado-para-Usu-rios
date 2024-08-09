<?php
include("/includes/conexao.php");

function gerarSenhaAleatoria($tamanho = 8) {
    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $senha = substr(str_shuffle($caracteres), 0, $tamanho);
    return $senha;
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$data_nasc = $_POST['data_nasc'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];
$horas_sono_dia = $_POST['horas_sono_dia'];
$email = $_POST['email'];

$senhaTemporaria = gerarSenhaAleatoria();

$sql = "INSERT INTO respondente (nome, cpf, data_nasc, peso, altura, horas_sono_dia, email, senha) 
        VALUES ('$nome', '$cpf', '$data_nasc', '$peso', '$altura', '$horas_sono_dia', '$email', '$senhaTemporaria')";

if (mysqli_query($conexao, $sql)) {
    // Chama a função para enviar o e-mail com a senha temporária
    include("sendmail.php");
    enviarEmail($email, $senhaTemporaria);
    echo "Usuário cadastrado com sucesso! Verifique seu e-mail para obter a senha temporária.";
} else {
    echo "Erro ao cadastrar usuário " . mysqli_connect_error($conexao);
}

mysqli_close($conexao);
?>