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
    <title>Cadastro de Usuário</title>
</head>
<body>
	<?php include 'header.php'; ?>
    <div class="d-flex justify-content-center">
        <h1 class="display-4">Cadastro de usuário</h1>
    </div>
    <div class="d-flex justify-content-center">
        <form action="cadastro.php" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text">CPF:</span>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Nome:</span>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Data de Nascimento:</span>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Celular:</span>
                <input type="text" class="form-control" id="celular" name="celular" required>
            </div>
            <div class="input-group mb-3">
                <input class="btn btn-outline-secondary" type="submit" value="Cadastrar">
            </div>
        </form>
    </div>
</body>
</html>