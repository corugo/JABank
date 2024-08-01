<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(empty($_SESSION)){
    print "<script>location.href='index.html'</script>";
}

// Incluir arquivo de configuração
include 'config.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário e sanitizar
    $nome = htmlspecialchars($_POST['nome']);
    $quantidade = intval($_POST['quantidade']);
    $operacao = $_POST['operador']; // Não converter para inteiro
    $descricao = htmlspecialchars($_POST['descricao']);

    // Validar os dados recebidos
    if (!is_string($nome) || !is_int($quantidade) || !in_array($operacao, ['adicionar', 'remover']) || !is_string($descricao)) {
        die("Dados inválidos. Por favor, verifique as entradas.");
    }

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Preparar e executar a consulta SQL para inserir os dados
    $stmt = $conn->prepare("INSERT INTO operacoes (nome, operador, quantidade, descricao, ativo) VALUES (?, ?, ?, ?, 1)");
    $stmt->bind_param("ssis", $nome, $operacao, $quantidade, $descricao);

    if ($stmt->execute()) {
        header("Location: operacoes.php");
    } else {
        echo "Erro ao cadastrar operação: " . $stmt->error;
    }

    echo "<br><a href='operacoes_add.php'>Voltar</a>";

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
