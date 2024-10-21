<?php
session_start(); // Inicia a sessão
session_destroy(); // Destrói a sessão, removendo todas as variáveis armazenadas

header("Location: index.php"); // Redireciona para a página de login
exit(); // Para a execução do script após redirecionamento
?>