<?php
    session_start();
    if(empty($_SESSION)){
        print "<script>location.href='index.html'</script>";
    }
// Incluir arquivo de configuração
include 'config.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);
        
    $sql = "SELECT * FROM operacoes WHERE id='$id'";
    $res = $conn->query($sql) or die($conn->error);
    $row = $res->fetch_assoc();
    $nome = $row["nome"];
    $operador = $row["operador"];
    $quantidade = $row["quantidade"];
    $descricao = $row["descricao"];

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

    <h2>Editar operação</h2>
    <form action="operacoes_edit_acao.php" method="POST">
        <fieldset disabled="">
            <div class="input-group mb-3">
                <span class="input-group-text">ID:</span>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>" required="">
                <input type="hidden" name="id_hidden" value="<?php echo $id ?>">
            </div>
        </fieldset>
        <label>Nome: <input type="text" name="nome" value="<?= $nome ?>" required></label><br>
        <label>Operação: 
            <select name="operador" required>
                <option value="adicionar">Adicionar</option>
                <option value="remover">Remover</option>
            </select>
        </label><br>
        <label>Quantidade: <input type="number" name="quantidade" value="<?= $quantidade ?>" required></label><br>
        <label>Descrição: <input type="text" name="descricao" value="<?= $descricao ?>" required></label><br>
        <button type="submit" name="add">Salvar</button>
    </form>
</body>
</html>
<?php
} else {
    header("Location: operacoes.php");
}
?>