<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
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

// Consulta para obter os dados do usuário
$sql = "SELECT * FROM respondente WHERE cpf = '$cpf'";
$resultado = mysqli_query($conexao, $sql);
$respondente = mysqli_fetch_assoc($resultado);

// Lógica para adicionar novo email
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['novo_email']) && $_POST['novo_email'] !== '') {
    $novo_email = $_POST['novo_email'];
    // Verifica se o email já não existe na lista de emails do usuário
    if (!in_array($novo_email, explode(',', $respondente['novos_emails']))) {
        // Adiciona o novo email na lista de emails do usuário
        $novos_emails = $respondente['novos_emails'];
        if ($novos_emails !== '') {
            $novos_emails .= ',' . $novo_email;
        } else {
            $novos_emails = $novo_email;
        }

        // Atualiza a lista de novos emails no banco de dados
        $sql_atualizar_emails = "UPDATE respondente SET novos_emails = '$novos_emails' WHERE cpf = '$cpf'";
        mysqli_query($conexao, $sql_atualizar_emails);
        // Atualiza a lista de novos emails na variável de sessão para refletir a alteração
        $_SESSION['novos_emails'] = $novos_emails;

        // Redireciona de volta para a página de dados do usuário após a adição do novo email
        header("Location: dados_user.php");
        exit;
    } else {
        echo "<p>O email já existe na lista de emails.</p>";
    }
}

// Lógica para remover email
if (isset($_GET['remove_email'])) {
    $email_remover = $_GET['remove_email'];
    // Verifica se o email a ser removido é diferente do email principal
    if ($email_remover !== $respondente['email']) {
        // Remove o email da lista de novos emails do usuário
        $novos_emails_array = explode(',', $respondente['novos_emails']);
        $novos_emails_array = array_diff($novos_emails_array, array($email_remover));
        $novos_emails = implode(',', $novos_emails_array);

        // Atualiza a lista de novos emails no banco de dados
        $sql_remover_email = "UPDATE respondente SET novos_emails = '$novos_emails' WHERE cpf = '$cpf'";
        mysqli_query($conexao, $sql_remover_email);
        // Atualiza a lista de novos emails na variável de sessão para refletir a alteração
        $_SESSION['novos_emails'] = $novos_emails;

        // Redireciona de volta para a página de dados do usuário após a remoção do email
        header("Location: dados_user.php");
        exit;
    } else {
        echo "<p>O email principal não pode ser removido.</p>";
    }
}

// Lógica para atualizar o nome completo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nome_completo']) && $_POST['nome_completo'] !== '') {
    $novo_nome_completo = $_POST['nome_completo'];
    // Atualiza o nome completo no banco de dados
    $sql_atualizar_nome = "UPDATE respondente SET nome = '$novo_nome_completo' WHERE cpf = '$cpf'";
    mysqli_query($conexao, $sql_atualizar_nome);
    // Atualiza o nome completo na variável de sessão para refletir a alteração
    $_SESSION['nome_completo'] = $novo_nome_completo;

    // Redireciona de volta para a página de dados do usuário após a atualização do nome
    header("Location: dados_user.php");
    exit;
}

// Verifica se o formulário foi submetido para realizar a troca de senha
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['senha_nova']) && $_POST['senha_nova'] !== '') {
    $senha_nova = $_POST['senha_nova'];
    
    // Atualiza a senha no banco de dados
    $sql_atualizar_senha = "UPDATE respondente SET senha = '$senha_nova' WHERE cpf = '$cpf'";
    
    if (mysqli_query($conexao, $sql_atualizar_senha)) {
        // Atualiza a senha na variável de sessão para refletir a alteração
        $_SESSION['senha'] = $senha_nova;
        // Redireciona para a página principal após trocar a senha
        header("Location: dados_user.php");
        exit;
    } else {
        echo "Erro ao atualizar a senha: " . mysqli_error($conexao);
    }
}

// Lógica para marcar o desejo de remoção da conta
if (isset($_POST['excluir_conta'])) {
    $sql_desejo_remocao = "UPDATE respondente SET desejo_remocao = TRUE WHERE cpf = '$cpf'";
    mysqli_query($conexao, $sql_desejo_remocao);

    // Redireciona para a página de login após marcar o desejo de remoção
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <style>
        /* Estilos para a página dados_user.php */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #0b090a;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #0f0c0e;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h5 {
            margin-top: 5px;
            text-align: center;
            margin-bottom: 10px;
            color: #fff;
        }

        form {
            background-color: #0f0c0e;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #818181;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 99%;
            padding: 10px;
            margin-bottom: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #3c096c;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #240046;
        }

        h2 {
            margin-top: 20px;
            color: #fff;
        }

        p {
            color: #fff;
            margin: 10px 0;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: #9d4edd;
        }

        input[type="email"] {
            width: 99%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .email-list {
            margin-top: 10px;
        }

        .email-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 5px 0;
        }

        .remove-btn {
            background-color: #dc3545;
        }

        .remove-btn:hover {
            background-color: #c82333;
            cursor: pointer;
        }
    </style>

</head>
<body>
    <h1>Página Principal</h1>
    <h5>Boas Vindas!</h5>

    <form method="POST" action="dados_user.php">
        <label for="nome_completo">Nome Completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" value="<?php echo $respondente['nome']; ?>" required><br>
        <label for="senha_nova">Alterar Senha:</label>
        <input type="password" id="senha_nova" name="senha_nova"><br>
        <button type="submit">Salvar Alterações</button>
    </form>

    <p><strong>CPF:</strong> <?php echo $respondente['cpf']; ?></p>
    <p><strong>Data de Nascimento:</strong> <?php echo $respondente['data_nasc']; ?></p>
    <p><strong>Altura:</strong> <?php echo $respondente['altura']; ?></p>
    <p><strong>Peso:</strong> <?php echo $respondente['peso']; ?></p>
    <p><strong>Horas de Sono p/Dia:</strong> <?php echo $respondente['horas_sono_dia']; ?></p>
    <p><strong>Email Principal:</strong> <?php echo $respondente['email']; ?></p>

    <h2>Adicionar Novo Email</h2>
    <form method="POST" action="dados_user.php">
        <label for="novo_email">Novo Email:</label>
        <input type="email" id="novo_email" name="novo_email" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Emails Secundários</h2>
    <?php
    if (!empty($respondente['novos_emails'])) {
        $emails_secundarios = explode(',', $respondente['novos_emails']);
        foreach ($emails_secundarios as $email_secundario) {
            echo "<p>$email_secundario <a href='dados_user.php?remove_email=$email_secundario'>Remover</a></p>";
        }
    } else {
        echo "<p>Nenhum email secundário adicionado.</p>";
    }
    ?>

    <form method="POST" action="dados_user.php">
        <button type="submit" name="excluir_conta">Excluir Conta</button>
    </form>

    <p><a href="logout.php">Sair</a></p>
</body>
</html>
