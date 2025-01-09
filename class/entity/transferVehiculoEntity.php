<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';


class TransferVehiculoEntity 
{
    private $conn; // Conexión a la base de datos

    private $idVehiculo;
    private $descripcion;
    private $idCliente;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Getters y Setters

    public function getIdVehiculo(){return $this->idVehiculo;}
    public function setIdVehiculo($idVehiculo){$this->idVehiculo = $idVehiculo;}

    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}

    public function getIdCliente(){return $this->idCliente;}
    public function setIdCliente($idCliente){$this->idCliente = $idCliente;}
    
    
    public function mapaDB()
    {
        $obj['id_vehiculo'] = $this->getIdVehiculo();
        $obj['descripcion'] = $this->getDescripcion();
        $obj['idCliente'] = $this->getIdCliente();
    
        return $obj;
    }
    

    public function insertTransferVehiculo($descripcion, $idCliente)
    {

    $query = "INSERT INTO transfer_vehiculo (id_vehiculo, descripcion, idCliente) 
              VALUES (:id_vehiculo, :descripcion, :idCliente)";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_vehiculo', $this->idVehiculo);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':idCliente', $idCliente);

    if ($stmt->execute()) {
        $idVehiculo = $this->conn->lastInsertId(); // Obtener el último ID insertado
        return $idVehiculo;
    }

    return null;
    }

    public function selectTransferVehiculo()
    {

    $query = "SELECT idVehiculo, descripcion, idCliente FROM transfer_vehiculo WHERE idVehiculo = :idVehiculo";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':idVehiculo', $this->idVehiculo);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->idVehiculo = $row['idVehiculo'];
        $this->descripcion = $row['descripcion'];
        $this->idCliente = $row['idCliente'];

        return true;
    }

    return false;
    }

    public function update()
    {

    $query = "UPDATE transfer_vehiculo SET descripcion = :descripcion, idCliente = :idCliente WHERE idVehiculo = :idVehiculo";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':idVehiculo', $this->idVehiculo);
    $stmt->bindParam(':descripcion', $this->descripcion);
    $stmt->bindParam(':idCliente', $this->idCliente);

    if ($stmt->execute()) {
        return true;
    }

    return false;
    }

    public function delete()
    {

    $query = "DELETE FROM transfer_vehiculo WHERE idVehiculo = :idVehiculo";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':idVehiculo', $this->idVehiculo);

    if ($stmt->execute()) {
        return true;
    }

    return false;
    }





}

