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

            $usuario = $banco->buscarUsuario($parametros);

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
            session_destroy();
            header("Location: index.php");
        }

        public static function getUsuario(){
            $banco = new Banco();

            return $banco->buscarUsuario([ 'usuario' => $_SESSION["usuario"] ]);
        }
    }