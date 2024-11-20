<?php

require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';

class TransferZonaEntity 
{
    private $conn; // Conexión a la base de datos

    private $idZona;
    private $descripcion;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Getters y Setters

    public function getidZona(){return $this->idZona;}
    public function setIdVehiculo($idZona){$this->idZona = $idZona;}

    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}


    
    
    public function mapaDB()
    {
        $obj['id_zona'] = $this->getidZona();
        $obj['descripcion'] = $this->getDescripcion();
    
        return $obj;
    }
    

    public function insertTransferZona()
    {
        $query = "INSERT INTO transfer_precios (idZona, descripcion) 
                  VALUES (:idZona, :descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idZona', $this->idZona);
        $stmt->bindParam(':descripcion', $this->descripcion);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function selectTransferZona()
    {
        $query = "SELECT idZona, descripcion FROM transfer_precios WHERE idZona = :idZona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idZona', $this->idZona);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->idZona = $row['idZona'];
            $this->descripcion = $row['descripcion'];
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = "UPDATE transfer_precios SET descripcion = :descripcion WHERE idZona = :idZona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idZona', $this->idZona);
        $stmt->bindParam(':descripcion', $this->descripcion);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM transfer_precios WHERE idZona = :idZona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idZona', $this->idZona);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}