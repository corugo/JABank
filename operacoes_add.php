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

    <h2>Adicionar operação</h2>
    <form action="operacoes_add_acao.php" method="POST">
        <label>Nome: <input type="text" name="nome" required></label><br>
        <label>Operação: 
            <select name="operador" required>
                <option value="adicionar">Adicionar</option>
                <option value="remover">Remover</option>
            </select>
        </label><br>
        <label>Quantidade: <input type="number" name="quantidade" required></label><br>
        <label>Descrição: <input type="text" name="descricao" required></label><br>
        <button type="submit" name="add">Adicionar</button>
    </form>
</body>
</html>