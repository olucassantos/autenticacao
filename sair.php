<?php 
    session_start(); // Inicia a sessão para poder acessar as variáveis de sessão

    require_once 'classes/Autenticacao.php'; // Inclui a classe de autenticação

    Autenticacao::deslogar(); // Chama o método de deslogar da classe de autenticação