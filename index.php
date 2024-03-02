<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    
</head>
<body>
	<?php include 'header_anon.php'; ?>
    <div class="d-flex justify-content-center">
        <h1 class="display-1">JACoin</h1>
    </div>
    <div class="d-flex justify-content-center">
        <h1 class="display-5">Pódio</h1>
    </div>
    <div class="d-flex justify-content-center">
        <table class="table w-auto table-striped">
            <tr>
                <th>#</th>
                <th>Correntista</th>
                <th>Saldo</th>
            </tr>
            <?php
            // Incluir arquivo de configuração
            include 'config.php';

            // Criar conexão
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Preparar e executar a consulta SQL para listar os usuários
            $sql = "SELECT cpf, cash, name FROM users ORDER BY cash DESC";
            $result = $conn->query($sql);

            // Verificar se existem registros
            if ($result->num_rows > 0) {
                $posicao = 1;
                // Exibir os dados em uma tabela
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='d-flex justify-content-end'>".$posicao." º</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td class='d-flex justify-content-end'>".$row["cash"]."</td>";
                    echo "</tr>";
                    $posicao++;
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum usuário cadastrado</td></tr>";
            }

            // Fechar conexão
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
