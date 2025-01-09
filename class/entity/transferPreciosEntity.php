<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';


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
    public function insertPrecio($idHotel, $idVehiculo, $precioTotal)
    {
    $sql = "INSERT INTO transfer_precios (id_vehiculo, id_hotel, Precio) VALUES (:id_vehiculo, :id_hotel, :Precio)";
    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':id_vehiculo', $idVehiculo);
    $stmt->bindValue(':id_hotel', $idHotel);
    $stmt->bindValue(':Precio', $precioTotal);

    if ($stmt->execute()) {
        $this->idPrecios = $this->conn->lastInsertId();
        return true;
    }
    return false;
    }

    public function getPrecios($idPrecios)
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

    public function getAllPreciosByUser($user)
    {
    $sql = "
        SELECT 
            tp.id_hotel, 
            tp.id_vehiculo, 
            tp.precio, 
            th.usuario, 
            c.idCliente, 
            c.email, 
            c.nombre, 
            c.apellido1, 
            tr.id_tipo_reserva,
            th.nombre_hotel AS nombre_hotel 
        FROM 
            transfer_precios tp
        INNER JOIN 
            tranfer_hotel th ON tp.id_hotel = th.id_hotel
        INNER JOIN 
            transfer_reservas tr ON tp.id_hotel = tr.id_hotel
        INNER JOIN 
            cliente c ON th.idCliente = c.idCliente
        WHERE 
            c.nombreUsuario = :user
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':user', $user, PDO::PARAM_STR);

    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result; 

    } catch (PDOException $e) {
        throw new Exception("Error al obtener los precios: " . $e->getMessage());
    }
    }



    public function delete()
    {
    $sql = "DELETE FROM transfer_precios WHERE idPrecios = :idPrecios";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':idPrecios', $this->idPrecios, PDO::PARAM_INT);

    return $stmt->execute();
    }

}
