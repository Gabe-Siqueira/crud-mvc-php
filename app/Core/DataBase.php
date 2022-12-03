<?php 

namespace app\Core;

use PDO;

class DataBase extends PDO
{
    private $DB_HOST = '127.0.0.1';
    private $DB_DATABASE = 'crud_mvc_php';
    private $DB_USER = 'gabriel';
    private $DB_PASSWORD = 'Lemafehu1@#';

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql: host=$this->DB_HOST; dbname=$this->DB_DATABASE;, '$this->DB_USER', '$this->DB_PASSWORD'");
    }

    /**
    * assign query keys
    *
    * @param PDOStatement   $stmt
    * @param string         $key
    * @param string         $value
    */
    private function setParameters($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    /**
    * provide data to setParameters().
    *
    * @param PDOStatement   $stmt
    * @param array          $parameters
    */
    private function mountQuery($stmt, $parameters)
    {
        foreach ($parameters as $key => $value) {
            $this->setParameters($stmt, $key, $value);
        }
    }

    /**
    * provide data to setParameters().
    *
    * @param string $query
    * @param array  $parameters
    *
    * @return PDOStatement
    */
    public function executeQuery(string $query, array $parameters = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->mountQuery($stmt, $parameters);
        $stmt->execute();
        return $stmt;
    }
}