<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <title>JABank!</title>
        <style>
            body{
                background-color: #F2F2F2
            }
            .login{
                width: 100%;
                height: 100vh;
                align-items: center;
                justify-content: center;
                display: flex;
            }
        </style>
    </head>
    <body>
        <div class="login">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3>Login JABank</h3>
                            </div>
                            <div class="card-body">
                                <form action="login.php" method="post">
                                    <div>
                                        <div class="mb-3">
                                            <label>Usuário</label>
                                            <input type="text" name="usuario" class="form-control">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <label>Senha</label>
                                            <input type="password" name="senha" class="form-control">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn-primary">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>