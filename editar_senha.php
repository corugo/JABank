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
    <title>Editar usuário</title>
</head>
<body>
	<?php include 'header.php'; ?>
    <div class="d-flex justify-content-center">
        <h1 class="display-4">Editar senha</h1>
    </div>
    <div class="d-flex justify-content-center">
        <form action='editar_senha_acao.php' method='post'>
            <div class='input-group mb-3'>
                <span class='input-group-text'>CPF:</span>
                <input type='text' class='form-control' id='cpf' name='cpf' required>
            </div>
            <div class='input-group mb-3'>
                <span class='input-group-text'>Senha nova:</span>
                <input type='password' class='form-control' id='senha' name='senha'>
            </div>
            <div class='input-group mb-3'>
                <input class='btn btn-outline-secondary' type='submit' value='Alterar'>
            </div>
        </form>
    </div>
</body>
</html>