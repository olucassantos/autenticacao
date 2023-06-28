<?php
    /**
     * Classe responsável por gerenciar a conexão com o banco de dados SQLite 
     * e executar as operações básicas de CRUD
     */

    class Banco{
        private $conexao; // Armazena a conexão com o banco de dados para uso na classe


        /**
         * Método construtor da classe
         * 
         * Cria a conexão com o banco de dados e cria a tabela de usuários caso não exista
         */
        function __construct(){
            $this->conectar();

            // Checa a existencia da tabela usuarios, ou cria

            $sql = "SELECT name FROM sqlite_master WHERE type='table' AND name='usuarios'";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute();

            if(!$stmt->fetch(PDO::FETCH_ASSOC)){
                self::createDatabase();
            }
        }

        /**
         * Método destrutor da classe
         * 
         * Fecha a conexão com o banco de dados
         */
        function __destruct(){
            $this->desconectar();
        }

        /**
         * Faz a conexão com o banco de dados
         */
        private function conectar(){
            try{
                $this->conexao = new PDO("sqlite:db/usuarios.db");
            }catch(PDOException $e){
                die("Não foi possível estabelecer a conexão com o banco de dados. Erro: " . $e->getMessage());
            }
        }

        /**
         * Fecha a conexão com o banco de dados
         */
        private function desconectar(){
            $this->conexao = null;
        }

        /**
         * Metodo para inserir um usuario no banco de dados
         * 
         * @param Array $usuario Array com os dados do usuário a ser inserido
         * 
         * @return int Retorna o id do usuário inserido
         */
        public function inserirUsuario(Array $usuario){
            try{
                $sql = "INSERT INTO usuarios (nome, usuario, senha) VALUES (:nome, :usuario, :senha)";
                $stmt = $this->conexao->prepare($sql);

                $stmt->bindParam(":nome", $usuario["nome"]);
                $stmt->bindParam(":usuario", $usuario["usuario"]);
                $stmt->bindParam(":senha", $usuario["senha"]);

                $stmt->execute();

                return $this->conexao->lastInsertId();
            }catch(PDOException $e){
                die("Não foi possível inserir o usuário. Erro: " . $e->getMessage());
            }
        }

        /**
         * Busca um usuário no banco de dados a partir de parametros
         * 
         * @param Array $parametros Array com os parametros para a busca
         * 
         * @return Array Retorna um array com os dados do usuário encontrado
         */
        public function buscarUsuario(Array $parametros){
            try{
                // Verifica se o parametro id foi passado
                if(isset($parametros["id"])){
                    // Caso tenha sido, busca o usuário pelo id
                    $sql = "SELECT * FROM usuarios WHERE id = :id"; // Cria a query SQL para buscar o usuário
                    $stmt = $this->conexao->prepare($sql); // Prepara a query para execução no banco de dados
                    $stmt->bindParam(":id", $parametros["id"]); // Substitui o parametro :id pelo valor do parametro passado
                    
                }else if(isset($parametros["usuario"]) && isset($parametros["senha"])){
                    // Caso contrário, busca o usuário pelo usuário e senha
                    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
                    $stmt = $this->conexao->prepare($sql);

                    $stmt->bindParam(":usuario", $parametros["usuario"]);
                    $stmt->bindParam(":senha", $parametros["senha"]);
                }else if (isset($parametros["usuario"])){
                    // Caso contrário, busca o usuário pelo usuário
                    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
                    $stmt = $this->conexao->prepare($sql);

                    $stmt->bindParam(":usuario", $parametros["usuario"]);
                }

                $stmt->execute(); // Executa a query no banco de dados

                return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna o resultado da busca como um array associativo
            }catch(PDOException $e){
                die("Não foi possível buscar o usuário. Erro: " . $e->getMessage());
            }
        }

        public function buscarUsuarios()
        {
            try{
                $sql = "SELECT * FROM usuarios";
                $stmt = $this->conexao->prepare($sql);

                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Aqui retorna todos os usuários como um array associativo
            }catch(PDOException $e){
                die("Não foi possível buscar os usuários. Erro: " . $e->getMessage());
            }
        }

        /**
         * Cria o banco de dados e a tabela de usuários caso não existam
         */
        public static function createDatabase(){
            try{
                $conexao = new PDO("sqlite:db/usuarios.db");

                $sql = "CREATE TABLE usuarios (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome TEXT NOT NULL,
                    usuario TEXT NOT NULL,
                    senha TEXT NOT NULL
                )";

                $conexao->exec($sql);
            }catch(PDOException $e){
                die("Não foi possível criar o banco de dados. Erro: " . $e->getMessage());
            }
        }

    }