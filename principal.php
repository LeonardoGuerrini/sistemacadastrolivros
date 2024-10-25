<?php
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
    <title>Início | Biblioteca</title>
    <link rel="stylesheet" href="app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-stone-950 text-white p-4 text-base font-[550]">
        <ul class="flex flex-row gap-4">
            <li><a href="principal.php" class="bg-stone-900 p-2 rounded-md">Início</a></li>
            <li><a href="cadastrolivro.php">Cadastrar Livro</a></li>
            <li><a href="conta.php">Minha conta</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>

    <section class="p-2 m-3">
        <div class="bemvindo">
            <h1 class="text-3xl">Bem-vindo(a), <?php echo $_SESSION['nome'];?></h1>
        </div>
        
        <div>
            <h2 class="text-2xl mt-6 text-left">Livros Cadastrados</h2>
            <div class="livrosCadastrados border rounded-md border-gray-400 w-[72%] mt-4 p-6 sm:w-[70%] sm:mt-4 sm:p-6 md:mt-4 md:p-6 md:w-[35%] lg:mt-4 lg:p-6 lg:w-[25%] 2xl:w-[15%]">
                <?php
                    include('conexao.php');
                    $conn = new mysqli($host, $username, $senha, $dbname); // Conexão com o banco de dados sendo criada usando a classe mysqli
                    $sql = "SELECT id, nome FROM livro;"; // Consulta SQL a ser executada
                    $resultado = $conn->query($sql); // O método query() executa a consulta SQL no banco de dados

                    if ($resultado->num_rows > 0) { // Verifica se a consulta retornou alguma linha
                        // Exibindo os dados de cada linha
                        while($row = $resultado->fetch_assoc()) { // O método num_rows retorna o número de linhas obtidas pela consulta. Se o valor for maior que 0, significa que há registros na tabela | Cada iteração do while processa uma linha de resultado.
                            echo "ID: " . $row["id"]. " | Nome: " . $row["nome"]. "<br>";
                        }
                    } else {
                        echo "0 resultados encontrados";
                    }
                ?>
            </div>
            <div class="removerLivro mt-12">
                <form action="" method="post">
                    <h2 class="text-2xl mt-6">Remover um livro</h2>
                    <p>Se deseja remover um livro do sistema, insira o ID do livro e clique em "Remover", assim o livro será removido imediatamente.</p>
                    <input type="number" name="livroId" id="livroId" placeholder="ID do Livro" class="border rounded-md border-gray-400 text-lg px-2 mt-4" required>
                    <input type="submit" value="Remover" class="m-2 border rounded-md px-3 py-1 border-gray-400 font-medium hover:cursor-pointer">
                </form>
            </div>
        </div>

    </section>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['livroId'])){

            $livroId = $_POST['livroId'];

            // Verifica se a conexão está ativa
            if ($conn->connect_error){
                die("Conexão falhou: ". $conn->connect_error);
            }

            // Verifica se o livro existe
            $sql = "SELECT * FROM livro WHERE id = $livroId";
            $verificarResultado = $conn->query($sql);

            if($verificarResultado->num_rows > 0){
                // Se o livro existe, procede com a remoção
                $sqlDelete = "DELETE FROM livro WHERE id = $livroId";

                if($conn->query($sqlDelete) === TRUE){
                    echo "<p class='ml-5'>Livro removido com sucesso. Recarregando a página em 5 segundos...</p>";
                } else{
                    echo "<p class='ml-5'>Erro ao remover o livro: ". $conn->error. "</p>";
                }

                header("Refresh: 5"); // Recarrega a página

            } else{
                // Mensagem caso o livro não exista
                echo "<p class='ml-5'>Livro não encontrado. Verifique o ID e tente novamente.</p>";
            }

            $conn->close(); // Fecha a conexão com o banco de dados

        }
    ?>
</body>
</html>