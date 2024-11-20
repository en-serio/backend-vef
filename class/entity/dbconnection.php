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
?>