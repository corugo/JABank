<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.html'</script>";
    }
// Incluir arquivo de configuração
include 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Itens</title>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="d-flex justify-content-center">
        <h1 class="display-4">Operações pré-definidas</h1>
    </div>
    <div class="d-flex justify-content-center">
        <h1 class="display-5">Adicionar operação</h1>
    </div>
    <div class="d-flex justify-content-center">
        <form action="operacoes_add_acao.php" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text">Nome:</span>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Operação</span>
                <select class="form-select" name="operador">
                    <option value="adicionar">Adicionar</option>
                    <option value="remover">Remover</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Quantidade:</span>
                <input type="text" class="form-control" name="quantidade" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Descrição:</span>
                <input type="text" class="form-control" name="descricao" required>
            </div>
            <div class="input-group mb-3">
                <input class="btn btn-outline-secondary" type="submit" value="Adicionar">
            </div>
        </form>
    </div>
</body>
</html>