<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca | Cadastro de Livros</title>
</head>
<body>
    <section>
        <h2>Bem-vindo(a), <?php echo $_SESSION['nome'];?></h2>
    </section>
</body>
</html>