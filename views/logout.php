<?php
// Iniciar a sessão (se ainda não estiver iniciada)
session_start();

// Destruir todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login após o logout
header("Location: /views/login.php");
exit();
?>
