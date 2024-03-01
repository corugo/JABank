<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.html'</script>";
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar/Remover Cash</title>
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
                <span class="input-group-text">JACoins</span>
                <input type="number" class="form-control" id="cash" name="cash" required><br><br>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Descrição</span>
                <input type="text" class="form-control" id="descricao" name="descricao" required><br><br>
            </div>
            <div class="input-group">
                <select class = "form-select" id="acao" name="acao">
                    <option value="adicionar">Adicionar</option>
                    <option value="remover">Remover</option>
                </select>
                <input class="btn btn-outline-secondary" type="submit" value="Enviar">
            </div>
        </form>
    </div>
</body>
</html>