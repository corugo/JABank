<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.php'</script>";
    }
?>
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
    <script src="js/html2pdf.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>
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
        
        // Construir a consulta SQL base
        $sql = "SELECT * FROM logs";
        
        // Verificar se um CPF foi fornecido para filtrar os logs
        if (isset($_GET['cpf']) && !empty($_GET['cpf'])) {
            $cpf = $_GET['cpf'];
            // Consultar nome do CPF passado
            $sql .= " WHERE cpf='$cpf'";
            
            $sql2 = "SELECT name FROM users
                    WHERE cpf = '{$cpf}'";
            $res = $conn->query($sql2) or die($conn->error);
            $row = $res->fetch_assoc();
            $qtd = $res->num_rows;
            if($qtd > 0){
                print "</div>
                        <div class='d-flex justify-content-center'>
                        <h1 class='display-6 text-center'>".$row["name"]."</h1>
                        <a href='pagar.php?cpf=".$cpf."'>
                        <img src='img/cash.png' alt='Pagar' width='24' height='24'>
                        </a>
                        </div>
                        <div class='d-flex justify-content-center'>";
            }
            
            $nome = $conn->query($sql);
        }
        
        // Ordena do mais novo pro mais antigo
        $sql .= " ORDER BY id DESC";

        // Executar a consulta SQL
        $result = $conn->query($sql);

        // Verificar se existem registros
        if ($result->num_rows > 0) {
            // Verifica se deve exibir a coluna 'Correntista'
            $exibirCorrentista = !(isset($_GET['cpf']) && !empty($_GET['cpf']));
        
            // Exibir os dados em uma tabela
            echo "<table class='table w-auto table-hover table-responsive'>";
            echo "<tr><th>Data/Hora</th>";
            
            // Exibe o cabeçalho 'Correntista' apenas se $exibirCorrentista for verdadeiro
            if ($exibirCorrentista) {
                echo "<th>Correntista</th>";
            }
        
            echo "<th>Operação</th><th>JACoins</th><th>Operador</th></tr>";
        
            while ($row = $result->fetch_assoc()) {
                echo "<tr".(($row["operacao"] === "remover") ? " class='table-danger'" : (($row["operacao"] === "adicionar") ? " class='table-success'" : " class='table-primary'")).">";
                echo "<td>".$row["datahora"]."</td>";
        
                // Exibe a coluna 'Correntista' apenas se $exibirCorrentista for verdadeiro
                if ($exibirCorrentista) {
                    echo "<td><a href='logs.php?cpf=".$row["cpf"]."'>".$row["name"]."</td>";
                }
        
                echo "<td>".(($row["operacao"] === "remover") ? "-" : (($row["operacao"] === "adicionar") ? "+" : "")).$row["quantidade"]."</td>";
                echo "<td>".$row["cash"]."</td>";
                echo "<td>".$row["usuario"]."</td>";
                echo "</tr>";
                echo "<tr".(($row["operacao"] === "remover")?" class='table-danger'":(($row["operacao"] === "adicionar")?" class='table-success'":" class='table-primary'"))."><td style='border-bottom: 2px solid black; padding: 10px;' colspan='".(($exibirCorrentista) ? "6":"5")."'>".$row["descricao"]."</td></tr>";
            }
            echo "</table>";
        }
        

        // Fechar conexão
        $conn->close();
        ?>
        
    </div>

    <!-- Botão para baixar todo o conteúdo do body como PDF -->
    <div class="d-flex justify-content-center">
        <button id="download" class="btn btn-outline-primary">Baixar como PDF</button>
    </div>

    <script>
        document.getElementById("download").addEventListener("click", function () {
            var element = document.body; // Seleciona todo o conteúdo do body
            html2pdf().from(element).save();
        });
    </script>
</body>
</html>
