<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';

/*include_once '../entity/dbConnection.php';
include_once '../controller/controller.php';*/

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
    

    public function insertTransferZona($descripcion)
    {
        try 
        {
            $query = "INSERT INTO transfer_zona (descripcion) 
                  VALUES (:descripcion)";
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':descripcion', $descripcion);
            if ($stmt->execute()) {
                // Recuperar el ID generado automáticamente
                $idZona = $this->conn->lastInsertId();    
            }
            return $idZona;

        }catch(PDOException $e){}
            error_log("Error al insertar en la tabla: " . $e->getMessage());
            return false;
    }

    public function selectTransferZona($idZona)
    {
        try 
        {
            $query = "SELECT id_zona, descripcion FROM transfer_zona WHERE id_zona = :id_zona";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_zona', $idZona);
            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->idZona = $row['id_zona'];
                $this->descripcion = $row['descripcion'];
                return $row;
            }

        }catch(PDOException $e){}
        error_log("Error al cargar la zona:" . $e->getMessage());
        return false;
    
    }

    public function getZonas()
    {
        try 
        {
            $query = "SELECT * FROM transfer_zona";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($row) {
                $this->mapaDB($row);
                return $row;
            }

        }catch(PDOException $e){}
        error_log("Error al cargar la zona:" . $e->getMessage());
        return false;
    
    }

    public function update($idZona, $descripcion)
    {
        $query = "UPDATE transfer_zona SET descripcion = :descripcion WHERE id_zona = :id_zona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_zona', $idZona);
        $stmt->bindParam(':descripcion', $descripcion);
        if ($stmt->execute()) {
            return [
                'id_zona' => $idZona,
                'descripcion' => $descripcion
            ];
        }
        return false;
    }

    public function delete($idZona)
    {
        $query = "DELETE FROM transfer_zona WHERE id_zona = :id_zona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_zona', $idZona);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function countTransferZonaforDelete($idZona)
    {
        $query = "SELECT COUNT(*) FROM tranfer_hotel WHERE id_zona = :id_zona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_zona', $idZona);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {

            echo json_encode(['error' => true, 'message' => 'No se puede eliminar esta zona porque está siendo utilizada en un transfer.']);
        } else {

            $query = "DELETE FROM transfer_zona WHERE id_zona = :id_zona";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_zona', $idZona);
            $stmt->execute();
            
            echo json_encode(['error' => false, 'message' => 'Zona eliminada correctamente.']);
        }
    }

    public function checkZonaUsage($idZona): array
    {
    $sql = "
        SELECT COUNT(*) FROM tranfer_hotel WHERE id_zona = :idZona";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idZona', $idZona, PDO::PARAM_INT);
    $stmt->execute();
    

    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        return ['error' => true, 'message' => 'No se puede eliminar esta zona porque está siendo utilizada en un transfer.'];
    }
    
    return ['error' => false, 'message' => 'La zona no está siendo utilizada y puede eliminarse.'];
    }

    public function getNombreZona($id)
{
    try 
    {
        $query = "SELECT descripcion FROM transfer_zona WHERE id_zona = :id_zona";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_zona', $id, PDO::PARAM_INT); // Usamos $id
        $stmt->execute();
        
        $descripcion = $stmt->fetchColumn();

        if ($descripcion) {
            return $descripcion;
        }

    } catch(PDOException $e) {
        error_log("Error al cargar la zona: " . $e->getMessage());
    }
    
    return false;
}

}