<?php
session_start();
if (empty($_SESSION)) {
    print "<script>location.href='index.html'</script>";
    exit();
}

// Incluir arquivo de configuração
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar se os dados necessários foram enviados
    if (isset($_GET['id'])&& isset($_GET['acao'])) {
        
        // Receber os dados do formulário
        $id = $_GET['id'];
        $acao = $_GET['acao'];

        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Preparar a declaração SQL para atualização
        $stmt = $conn->prepare("UPDATE operacoes SET ativo=? WHERE id=?");
        $stmt->bind_param("si", $acao, $id);

        // Executar a atualização
        if ($stmt->execute()) {
            echo "Registro atualizado com sucesso.";
            header("Location: operacoes.php");
            exit();
        } else {
            echo "Erro ao atualizar registro: " . $stmt->error;
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conn->close();
    } else {
        echo "ID e/ou ação não informado";
    }
} else {
    header("Location: operacoes.php");
    exit();
}
?>
