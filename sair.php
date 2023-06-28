<?php 

    session_start();

    require_once 'classes/Autenticacao.php';

    Autenticacao::deslogar();