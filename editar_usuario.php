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
        <h1 class="display-4">Editar usuário</h1>
    </div>
        <?php
            // Incluir arquivo de configuração
            include 'config.php';
            
            // Criar conexão
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Verificar conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }
            // Verificar se um CPF foi fornecido para filtrar os logs
            if (isset($_GET['cpf']) && !empty($_GET['cpf'])) {
                // Construir a consulta SQL base
                $cpf = $_GET['cpf'];
                $sql = "SELECT * FROM users WHERE cpf='$cpf'";
                $res = $conn->query($sql) or die($conn->error);
                $row = $res->fetch_assoc();
                $qtd = $res->num_rows;
                $name = $row["name"];
                $fone = $row["fone"];
                $email = $row["email"];
                
                if($qtd < 1){
                    echo"
                    <div class='d-flex justify-content-center'>
                        <h1 class='display-6'>Usuário não encontrado</h1>
                    </div>
                    ";
                }

            }
        ?>
    <div class="d-flex justify-content-center">
        <?php
            if (isset($_GET['cpf']) && !empty($_GET['cpf'])) {
                // Se tem CPF no GET
                if ($qtd < 1){
                    // Se não encontrou o cadastro
                    // Formulário aberto + CPF
                    echo "
                        <form action='editar_usuario.php' method='submit'>
                            <div class='input-group mb-3'>
                                <span class='input-group-text'>CPF:</span>
                                <input type='text' class='form-control' id='cpf' name='cpf' value='$cpf' required>
                            </div>
                            <div class='input-group mb-3'>
                                <input class='btn btn-outline-secondary' type='submit' value='Pesquisar'>
                            </div>
                        </form>
                    ";
                } else {
                    echo "
                        <form action='editar.php' method='post'>
                            <fieldset disabled>
                                <div class='input-group mb-3'>
                                    <span class='input-group-text'>CPF:</span>
                                    <input type='text' class='form-control' id='cpf' name='cpf' value='$cpf' required>
                                </div>
                            </fieldset>
                            <input type='hidden' name='cpf_hidden' value='$cpf'>
                            <div class='input-group mb-3'>
                                <span class='input-group-text'>Nome:</span>
                                <input type='text' class='form-control' id='name' name='name' value='$name' required>
                            </div>
                            <div class='input-group mb-3'>
                                <span class='input-group-text'>Celular:</span>
                                <input type='text' class='form-control' id='celular' name='celular' value='$fone' required>
                            </div>
                            <div class='input-group mb-3'>
                                <input class='btn btn-outline-secondary' type='submit' value='Alterar'>
                            </div>
                        </form>
                    ";

                    echo "
                        <fieldset disabled>
                            
                        </fieldset>
                    ";
                }
            } else {
                // Formulário aberto sem CPF
                echo "
                    <form action='editar_usuario.php' method='submit'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>CPF:</span>
                            <input type='text' class='form-control' id='cpf' name='cpf' required>
                        </div>
                        <div class='input-group mb-3'>
                            <input class='btn btn-outline-secondary' type='submit' value='Pesquisar'>
                        </div>
                    </form>
                ";

                
            }
        ?>
    </div>
</body>
</html>