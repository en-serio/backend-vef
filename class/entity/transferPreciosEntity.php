<?php

require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';

class TransferPreciosEntity 
{
    private $conn; // Conexión a la base de datos

    private $idPrecios;
    private $idVehiculo;
    private $idHotel;
    private $precio;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Getters y Setters
    public function getIdPrecios(){return $this->idPrecios;}
    public function setIdPrecios($idPrecios){$this->idPrecios = $idPrecios;}

    public function getIdVehiculo(){return $this->idVehiculo;}
    public function setIdVehiculo($idVehiculo){$this->idVehiculo = $idVehiculo;}

    public function getIdHotel(){return $this->idHotel;}
    public function setIdHotel($idHotel){$this->idHotel = $idHotel;}

    public function getPrecio(){return $this->precio;}
    public function setPrecio($precio){$this->precio = $precio;}

    // Mapear datos desde la base de datos
    public function mapaDB($data)
    {
        $this->idPrecios = $data['idPrecios'] ?? null;
        $this->idVehiculo = $data['idVehiculo'] ?? null;
        $this->idHotel = $data['idHotel'] ?? null;
        $this->precio = $data['precio'] ?? null;
    }

    // CRUD
    public function create()
    {
    $sql = "INSERT INTO transfer_precios (idVehiculo, idHotel, Precio) VALUES (:idVehiculo, :idHotel, :Precio)";
    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':idVehiculo', $this->idVehiculo, PDO::PARAM_INT);
    $stmt->bindValue(':idHotel', $this->idHotel, PDO::PARAM_INT);
    $stmt->bindValue(':Precio', $this->precio, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $this->idPrecios = $this->conn->lastInsertId();
        return true;
    }
    return false;
    }

    public function read($idPrecios)
    {
    $sql = "SELECT * FROM transfer_precios WHERE idPrecios = :idPrecios";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':idPrecios', $idPrecios, PDO::PARAM_INT);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        $this->mapaDB($data);
        return true;
    }
    return false;
    }

    public function update()
    {
    $sql = "UPDATE transfer_precios SET idVehiculo = :idVehiculo, idHotel = :idHotel, Precio = :Precio WHERE idPrecios = :idPrecios";
    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':idVehiculo', $this->idVehiculo, PDO::PARAM_INT);
    $stmt->bindValue(':idHotel', $this->idHotel, PDO::PARAM_INT);
    $stmt->bindValue(':Precio', $this->precio, PDO::PARAM_STR);
    $stmt->bindValue(':idPrecios', $this->idPrecios, PDO::PARAM_INT);

    return $stmt->execute();
    }

    public function delete()
    {
    $sql = "DELETE FROM transfer_precios WHERE idPrecios = :idPrecios";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':idPrecios', $this->idPrecios, PDO::PARAM_INT);

    return $stmt->execute();
    }

}
