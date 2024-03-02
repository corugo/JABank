<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Logs</title>
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
        <h1 class="display-4">Extrato geral</h1>
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
        
        // Construir a consulta SQL base
        $sql = "SELECT * FROM logs WHERE operacao='remover' OR operacao='adicionar'";
        
        // Ordena do mais novo pro mais antigo
        $sql .= " ORDER BY id DESC";

        // Executar a consulta SQL
        $result = $conn->query($sql);

        // Verificar se existem registros
        if ($result->num_rows > 0) {
            // Exibir os dados em uma tabela
            echo "<table class='table w-auto table-hover table-responsive'>";
            echo "<tr><th>Data/Hora</th><th>Correntista</th><th>Operação</th><th>JACoins</th><th>Descrição</th><th>Operador</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr".(($row["operacao"] === "remover")?" class='table-danger'":(($row["operacao"] === "adicionar")?" class='table-success'":" class='table-primary'")).">";
                echo "<td>".$row["datahora"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".(($row["operacao"] === "remover")?"-":(($row["operacao"] === "adicionar")?"+":"")).$row["quantidade"]."</td>";
                echo "<td>".$row["cash"]."</td>";
                echo "<td>".$row["descricao"]."</td>";
                echo "<td>".$row["usuario"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum registro encontrado.";
        }

        // Fechar conexão
        $conn->close();
        ?>
    </div>
</body>
</html>
