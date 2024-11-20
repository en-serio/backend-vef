<?php

require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';

class TransferHotelEntity 
{
    private $conn;
    private $idHotel;
    private $idZona;
    private $comision;
    private $usuario;
    private $idCliente;
    private $nombreHotel;
    private $direccionHotel;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getIdHotel() {return $this->idHotel;}
    public function getIdZona() {return $this->idZona;}
    public function getComision() {return $this->comision;}
    public function getUsuario() {return $this->usuario;}
    public function getIdCliente() {return $this->idCliente;}
    public function getNombreHotel($nombreHotel) {$this->nombreHotel = $nombreHotel;}
    public function getDireccionHotel($direccionHotel) {$this->direccionHotel = $direccionHotel;}

    // Setters
    public function setIdHotel($idHotel) {$this->idHotel = $idHotel;}
    public function setIdZona($idZona) {$this->idZona = $idZona;  }
    public function setComision($comision) {$this->comision = $comision;}
    public function setUsuario($usuario) {$this->usuario = $usuario;}
    public function setIdCliente($idCliente) {$this->idCliente = $idCliente;}
    public function setNombreHotel($nombreHotel) {$this->nombreHotel = $nombreHotel;}
    public function setDireccionHotel($direccionHotel) {$this->direccionHotel = $direccionHotel;}

    public function mapaDB($row)
    {
        $this->idHotel = $row['idHotel'];
        $this->idZona = $row['idZona'];
        $this->comision = $row['comision'];
        $this->usuario = $row['usuario'];
        $this->idCliente = $row['idCliente'];
        $this->nombreHotel = $row['nombre_hotel'];
        $this->direccionHotel = $row['direccion_hotel'];
    }

    // CRUD
    public function createHotel()
    {
        $sql = "INSERT INTO tranfer_hotel (id_zona, comision, usuario, idCliente, nombre_hotel, direccion_hotel) 
                VALUES (:id_zona, :comision, :usuario, :idCliente, :nombre_hotel, :direccion_hotel)";
        
        $stmt = $this->conn->prepare($sql);
        //$stmt->bindParam(':idHotel', $this->idHotel);
        $stmt->bindParam(':id_zona', $this->idZona);
        $stmt->bindParam(':comision', $this->comision);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':nombre_hotel', $nombreHotel);
        $stmt->bindParam(':direccion_hotel', $direccionHotel);

        return $stmt->execute();
    }

    public function getHotel($id)
    {
        $sql = "SELECT * FROM transfer_hotel WHERE idHotel = :idHotel";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHotel', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->mapaDB($row);
            return $this;
        }

        return null;
    }

    public function update()
    {
        $sql = "UPDATE transfer_hotel 
                SET idZona = :idZona, comision = :comision, usuario = :usuario, idCliente = :idCliente, nombreHotel = :nombre_hotel, direccionHotel = :direccion_hotel 
                WHERE idHotel = :idHotel";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHotel', $this->idHotel);
        $stmt->bindParam(':idZona', $this->idZona);
        $stmt->bindParam(':comision', $this->comision);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':nombre_hotel', $nombreHotel);
        $stmt->bindParam(':direccion_hotel', $direccionHotel);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM transfer_hotel WHERE idHotel = :idHotel";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHotel', $id);

        return $stmt->execute();
    }


    public function insertHotel($idZona, $comision, $idCliente, $user, $nombreHotel, $direccionHotel)
    {
        $sql = "INSERT INTO tranfer_hotel (id_zona, comision, usuario, idCliente, nombre_hotel, direccion_hotel) 
                VALUES (:id_zona, :comision, :usuario, :idCliente, :nombre_hotel, :direccion_hotel)";
        
        $stmt = $this->conn->prepare($sql);
        //$stmt->bindParam(':idHotel', $this->idHotel);
        $stmt->bindParam(':id_zona', $idZona);
        $stmt->bindParam(':comision', $comision);
        $stmt->bindParam(':usuario', $user);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':nombre_hotel', $nombreHotel);
        $stmt->bindParam(':direccion_hotel', $direccionHotel);

        if ($stmt->execute()) {
            $this->idHotel = $this->conn->lastInsertId(); // Obtener el último ID insertado
            return $this->idHotel;
        }
        return false;
    }
}
