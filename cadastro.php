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
        echo "Usuário já cadastrado";
    } else{
        $sql = "INSERT INTO cadastro(nome, dtnascimento, email, usuario, senha) VALUES ('$nome', '$dtnascimento', '$email', '$usuario', '$senha')";

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
</head>
<body>

    <section>
        <form action="" method="post">
            <input type="text" name="nome" id="nome" placeholder="Nome" required>
            <label for="dtnascimento">Data de Nascimento</label>
            <input type="date" name="dtnascimento" id="dtnascimento" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="text" name="usuario" id="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <input type="submit" value="Criar Conta">
        </form>
    </section>

</body>
</html>