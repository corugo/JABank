<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <script src="js/bootstrap.bundle.min.js"></script>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">JABank</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="ranking.php">Ranking</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuários
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item disabled" href="#">Correntistas</a></li>
                            <li><a class="dropdown-item" href="cadastro_usuario.php">Cadastrar</a></li>
                            <li><a class="dropdown-item" href="editar_usuario.php">Editar</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item disabled" href="#">Administradores</a></li>
                            <li><a class="dropdown-item" href="editar_senha.php">Alterar senha</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pagar.php">Pagar/cobrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logs.php">Extrato</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Configurações
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item disabled" href="#">Operações</a></li>
                            <li><a class="dropdown-item" href="operacoes.php">Listar</a></li>
                            <li><a class="dropdown-item" href="operacoes_add.php">Adicionar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php print $_SESSION["name"];?></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php" tabindex="-1" >Sair</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </body>
</html>
