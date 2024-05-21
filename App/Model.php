<?php

namespace App;

use PDO;
use PDOException;

class Model
{
    // Host de conexão com o banco de dados:
    const HOST = "localhost:3306";

    // Nome do banco de dados:
    const NAME = "gerenciador_escolar";

    // Usuário do banco de dados:
    const USER = "root";

    // Senha de acesso ao banco de dados:
    const PASS = "abc123";

    // Instância de conexão com o banco de dados:
    private $connection;

    // Define a tabela e instância a conexão:
    public function __construct()
    {
        $this->setConnection();
    }

    // Método responsável por criar uma conexão com o banco de dados:
    private function setConnection()
    {
        try {
            // TENTANDO FAZER A CONEXÃO COM O BANCO DE DADOS:
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    // Método responsável por executar as queries dentro do banco de dados:
    public function query($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $e) {
            die("EROR: " . $e->getMessage());
        }
    }

    protected function mapToBind($data)
    {
        $map = [];

        foreach ($data as $key => $value) {
            $map[':' . $key] = $value;
            $map[':' . $key] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        return $map;
    }
}
