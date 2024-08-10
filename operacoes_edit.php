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
    <div class="d-flex justify-content-center">
        <h1 class="display-5">Editar operação</h1>
    </div>
    <div class="d-flex justify-content-center">
        <form action="operacoes_edit_acao.php" method="POST">
            <fieldset disabled="">
                <div class="input-group mb-3">
                    <span class="input-group-text">ID:</span>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>" required="">
                </div>
            </fieldset>
            <input type="hidden" name="id_hidden" value="<?php echo $id ?>">
            <div class='input-group mb-3'>
                <span class='input-group-text'>Nome:</span>
                <input type='text' class='form-control' id='name' name='name' value='<?= $nome ?>' required>
            </div>
            <div class='input-group mb-3'>
                <select name="operador" class="form-select" aria-label="Default select example" required>
                    <option value="adicionar" <?= ($operador == 'adicionar') ? 'selected' : '' ?>>Adicionar</option>
                    <option value="remover" <?= ($operador == 'remover') ? 'selected' : '' ?>>Remover</option>
                </select>
            </div>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Quantidade:</span>
                <input type='number' class='form-control' id='quantidade' name='quantidade' value='<?= $quantidade ?>' required>
            </div>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Descrição:</span>
                <input type='text' class='form-control' id='descricao' name='descricao' value='<?= $descricao ?>' required>
            </div>
            <div class='input-group mb-3'>
                <input class='btn btn-outline-secondary' type='submit' value='Alterar'>
            </div>
        </form>
    </div>
</body>
</html>
<?php
} else {
    header("Location: operacoes.php");
}
?>