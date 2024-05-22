<?php

namespace App;

use PDO;
use PDOException;

class Model
{
    private $connection;

    public function __construct()
    {
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new PDOException($ex->getMessage());
        }
    }

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
