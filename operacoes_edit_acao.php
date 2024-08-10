<?php
session_start();
if (empty($_SESSION)) {
    print "<script>location.href='index.html'</script>";
}

// Incluir arquivo de configuração
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os dados necessários foram enviados
    if (isset($_POST['id_hidden']) && !empty($_POST['id_hidden']) && 
        isset($_POST['name']) && !empty($_POST['name']) && 
        isset($_POST['operador']) && !empty($_POST['operador']) && 
        isset($_POST['quantidade']) && !empty($_POST['quantidade']) && 
        isset($_POST['descricao']) && !empty($_POST['descricao'])) {
        
        // Receber os dados do formulário
        $id = $_POST['id_hidden'];
        $nome = $_POST['name'];
        $operador = $_POST['operador'];
        $quantidade = $_POST['quantidade'];
        $descricao = $_POST['descricao'];

        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Preparar a declaração SQL para atualização
        $stmt = $conn->prepare("UPDATE operacoes SET nome=?, operador=?, quantidade=?, descricao=? WHERE id=?");
        $stmt->bind_param("ssisi", $nome, $operador, $quantidade, $descricao, $id);

        // Executar a atualização
        if ($stmt->execute()) {
            echo "Registro atualizado com sucesso.";
            header("Location: operacoes.php");
        } else {
            echo "Erro ao atualizar registro: " . $stmt->error;
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conn->close();
    } else {
        echo "Todos os campos são obrigatórios.";
        echo "id_hidden: " . htmlspecialchars($_POST['id_hidden']) . "<br>";
        echo "name: " . htmlspecialchars($_POST['name']) . "<br>";
        echo "operador: " . htmlspecialchars($_POST['operador']) . "<br>";
        echo "quantidade: " . htmlspecialchars($_POST['quantidade']) . "<br>";
        echo "descricao: " . htmlspecialchars($_POST['descricao']) . "<br>";
    }
} else {
    header("Location: operacoes.php");
}
?>
