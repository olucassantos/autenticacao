<?php
    require_once("classes\Banco.php"); // Inclui a classe do banco de dados

    // Cria uma instância do banco de dados
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

    // Cria um array com os dados do usuário para inserir no banco
    $usuario = [
        "nome" => $_POST["nome"],
        "usuario" => $_POST["usuario"],
        "senha" => $_POST["senha"]
    ];

    // Insere o usuário no banco
    $usuarioId = $banco->inserirUsuario($usuario);

    // Redireciona para a página index.php com o parâmetro sucesso=1
    // Caso contrário, redireciona para a página cadastro.php com o parâmetro erro=4
    if($usuarioId){
        header("Location: index.php?sucesso=1");
    }else{
        header("Location: cadastro.php?erro=4");
    }
    