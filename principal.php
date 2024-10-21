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
    <title>Início | Biblioteca</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-zinc-900	text-white p-3 text-lg">
        <ul class="flex flex-row gap-4">
            <li><a href="principal.php">Início</a></li>
            <li><a href="cadastrolivro.php">Cadastrar Livro</a></li>
            <li><a href="#">Remover Livro</a></li>
            <li><a href="#">Minha conta</a></li>
            <li><a href="#">Sair</a></li>
        </ul>
    </nav>

    <section class="p-2">
        <div class="bemvindo">
            <h1 class="text-3xl">Bem-vindo(a), <?php echo $_SESSION['nome'];?></h1>
        </div>
        
        <div>
            <h2 class="text-2xl mt-6">Livros Cadastrados</h2>
            <div></div>
        </div>

    </section>
</body>
</html>