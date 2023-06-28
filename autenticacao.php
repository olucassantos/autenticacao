<?php
    /**
     * Arquivo para processar a autenticação do usuário
     */

    session_start(); // Inicia a sessão para poder acessar as variáveis de sessão

    require_once 'classes/Autenticacao.php'; // Inclui a classe de autenticação

    // Utiliza os dados que vieram do formulário para criar um array 
    // com os parametros para autenticação
    $parametros = [
        "usuario" => $_POST["usuario"],
        "senha" => $_POST["senha"]
    ];

    // Tenta autenticar o usuário e redireciona para a página home.php 
    // caso a autenticação seja bem sucedida
    // Caso contrário, redireciona para a página index.php com o parâmetro erro=1
    if(Autenticacao::autenticar($parametros)){
        header("Location: home.php");
    }else{
        header("Location: index.php?erro=1");
    }