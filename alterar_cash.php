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
    $cash = $_POST['cash'];
    $acao = $_POST['acao'];
    $descricao = $_POST['descricao'];

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar se o usuário existe
    $check_user_sql = "SELECT * FROM users WHERE cpf='$cpf'";
    $user_result = $conn->query($check_user_sql);

    if ($user_result->num_rows > 0) {
        // Usuário encontrado
        $user_row = $user_result->fetch_assoc();
        $current_cash = $user_row['cash'];
        $name_correntista = $user_row['name'];

        // Determinar a ação a ser tomada
        if ($acao == "adicionar") {
            $new_cash = $current_cash + $cash;
        } elseif ($acao == "remover") {
            $new_cash = $current_cash - $cash;
            if ($new_cash < 0) {
                die("Erro: O saldo não pode ficar negativo.");
            }
        }

        // Atualizar o saldo do usuário no banco de dados
        $update_sql = "UPDATE users SET cash=$new_cash WHERE cpf='$cpf'";
        $usuario = $_SESSION["name"];
        if ($conn->query($update_sql) === TRUE) {
			$sql = "INSERT INTO logs (datahora, cpf, name, operacao, quantidade, cash, usuario, descricao) VALUES (NOW(), '$cpf', '$name_correntista', '$acao', $cash, '$new_cash', '$usuario', '$descricao')";

			if ($conn->query($sql) === TRUE) {
                header("Location: logs.php");
			} else {
				echo "Erro ao adicionar log: " . $conn->error;
			}
            echo "Saldo atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar saldo: " . $conn->error;
        }
    } else {
        // Usuário não encontrado
        echo "Erro: Usuário não encontrado.<br><button onclick='history.back()'>Voltar</button>";
    }

    // Fechar conexão
    $conn->close();
}
?>
