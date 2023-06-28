<?php
    /**
     * Arquivo para processar a autenticação do usuário
     */

    session_start();

    require_once 'classes/Autenticacao.php';

    $parametros = [
        "usuario" => $_POST["usuario"],
        "senha" => $_POST["senha"]
    ];

    if(Autenticacao::autenticar($parametros)){
        header("Location: home.php");
    }else{
        header("Location: index.php?erro=1");
    }