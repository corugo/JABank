<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extrato</title>
    <style>
        /* Estilos de exemplo para a tabela */
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
	<?php include 'header_anon.php'; ?>
    <div class="d-flex justify-content-center">
        <h1 class="display-4">Extrato</h1>
    </div>
    <div class="d-flex justify-content-center">
        <form action="" method="GET" class="d-flex">
            <input class="form-control me-2" placeholder="CPF" type="text" id="cpf" name="cpf" aria-label="Search">
            <input class="btn btn-outline-success" type="submit" value="Filtrar">
        </form>
    </div>
    <div class="d-flex justify-content-center">
        
        <?php
        // Incluir arquivo de configuração
        include 'config.php';
        
        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verificar conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
        
        // Verificar se um CPF foi fornecido para filtrar os logs
        if (isset($_GET['cpf']) && !empty($_GET['cpf'])) {
            
            // Construir a consulta SQL base
            $sql = "SELECT * FROM logs";
            $cpf = $_GET['cpf'];
            // Consultar nome do CPF passado
            $sql .= " WHERE cpf='$cpf'";
            
            $sql2 = "SELECT name, cash FROM users
                    WHERE cpf = '{$cpf}'";
            $res = $conn->query($sql2) or die($conn->error);
            $row = $res->fetch_assoc();
            $qtd = $res->num_rows;
            $user_cash = $row["cash"];

            // Consultar a posição do usuário no ranking
            $sql_rank = "SELECT COUNT(*) AS posicao
                            FROM users
                            WHERE cash > (SELECT cash FROM users WHERE cpf = '{$cpf}');";
            $result_rank = $conn->query($sql_rank);
            $rank_row = $result_rank->fetch_assoc();
            $user_rank = $rank_row["posicao"] + 1;

            if($qtd > 0){
                print "
                        </div>
                        <div class='d-flex justify-content-center'>
                            <h1 class='display-5 text-center'>".$row["name"].$user_row["name"]."</h1>
                        </div>
                        <div class='d-flex justify-content-center'>
                            <h1 class='display-6'>Está em ".$user_rank."º com ".$user_cash." JAcoins</h1>
                        </div>
                        <div class='d-flex justify-content-center'>";
            }
            
            $nome = $conn->query($sql);
            
            // Ordena do mais novo pro mais antigo
            $sql .= " ORDER BY id DESC";
            
            // Executar a consulta SQL
            $result = $conn->query($sql);
            
            // Verificar se existem registros
            if ($result->num_rows > 0) {
                // Exibir os dados em uma tabela
                echo "<table class='table w-auto table-hover table-responsive'>";
                echo "<tr><th>Data/Hora</th><th>Operação</th><th>JACoins</th><th>Operador</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr".(($row["operacao"] === "remover")?" class='table-danger'":(($row["operacao"] === "adicionar")?" class='table-success'":" class='table-primary'")).">";
                    echo "<td>".$row["datahora"]."</td>";
                    echo "<td>".(($row["operacao"] === "remover")?"-":(($row["operacao"] === "adicionar")?"+":"")).$row["quantidade"]."</td>";
                    echo "<td>".$row["cash"]."</td>";
                    echo "<td>".$row["usuario"]."</td>";
                    echo "</tr>";
                    echo "<tr".(($row["operacao"] === "remover")?" class='table-danger'":(($row["operacao"] === "adicionar")?" class='table-success'":" class='table-primary'"))."><td style='border-bottom: 2px solid black; padding: 10px;' colspan='4'>".$row["descricao"]."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Nenhum registro encontrado.";
            }
        }

        // Fechar conexão
        $conn->close();
        ?>
    </div>
</body>
</html>
