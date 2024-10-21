<?php
include('conexao.php');

if(isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['genero']) && isset($_POST['estoque']) && isset($_POST['valor'])){
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $descricao = $mysqli->real_escape_string($_POST['descricao']);
    $genero = $mysqli->real_escape_string($_POST['genero']);
    $estoque = $mysqli->real_escape_string($_POST['estoque']);
    $valor = $mysqli->real_escape_string($_POST['valor']);

    // Verificar se o livro já existe
    $sql = "SELECT * FROM livro WHERE nome = '$nome'";
    $sql_query = $mysqli->query($sql);

    if($sql_query->num_rows > 0){
        echo "Usuário já cadastrado";
    } else{
        $sql = "INSERT INTO livro(nome, descricao, genero, estoque, valor) VALUES ('$nome', '$descricao', '$genero', '$estoque', '$valor')";

        if($mysqli->query($sql) === TRUE){
            echo "Cadastro realizado com sucesso!";
        } else{
            echo "Erro: ". $mysqli->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Biblioteca</title>
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

    <section class="flex flex-col text-center m-4">
        <h1 class="text-3xl">Cadastro de Livro</h1>
        <form action="" method="post" class="border rounded-2xl border-gray-400 m-auto mt-4 w-1/5 p-10">
            <input type="text" name="nome" id="nome" placeholder="Nome do Livro" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="text" name="descricao" id="descricao" placeholder="Descrição..." class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="text" name="genero" id="genero" placeholder="Gênero" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="number" name="estoque" id="estoque" placeholder="Quantidade no estoque" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="number" name="valor" id="valor" placeholder="Valor Unitário" step="0.01" min="0" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <input type="submit" value="Cadastrar" class="m-2 border rounded-md px-3 py-1 border-gray-400 font-medium hover:cursor-pointer">
        </form>
    </section>

</body>
</html>