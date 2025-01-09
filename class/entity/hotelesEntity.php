<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferZonaEntity.php';



class HotelesEntity 
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
        $obj['idCliente'] = $this->getIdCliente();
        $obj['nombre_hotel'] = $this->getNombreHotel();
        $obj['direccion_hotel'] = $this->getDireccionHotel();
        
    return $obj;

    }
    
    // CRUD
    public function insertHotel($idZona, $comision, $idCliente, $nombreHotel, $direccionHotel)
    {
        $sql = "INSERT INTO hoteles (id_zona, comision, idCliente, nombre_hotel, direccion_hotel) 
                VALUES (:id_zona, :comision, :idCliente, :nombre_hotel, :direccion_hotel)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_zona', $idZona);
        $stmt->bindParam(':comision', $comision);
        $stmt->bindParam(':idCliente', $idCliente);
        $stmt->bindParam(':nombre_hotel', $nombreHotel);
        $stmt->bindParam(':direccion_hotel', $direccionHotel);

        if ($stmt->execute()) {
            $this->idHotel = $this->conn->lastInsertId(); 
            return $this->idHotel;
        }
        return false;
    }

    public function getHotelArray(array $ids) 
    {
    if (empty($ids)) {
        throw new Exception("El array de IDs está vacío.");
    }

    $idsArray = array_map(function($subarray) {
        return $subarray['id_hotel'];
    }, $ids);


    $placeholders = implode(',', array_fill(0, count($idsArray), '?'));


    $sql = "SELECT * FROM hoteles WHERE id_hotel IN ($placeholders)";
    $stmt = $this->conn->prepare($sql);

    foreach ($idsArray as $index => $idValue) {
        $stmt->bindValue($index + 1, $idValue, PDO::PARAM_INT);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        foreach ($rows as &$row) {
            $this->mapaDB($row); 
        }
        return $rows;
    }

    return null;
    }



    public function getHotelString($id):array
    {
        $sql = "SELECT * FROM hoteles WHERE id_hotel = :id_hotel";
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

    public function getHoteles():array
    {
        $sql = "SELECT *  FROM hoteles ORDER BY id_Hotel";
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
        $sql = "UPDATE hoteles 
                SET idZona = :idZona, comision = :comision, idCliente = :idCliente, nombreHotel = :nombre_hotel, direccionHotel = :direccion_hotel 
                WHERE idHotel = :idHotel";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHotel', $this->idHotel);
        $stmt->bindParam(':idZona', $this->idZona);
        $stmt->bindParam(':comision', $this->comision);
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':nombre_hotel', $nombreHotel);
        $stmt->bindParam(':direccion_hotel', $direccionHotel);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM hoteles WHERE idHotel = :idHotel";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHotel', $id);

        return $stmt->execute();
    }

    public function getIdHotelByIdCliente($idCliente): array
    {
    $sql = "SELECT id_hotel FROM hoteles WHERE idCliente = :idCliente";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idCliente', $idCliente, PDO::FETCH_ASSOC);

    $stmt->execute();

    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($row) {
        return $row; 
    }

    return [];
    }




    
}
