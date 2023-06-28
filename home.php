<?php
    session_start();

    require_once 'classes/Autenticacao.php';

    Autenticacao::verificarAutenticacao();

    $usuario = Autenticacao::getUsuario();
    $usuarios = (new Banco)->buscarUsuarios();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/app.css">

        <title>Home | Autenticação Usuários</title>
    </head>
    <body>
        <main class="d-flex flex-fill flex-column vh-100">
            <nav class="navbar navbar-expand-sm bg-primary bg-gradient">
                <div class="container-fluid">
                    <a class="navbar-brand mb-0 h1 text-white" href="#">SysCad</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                        aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarID">
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link active text-white" aria-current="page" href="sair.php">Sair</a>
                        </div>
                    </div>
                </div>
            </nav>
            
            <div class="d-flex flex-row flex-fill">
                <div class="w-25 border-end">
                    <div class="m-1 p-2">
                        <h1><?= $usuario['nome'] ?></h1>
    
                        <p>@<?= $usuario['usuario'] ?></p>
                    </div>
                </div>
    
                <div class="w-75">
                    <div class="m-1 p-2">
                        <h1>Usuários</h1>

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Usuário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= $usuario['nome'] ?></td>
                                        <td><?= $usuario['usuario'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </body>
</html>