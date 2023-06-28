<?php
    require_once("classes\Banco.php");

    $banco = new Banco();

    // Valida os dados do usuário
    if(empty($_POST["nome"]) || empty($_POST["usuario"]) || empty($_POST["senha"])){
        header("Location: cadastro.php?erro=3");
        exit;
    }

    // Verificar se a senha e a confirmação são iguais
    if ($_POST["senha"] != $_POST["senha_confirmacao"]) {
        header("Location: cadastro.php?erro=1");
        exit;
    }

    // Verifica se o usuário já existe no banco
    $usuario = $banco->buscarUsuario(["usuario" => $_POST["usuario"]]);
    if ($usuario) {
        header("Location: cadastro.php?erro=2");
        exit;
    }

    $usuario = [
        "nome" => $_POST["nome"],
        "usuario" => $_POST["usuario"],
        "senha" => $_POST["senha"]
    ];

    $usuarioId = $banco->inserirUsuario($usuario);

    if($usuarioId){
        header("Location: index.php?sucesso=1");
    }else{
        header("Location: cadastro.php?erro=4");
    }
    