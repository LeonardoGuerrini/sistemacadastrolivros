<?php
include('conexao.php');
session_start(); // Inicia a sessão, ou retoma uma sessão existente

// Verifica se a variável de sessão 'id' está definida
if (!isset($_SESSION['id'])) {
    header("Location: index.php"); // Redireciona para a página de login se não estiver logado
    exit(); // Para a execução do script após o redirecionamento
}



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Biblioteca</title>
    <link rel="stylesheet" href="app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-stone-950 text-white p-4 text-base font-[550]">
        <ul class="flex flex-row gap-4">
            <li><a href="principal.php">Início</a></li>
            <li><a href="cadastrolivro.php" class="bg-stone-900 p-2 rounded-md">Cadastrar Livro</a></li>
            <li><a href="conta.php">Minha conta</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>

    <section class="flex flex-col text-center m-4">
        <h1 class="text-3xl">Cadastro de Livro</h1>
        <form action="" method="post" class="border rounded-2xl border-gray-400 m-auto mt-4 w-1/5 p-10">
            <input type="text" name="nomelivro" id="nomelivro" placeholder="Nome do Livro" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="text" name="descricao" id="descricao" placeholder="Descrição..." class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="text" name="genero" id="genero" placeholder="Gênero" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="number" name="estoque" id="estoque" placeholder="Quantidade no estoque" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="number" name="valor" id="valor" placeholder="Valor Unitário" step="0.01" min="0" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="submit" value="Cadastrar" class="m-2 border rounded-md px-3 py-1 border-gray-400 font-medium hover:cursor-pointer">
        </form>
    </section>
    <?php
    if(isset($_POST['nomelivro']) && isset($_POST['descricao']) && isset($_POST['genero']) && isset($_POST['estoque']) && isset($_POST['valor'])){
        $nomelivro = $mysqli->real_escape_string($_POST['nomelivro']);
        $descricao = $mysqli->real_escape_string($_POST['descricao']);
        $genero = $mysqli->real_escape_string($_POST['genero']);
        $estoque = $mysqli->real_escape_string($_POST['estoque']);
        $valor = $mysqli->real_escape_string($_POST['valor']);
    
        // Verificar se o livro já existe
        $sql = "SELECT * FROM livro WHERE nomelivro = '$nomelivro'";
        $sql_query = $mysqli->query($sql);
    
        if($sql_query->num_rows > 0){
            echo "Usuário já cadastrado";
        } else{
            $sql = "INSERT INTO livro(nomelivro, descricao, genero, estoque, valor) VALUES ('$nomelivro', '$descricao', '$genero', '$estoque', '$valor')";
    
            if($mysqli->query($sql) === TRUE){
                echo "<p class='text-lg text-center mt-4'>Cadastro realizado com sucesso!</p>";
            } else{
                echo "Erro: ". $mysqli->error;
            }
        }
    }
    ?>

</body>
</html>