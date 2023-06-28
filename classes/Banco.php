<?php
    /**
     * Classe responsável por gerenciar a conexão com o banco de dados SQLite 
     * e executar as operações básicas de CRUD
     */

    class Banco{
        private $conexao;

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

        function __destruct(){
            $this->desconectar();
        }

        private function conectar(){
            try{
                $this->conexao = new PDO("sqlite:db/usuarios.db");
            }catch(PDOException $e){
                die("Não foi possível estabelecer a conexão com o banco de dados. Erro: " . $e->getMessage());
            }
        }

        private function desconectar(){
            $this->conexao = null;
        }

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

        public function buscarUsuario(Array $parametros){
            try{
                if(isset($parametros["id"])){
                    $sql = "SELECT * FROM usuarios WHERE id = :id";
                    $stmt = $this->conexao->prepare($sql);
                    $stmt->bindParam(":id", $parametros["id"]);
                }else if(isset($parametros["usuario"]) && isset($parametros["senha"])){
                    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
                    $stmt = $this->conexao->prepare($sql);

                    $stmt->bindParam(":usuario", $parametros["usuario"]);
                    $stmt->bindParam(":senha", $parametros["senha"]);
                }else if (isset($parametros["usuario"])){
                    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
                    $stmt = $this->conexao->prepare($sql);

                    $stmt->bindParam(":usuario", $parametros["usuario"]);
                }

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
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

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                die("Não foi possível buscar os usuários. Erro: " . $e->getMessage());
            }
        }

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