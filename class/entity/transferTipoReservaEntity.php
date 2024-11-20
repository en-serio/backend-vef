<?php

class TransferTipoReserva 
{
    private $conn; // Conexión a la base de datos

    private $idTipoReserva;
    private $descripcion;


    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function mapaDB($data)
    {
    $obj = [];
    $obj['id_tipo_reserva'] = $this->getIdTipoReserva();
    $obj['descripcion'] = $this->getDescripcion();

    return $obj;

}

    
    public function getIdTipoReserva(){return $this->idTipoReserva;}
    public function setIdTipoReserva($idTipoReserva){$this->idTipoReserva = $idTipoReserva;}

    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}


    public function insertTransferTipoReserva()
    {

    $query = "INSERT INTO transfer_tipo_reserva (descripcion) VALUES (:descripcion)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':descripcion', $this->descripcion);


    if ($stmt->execute()) {
        return true;
    }

    return false;
    }

    public function selectTransferTipoReserva()
    {
        
    $query = "SELECT * FROM transfer_tipo_reserva WHERE id_tipo_reserva = :id_tipo_reserva";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_tipo_reserva', $this->idTipoReserva);

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {

        $this->idTipoReserva = $row['id_tipo_reserva'];
        $this->descripcion = $row['descripcion'];
    } else {
        return false;
    }

    return true;
    }

    public function update()
    {

    $query = "UPDATE transfer_tipo_reserva SET descripcion = :descripcion WHERE id_tipo_reserva = :id_tipo_reserva";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':descripcion', $this->descripcion);
    $stmt->bindParam(':id_tipo_reserva', $this->idTipoReserva);


    if ($stmt->execute()) {
        return true;
    }

    return false;
    }

    public function delete()
    {

    $query = "DELETE FROM transfer_tipo_reserva WHERE id_tipo_reserva = :id_tipo_reserva";
    $stmt = $this->conn->prepare($query);

    // Vinculamos el parámetro
    $stmt->bindParam(':id_tipo_reserva', $this->idTipoReserva);

    // Ejecutamos la consulta
    if ($stmt->execute()) {
        return true;
    }

    return false;

    }




}