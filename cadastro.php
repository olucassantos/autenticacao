<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/app.css">

        <title>Cadastro de Usuário | Autenticação Usuários</title>
    </head>
    <body>
        <main class="d-flex flex-fill justify-content-center align-items-center vh-100 bg-info bg-gradient">
            <div class="border rounded p-4 w-50 bg-white bg-gradient">
                <h3>Cadastro de usuário</h3>

                <form action="armazenar.php" method="POST">
                    <!-- Mostra mensagens de acordo com o cadastro do usuario -->
                    
                    <?php if(isset($_GET['erro'])): ?>

                        <?php if($_GET['erro'] == '1'): ?>
                            <div class="alert alert-danger">
                                <p class="mb-0">As senhas não conferem</p>
                            </div>
                        <?php endif; ?>

                        <?php if($_GET['erro'] == '2'): ?>
                            <div class="alert alert-danger">
                                <p class="mb-0">Usuário já está cadastrado</p>
                            </div>
                        <?php endif; ?>

                        <?php if($_GET['erro'] == '3'): ?>
                            <div class="alert alert-danger">
                                <p class="mb-0">É necessário preencher todos os campo</p>
                            </div>
                        <?php endif; ?>
                        
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" name="nome">
                    </div>

                    <div class="mb-3">
                        <label for="">Usuário</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>

                    <div class="mb-3">
                        <label for="">Senha</label>
                        <input type="password" class="form-control" name="senha">
                    </div>

                    <div class="mb-3">
                        <label for="">Confirme a Senha</label>
                        <input type="password" class="form-control" name="senha_confirmacao">
                    </div>

                    <button class="btn btn-primary">Entrar</button>
                </form>

                <p class="mt-3">Já é cadastrado? <a href="index.php">Entrar</a></p>

            </div>
        </main>
    </body>
</html>