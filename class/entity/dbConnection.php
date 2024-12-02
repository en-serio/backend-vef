<<<<<<< HEAD
<?php



class Database
{
 
    public static function getConnection()
    {
        $conn = null;
        try {
            $host = 'localhost'; 
            $db_name = 'vef_php';
            $username = 'root';
            $password = 'root';
            
            $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
    
        return $conn;
    }
}
=======
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
>>>>>>> 57a8bd8 (bugfixes)
?>