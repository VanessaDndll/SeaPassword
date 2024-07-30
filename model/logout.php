<?php
session_start(); // Inicia sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão
header("Location: /seapassword/view/index.php"); // Redireciona para a página de login
exit();
?>
