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
    $cash = 0;
    $name = $_POST['name'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $usuario = $_SESSION["name"];

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Preparar e executar a consulta SQL para inserir os dados
    $sql = "INSERT INTO users (cpf, cash, name, data_cadastro, fone, email) VALUES ('$cpf', $cash, '$name', NOW(), '$celular', '$email')";

    if ($conn->query($sql) === TRUE) {
		$sql = "INSERT INTO logs (datahora, cpf, operacao, descricao, quantidade, usuario, name) VALUES (NOW(), '$cpf', 'cadastro', 'Cadastro', 0, '$usuario', '$name')";

			if ($conn->query($sql) === TRUE) {
                header("Location: logs.php");
			} else {
				echo "Erro ao adicionar log: " . $conn->error;
			}
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $conn->error;
    }
	echo "<br><a href='cadastro_usuario.php'>Voltar</a>";
    // Fechar conexão
    $conn->close();
}
?>
