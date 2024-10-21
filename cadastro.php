<?php
include('conexao.php');

if(isset($_POST['nome']) && isset($_POST['dtnascimento']) && isset($_POST['email']) && isset($_POST['usuario']) && isset($_POST['senha'])){
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $dtnascimento = $mysqli->real_escape_string($_POST['dtnascimento']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $usuario = $mysqli->real_escape_string($_POST['usuario']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    // Verificar se o usuário já existe
    $sql = "SELECT * FROM cadastro WHERE usuario = '$usuario'";
    $sql_query = $mysqli->query($sql);

    if($sql_query->num_rows > 0){
        echo "<p class='text-center text-lg m-4 underline'>Usuário já cadastrado</p>";
    } else{
        $sql = "INSERT INTO cadastro(nome, dtnascimento, email, usuario, senha) VALUES ('$nome', '$dtnascimento', '$email', '$usuario', '$senha')";

        if($mysqli->query($sql) === TRUE){
            echo "<p class='text-center text-lg m-4 underline'>Cadastro realizado com sucesso!</p>";
        } else{
            echo "<p class='text-center text-lg m-4 underline'>Erro: </p>". $mysqli->error;
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
    <section class="flex flex-col text-center m-4">
        <h1 class="text-3xl">Cadastro de Conta</h1>
        <form action="" method="post" class="border rounded-2xl border-gray-400 m-auto mt-4 w-1/5 p-10">
            <input type="text" name="nome" id="nome" placeholder="Nome" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <br>
            <label for="dtnascimento" class="text-lg m-2">Data de Nascimento</label>
            <br>
            <input type="date" name="dtnascimento" id="dtnascimento" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <br>
            <input type="email" name="email" id="email" placeholder="Email" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <br>
            <input type="text" name="usuario" id="usuario" placeholder="Usuário" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <br>
            <input type="password" name="senha" id="senha" placeholder="Senha" class="border rounded-md border-gray-400 text-lg m-2 px-2" required>
            <br>
            <input type="submit" value="Criar Conta" class="m-2 border rounded-md px-3 py-1 border-gray-400 font-medium hover:cursor-pointer">
        </form>
    </section>

</body>
</html>