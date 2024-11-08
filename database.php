<?php

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
        // Configuración por defecto de conexión a la base de datos
        $host = 'mysql';
        $dbname = 'islaTransfer';
        $username = 'root';
        $password = 'root';

        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
    }

    // Método para conectar a la base de datos
    private function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Método para ejecutar consultas SELECT
    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    // Método para ejecutar consultas INSERT, UPDATE, DELETE
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            die("Error en la ejecución de la consulta: " . $e->getMessage());
        }
    }

    // Método para obtener el último ID insertado
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    // Método para cerrar la conexión
    public function closeConnection()
    {
        $this->pdo = null;
    }
}

?>