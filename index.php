<?php
include('conexao.php');
session_start();

if (isset($_POST['usuario']) || isset($_POST['senha'])){
    if(strlen($_POST['usuario']) == 0){
        echo "Preencha seu usuário";
    } else if(strlen($_POST['senha']) == 0){
        echo "Preencha sua senha";
    } else {
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql = "SELECT * FROM cadastro WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql) or die("Falha ao executar código sql: ". $mysqli->error);

        $qtde = $sql_query->num_rows;
        if($qtde == 1){
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['dtnascimento'] = $usuario['dtnascimento'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['usuario'] = $usuario['usuario'];

            header("Location: principal.php");
            exit();
        } else{
            echo "<p class='text-lg text-center mt-4'>Falha! Usuário e/ou senha incorretos</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Biblioteca</title>
    <link rel="stylesheet" href="app.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <section class="flex flex-col text-center m-4">
        <h1 class="text-3xl">Acesso</h1>
        <form action="" method="post" class="border rounded-2xl border-gray-400 m-auto mt-4 w-1/5 p-10">
            <input type="text" name="usuario" id="usuario" placeholder="Usuário" class="border rounded-md border-gray-400 text-lg px-2" required>
            <br>
            <input type="password" name="senha" id="senha" placeholder="Senha" class="border rounded-md border-gray-400 text-lg m-4 px-2" required>
            <br>
            <input type="submit" value="Acessar" class="m-2 border rounded-md px-3 py-1 border-gray-400 font-medium hover:cursor-pointer">
            <br>
            <a href="cadastro.php" class="text-sky-700 underline underline-offset-1">Criar conta</a>
        </form>
    </section>
</body>
</html>