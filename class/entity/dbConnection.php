<?php

class Database
{

    private $host = 'localhost';
    private $db_name = 'vef_php';
    private $username = 'root';
    private $password = 'AideaMariaDB..';
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            $e->getMessage();
        }

        return $this->conn;
    }
}
?>