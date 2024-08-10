<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.html'</script>";
    }

    // Incluir arquivo de configuração
    include 'config.php';
    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Buscar as operações do banco de dados
    $sql = "SELECT id, nome, operador, quantidade, descricao FROM operacoes WHERE ativo = 1";
    $result = $conn->query($sql);

    $operacoes = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $operacoes[] = $row;
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar/Remover Cash</title>
    <script>
        function preencherFormulario() {
            var operacoes = <?php echo json_encode($operacoes); ?>;
            var select = document.getElementById("operacao");
            var operacaoSelecionada = select.options[select.selectedIndex].value;

            var operacao = operacoes.find(op => op.id == operacaoSelecionada);

            if (operacao) {
                document.getElementById("cash").value = operacao.quantidade;
                document.getElementById("descricao").value = operacao.descricao;
                document.getElementById("acao").value = operacao.operador;
            }
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="d-flex justify-content-center">
        <h1 class="display-4">Adicionar/remover saldo</h1>
    </div>
    <div class="d-flex justify-content-center">
        <form action="alterar_cash.php" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text">CPF</span>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo isset($_GET['cpf']) ? $_GET['cpf'] : ''; ?>" required><br><br>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Definidos</span>
                <select class="form-select" id="operacao" name="operacao" onchange="preencherFormulario()">
                    <option value="">Selecione uma operação</option>
                    <?php foreach ($operacoes as $operacao): ?>
                        <option value="<?php echo $operacao['id']; ?>"><?php echo $operacao['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">JACoins</span>
                <input type="number" class="form-control" id="cash" name="cash" required><br><br>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Descrição</span>
                <input type="text" class="form-control" id="descricao" name="descricao" required><br><br>
            </div>
            <div class="input-group">
                <select class="form-select" id="acao" name="acao">
                    <option value="adicionar">Adicionar</option>
                    <option value="remover">Remover</option>
                </select>
                <input class="btn btn-outline-secondary" type="submit" value="Enviar">
            </div>
        </form>
    </div>
</body>
</html>
