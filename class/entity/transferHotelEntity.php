<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferZonaEntity.php';



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
    public function getNombreHotel() {return $this->nombreHotel;}
    public function getDireccionHotel() {return $this->direccionHotel;}

    // Setters
    public function setIdHotel($idHotel) {$this->idHotel = $idHotel;}
    public function setIdZona($idZona) {$this->idZona = $idZona;  }
    public function setComision($comision) {$this->comision = $comision;}
    public function setUsuario($usuario) {$this->usuario = $usuario;}
    public function setIdCliente($idCliente) {$this->idCliente = $idCliente;}
    public function setNombreHotel($nombreHotel) {$this->nombreHotel = $nombreHotel;}
    public function setDireccionHotel($direccionHotel) {$this->direccionHotel = $direccionHotel;}

    public function mapaDB($data)
    {

        $obj = [];
        $obj['id_hotel'] = $this->getIdHotel();
        $obj['id_zona'] = $this->getIdZona();
        $obj['Comision'] = $this->getComision();
        $obj['usuario'] = $this->getUsuario();
        $obj['idCliente'] = $this->getIdCliente();
        $obj['nombre_hotel'] = $this->getNombreHotel();
        $obj['direccion_hotel'] = $this->getDireccionHotel();
        
    return $obj;

    }
    
    // CRUD
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
            $this->idHotel = $this->conn->lastInsertId(); 
            return $this->idHotel;
        }
        return false;
    }

    public function getHotel($id)
    {
        $sql = "SELECT * FROM tranfer_hotel WHERE id_hotel = :id_hotel";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_hotel', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->mapaDB($row);
            return $row;
        }

        return null;
    }

    public function getHotelesSinRepetir():array
    {
        $sql = "SELECT DISTINCT nombre_hotel, direccion_hotel, id_zona, Comision, usuario FROM tranfer_hotel";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($row) {
            $this->mapaDB($row);
            return $row;
        }

        return null;
    }

    public function update()
    {
        $sql = "UPDATE tranfer_hotel 
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
        $sql = "DELETE FROM tranfer_hotel WHERE idHotel = :idHotel";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHotel', $id);

        return $stmt->execute();
    }


    
}
