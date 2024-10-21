<?php
include('conexao.php');
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

            header("Location: principal.php");
        } else{
            echo "Falha! Usuário e/ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
</head>
<body>
    <section>
        <form action="" method="post">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <input type="submit" value="Acessar">
        </form>
        <a href="cadastro.php">Criar conta</a>
    </section>
</body>
</html>