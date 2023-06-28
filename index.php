<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/app.css">

        <title>Login | Autenticação Usuários</title>
    </head>

    <body>
        <main class="d-flex flex-fill justify-content-center align-items-center vh-100 bg-primary bg-gradient">
            <div class="border rounded p-4 w-25 shadow bg-white bg-gradient">
                <h3>Entrar no Sistema</h3>

                <!-- Mostra mensagem de acordo com cadastro do usuário -->
                <?php if (isset($_GET["sucesso"])) : ?>
                    <div class="alert alert-success">
                        <p class="mb-0">Usuário cadastrado com sucesso!</p>
                    </div>
                <?php endif; ?>

                <form action="autenticacao.php" method="POST">
                    <div class="mb-3">
                        <label for="">Usuário</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>

                    <div class="mb-3">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" name="senha">
                    </div>

                    <!-- Mostra mensagem de acordo com erro de login -->
                    <?php if (isset($_GET["erro"])) : ?>
                        <div class="alert alert-danger">
                            <p class="mb-0">Usuário ou senha não encontrados</p>
                        </div>
                    <?php endif; ?>

                    <button class="btn btn-primary">Entrar</button>
                </form>

                <p class="mt-3">Ainda não é cadastrado? <a href="cadastro.php">Cadastre-se</a></p>

            </div>
        </main>
    </body>

</html>