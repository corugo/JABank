<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.html'</script>";
    }
// Incluir arquivo de configuração
include 'config.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $usuario = $_SESSION["name"];

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Pegar nome do cadastro
    $check_user_sql = "SELECT * FROM users WHERE cpf='$cpf'";
    $user_result = $conn->query($check_user_sql);
    $user_row = $user_result->fetch_assoc();
    $name = $user_row['name'];
    $cash = $user_row['cash'];

    // Preparar e executar a consulta SQL para inserir os dados
    $sql = "UPDATE users SET senha='$senha' WHERE cpf='$cpf'";

    if ($conn->query($sql) === TRUE) {
		$sql = "INSERT INTO logs (datahora, cpf, operacao, cash, descricao, usuario, name) VALUES (NOW(), '$cpf', 'atualizado', $cash, 'Atualização de senha', '$usuario', '$name')";

			if ($conn->query($sql) === TRUE) {
                header("Location: logs.php");
			} else {
				echo "Erro ao adicionar log: " . $conn->error;
			}
        echo "Sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
    // Fechar conexão
    $conn->close();
}
?>
