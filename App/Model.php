<?php

namespace App;

use PDO;
use PDOException;

class Model
{
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
            $this->connection = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

    // Método responsável por executar as queries dentro do banco de dados:
    public function query($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage());
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
