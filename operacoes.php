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
        <h1 class="display-5">Lista de itens</h1>
    </div>
    <div class="d-flex justify-content-center">
        <table class="table w-auto table-striped">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Operador</th>
                <th>Quantidade</th>
                <th>Descrição</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        <?php
        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $sql = "SELECT * FROM operacoes";
        $result = $conn->query($sql);
    
        $items = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
    
        $conn->close();
        foreach ($items as $item):
        ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['nome'] ?></td>
                <td><?= $item['operador'] ?></td>
                <td><?= $item['quantidade'] ?></td>
                <td><?= $item['descricao'] ?></td>
                <td><?= $item['ativo'] ? 'Sim' : 'Não' ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="nome" value="<?= $item['nome'] ?>">
                        <input type="hidden" name="operador" value="<?= $item['operador'] ?>">
                        <input type="hidden" name="quantidade" value="<?= $item['quantidade'] ?>">
                        <input type="hidden" name="descricao" value="<?= $item['descricao'] ?>">
                    </form>
                    <a href='operacoes_edit.php?id=<?= $item['id'] ?>'>
                        <img src='img/edit.png' alt='Editar' width='20' height='20'>
                    </a>
                    <a href='operacoes_desabilitar.php?id=<?= $item['id'] ?>&acao=<?= $item['ativo'] ? '0' : '1' ?>'>
                        <img src='img/<?= $item['ativo'] ? 'desativa' : 'ativa' ?>.png' alt='<?= $item['ativo'] ? 'Desativar' : 'Ativar' ?>' width='20' height='20'>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
