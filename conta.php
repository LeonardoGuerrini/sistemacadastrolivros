<?php
    session_start(); // Inicia a sessão, ou retoma uma sessão existente

    // Verifica se a variável de sessão 'id' está definida
    if (!isset($_SESSION['id'])) {
        header("Location: index.php"); // Redireciona para a página de login se não estiver logado
        exit(); // Para a execução do script após o redirecionamento
    }

    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $dtnascimento = $_SESSION['dtnascimento'] ?? 'Data de nascimento não disponível';
    $email = $_SESSION['email']  ?? 'Email não disponível';
    $usuario = $_SESSION['usuario']  ?? 'Usuário não disponível';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta | Biblioteca</title>
    <link rel="stylesheet" href="app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-stone-950 text-white p-4 text-base font-[550]">
        <ul class="flex flex-row gap-4">
            <li><a href="principal.php">Início</a></li>
            <li><a href="cadastrolivro.php">Cadastrar Livro</a></li>
            <li><a href="conta.php" class="bg-stone-900 p-2 rounded-md">Minha conta</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>

    <section class="p-2 m-3">
        <div>
            <h1 class="text-3xl text-left">Minha Conta</h1>
            <div class="">
                <p><strong>ID:</strong> <?php echo htmlspecialchars($id); ?></p>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
                <p><strong>Usuário:</strong> <?php echo htmlspecialchars($usuario); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($dtnascimento); ?></p>
            </div>

        </div>
</body>
</html>