<?php
    /**
     * Classe para processar a autenticação do usuário
    */

    require_once 'classes/Banco.php';

    class Autenticacao{
        /**
         * Método para autenticar o usuário
         * 
         * @param Array $parametros [usuario => string, senha => string]
         */
        public static function autenticar(Array $parametros){
            $banco = new Banco();

            // Busca o usuário no banco
            $usuario = $banco->buscarUsuario($parametros);

            // Verifica se o usuário existe e se a senha está correta
            // Caso esteja, armazena o usuário na sessão e retorna true
            if($usuario){
                $_SESSION["usuario"] = $usuario['usuario'];
                return true;
            }else{
                return false;
            }
        }

        /**
         * Método para verificar se o usuário está autenticado
        */
        public static function verificarAutenticacao(){
            if(!isset($_SESSION["usuario"])){
                header("Location: index.php");
            }
        }

        /**
         * Método para deslogar o usuário
        */
        public static function deslogar(){
            session_destroy(); // Destrói a sessão
            header("Location: index.php");
        }

        /**
         * Método para retornar o usuário autenticado
        */
        public static function getUsuario(){
            $banco = new Banco();

            // Busca o usuário no banco a partir do nome de usuário armazenado na sessão
            return $banco->buscarUsuario([ 'usuario' => $_SESSION["usuario"] ]);
        }
    }