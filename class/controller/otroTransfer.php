<?php
include_once '../class/entity/transferEntity.php';
include_once '../class/entity/dbConnection.php';
/*
class otroTransfer {
    private $conn; // Conexión a la base de datos


    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function updateZona($descripcion, $id){
        $stmt = $this->conn->prepare("UPDATE transfer_zona SET descripcion = ? WHERE id_zona = ?");
        if(!$stmt){
            echo json_encode([
                'error' => true,
                'message' => 'Error al actualizar la zona ' 
            ]);
        }
        $stmt->bind_param('si', $descripcion, $id);
        if($stmt->execute()){
            echo json_encode([
                'error' => false,
                'message' => 'Zona actualizada correctamente.',
                'data' => [
                    'id' => $id,
                    'descripcion' => $descripcion
                ]
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al actualizar la zona '
            ]);
        }
    }

    public function updateTipo($descripcion, $id){
        $stmt = $this->conn->prepare("UPDATE transfer_tipo_reserva SET Descripción = ? WHERE id_tipo_reserva = ?");
        if(!$stmt){
            echo json_encode([
                'error' => true,
                'message' => 'Error al actualizar el tipo ' 
            ]);
        }
        $stmt->bind_param('si', $descripcion, $id);
        if($stmt->execute()){
            echo json_encode([
                'error' => false,
                'message' => 'Tipo actualizado correctamente.',
                'data' => [
                    'id' => $id,
                    'descripcion' => $descripcion
                ]
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al actualizar la zona ' 
            ]);
        }
    }

    public function updateHotel(){
        $stmt = $this->conn->prepare("UPDATE tranfer_hotel SET id_zona = ?, Comision = ?, usuario = ?, nombre_hotel = ?, direccion_hotel = ? WHERE id_hotel = ?");
        if(!$stmt){
            echo json_encode([
                'error' => true,
                'message' => 'Error al actualizar el tipo '
            ]);
        }
        $stmt->bind_param('iisssi', $_POST['id_zona'], $_POST['Comision'], $_POST['usuario'], $_POST['nombre_hotel'], $_POST['direccion_hotel'], $_POST['id_hotel']);
        if($stmt->execute()){
            echo json_encode([
                'error' => false,
                'message' => 'Tipo actualizado correctamente.',
                'data' => [
                    'id' => $_POST['id_hotel'],
                    'id_zona' => $_POST['id_zona'],
                    'Comision' => $_POST['Comision'],
                    'usuario' => $_POST['usuario'],
                    'nombre_hotel' => $_POST['nombre_hotel'],
                    'direccion_hotel' => $_POST['direccion_hotel']
                ]
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al actualizar el hotel '
            ]);
        }
    }

    

   /* public function postZona($descripcion){
        $stmt = $this->conn->prepare("INSERT INTO transfer_zona (descripcion) VALUES (?)");
        if (!$stmt) {
            echo json_encode([
                'error' => true,
                'message' => 'Error al crear la zona ' 
            ]);
        }
        $stmt->bind_param('s', $descripcion);
        if($stmt->execute()){
            echo json_encode([
                'error' => false,
                'message' => 'Zona creada correctamente.',
                'data' => [
                    'id' => $stmt->insert_id,
                    'descripcion' => $descripcion
                ]
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al crear la zona ' . $stmt->error
            ]);
        }
        $stmt->close();
    }

    public function postTipo($descripcion){
        $stmt = $this->conn->prepare("INSERT INTO transfer_tipo_reserva (Descripción) VALUES (?)");
        if (!$stmt) {
            echo json_encode([
                'error' => true,
                'message' => 'Error al crear el tipo ' . $this->conn->error
            ]);
        }
        $stmt->bind_param('s', $descripcion);
        if($stmt->execute()){
            echo json_encode([
                'error' => false,
                'message' => 'tipo creado correctamente.',
                'data' => [
                    'id' => $stmt->insert_id,
                    'descripcion' => $descripcion
                ]
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al crear la zona ' . $stmt->error
            ]);
        }
        $stmt->close();
    }

    public function postHotel(){
        $stmt = $this->conn->prepare("INSERT INTO tranfer_hotel (id_zona, Comision, usuario, nombre_hotel, direccion_hotel) VALUES ( ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo json_encode([
                'error' => true,
                'message' => 'Error al crear el tipo ' . $this->conn->error
            ]);
        }
        $stmt->bind_param('iisss', $_POST['id_zona'], $_POST['Comision'], $_POST['usuario'], $_POST['nombre_hotel'], $_POST['direccion_hotel']);
        if($stmt->execute()){
            echo json_encode([
                'error' => false,
                'message' => 'tipo creado correctamente.',
                'data' => [
                    'id' => $stmt->insert_id,
                    'id_zona' => $_POST['id_zona'],
                    'Comision' => $_POST['Comision'],
                    'usuario' => $_POST['usuario'],
                    'nombre_hotel' => $_POST['nombre_hotel'],
                    'direccion_hotel' => $_POST['direccion_hotel']
                ]
            ]);
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al crear la zona ' . $stmt->error
            ]);
        }
        $stmt->close();
    }

    public function getZonas() {
        $sql = "SELECT id_zona, descripcion FROM transfer_zona";
        $result = $this->conn->query($sql);

        $zonas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $zonas[] = $row;
            }
        }
        return $zonas;
    }

    public function getZona() {
        $sql = "SELECT descripcion FROM transfer_zona WHERE id_zona = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $_GET['id_zona']);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                echo json_encode([
                    'error' => false,
                    'message' => 'tipo creado correctamente.',
                    'data' => [
                        'id' => $row['descripcion'],
                    ]
                ]);
            }
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al obtener la zona ' . $stmt->error
            ]);
        }
        $stmt->close();
    }

    public function getZonaXHotel() {
        $sql = "SELECT id_zona FROM tranfer_hotel WHERE id_hotel = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $_GET['id_hotel']);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                echo json_encode([
                    'error' => false,
                    'message' => 'Recuperado.',
                    'data' => [
                        'id' => $row['id_zona'],
                    ]
                ]);
            }
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Error al obtener la zona ' . $stmt->error
            ]);
        }
        $stmt->close();
    }

    public function getTipos() {
        $sql = "SELECT * FROM transfer_tipo_reserva";
        $result = $this->conn->query($sql);

        $tipos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tipos[] = $row;
            }
        }
        return $tipos;
    }

    public function getHoteles(){
        $sql = "SELECT * FROM tranfer_hotel";
        $result = $this->conn->query($sql);

        $tipos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tipos[] = $row;
            }
        }
        return $tipos;
    }

    public function deleteZona($id){
        if ($id) {
            $stmt = $this->conn->prepare("DELETE FROM transfer_zona WHERE id_zona = ?");
            if (!$stmt) {
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al preparar la consulta: ' . $this->conn->error
                ]);
                exit;
            }
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode([
                        'error' => false,
                        'message' => 'Tipo eliminado correctamente.',
                        'data' => [
                            'id' => $id
                        ]
                    ]);
                } else {
                    echo json_encode([
                        'error' => true,
                        'message' => 'No se encontró el tipo con el id proporcionado.'
                    ]);
                }
            } else {
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al eliminar el tipo: ' . $stmt->error
                ]);
            }
            $stmt->close();
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Falta el parámetro "id".'
            ]);
        }
    }

    public function deleteTipo($id){
        if ($id) {
            $stmt = $this->conn->prepare("DELETE FROM transfer_tipo_reserva WHERE id_tipo_reserva = ?");
            if (!$stmt) {
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al preparar la consulta: ' . $this->conn->error
                ]);
                exit;
            }
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode([
                        'error' => false,
                        'message' => 'Tipo eliminado correctamente.',
                        'data' => [
                            'id' => $id
                        ]
                    ]);
                } else {
                    echo json_encode([
                        'error' => true,
                        'message' => 'No se encontró el tipo con el id proporcionado.'
                    ]);
                }
            } else {
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al eliminar el tipo: ' . $stmt->error
                ]);
            }
            $stmt->close();
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Falta el parámetro "id".'
            ]);
        }
    }

    public function deleteHotel() {
        if ($_GET['id_hotel']) {
            $stmt = $this->conn->prepare("DELETE FROM tranfer_hotel WHERE id_hotel = ?");
            if (!$stmt) {
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al preparar la consulta: ' . $this->conn->error
                ]);
                exit;
            }
            $stmt->bind_param('i', $_GET['id_hotel']);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode([
                        'error' => false,
                        'message' => 'Hotel eliminado correctamente.',
                        'data' => [
                            'id' => $_GET['id_hotel']
                        ]
                    ]);
                } else {
                    echo json_encode([
                        'error' => true,
                        'message' => 'No se encontró el tipo con el id proporcionado.'
                    ]);
                }
            } else {
                echo json_encode([
                    'error' => true,
                    'message' => 'Error al eliminar el tipo: ' . $stmt->error
                ]);
            }
            $stmt->close();
        } else {
            echo json_encode([
                'error' => true,
                'message' => 'Falta el parámetro "id".'
            ]);
        }
    }

    public function getActiveTransfers() {
        header('Content-Type: application/json');
        $transfers = $this->getAllTransfersActivos();
    }

    public function getAllTransfersActivos() {
        $sql = "SELECT * FROM transfer_reservas WHERE fecha_entrada >= CURDATE() OR fecha_vuelo_salida >= CURDATE() ORDER BY email_cliente;";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $transfers = [];
            
            while ($row = $result->fetch_assoc()) {
                $transfers[] = $row;
            }

            echo json_encode($transfers);
        }else{
            echo json_encode([
                'error' => true,
                'message' => 'No hay transfers activos.'
            ]);
        }

        return [];
    }

    public function handleGetRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'getZonas':
                        echo json_encode($this->getZonas()); 
                        break;
                    case 'getTransfers':
                        $this->getActiveTransfers();
                        break;
                    case 'getTipos':
                        echo json_encode($this->getTipos());
                        break;
                    case 'getHoteles':
                        echo json_encode($this->getHoteles());
                        break;
                    case 'getZona':
                        $this->getZona();
                        break;
                    case 'getZonaXHotel':
                        $this->getZonaXHotel();
                        break;
                    default:
                        echo json_encode([
                            'error' => true,
                            'message' => 'Acción no válida.'
                        ]);
                        break;
                }
            } else {
                echo json_encode([
                    'error' => true,
                    'message' => 'Falta accion.'
                ]);
            }
        } else if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'postZona':
                        if(isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
                            $this->postZona($_POST['descripcion']);
                        } else {
                            echo json_encode([
                                'error' => true,
                                'message' => 'Falta descripción.'
                            ]);
                        }
                        break;
                    case 'postTipo':
                        if(isset($_POST['Descripción']) && !empty($_POST['Descripción'])) {
                            $this->postTipo($_POST['Descripción']);
                        } else {
                            echo json_encode([
                                'error' => true,
                                'message' => 'Falta descripción.'
                            ]);
                        }
                        break;
                    case 'updateZona':
                        if(isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
                            $this->updateZona($_POST['descripcion'], $_POST['id']);
                        } else {
                            echo json_encode([
                                'error' => true,
                                'message' => 'Falta descripción.'
                            ]);
                        }
                        break;
                    case 'updateTipo':
                        if(isset($_POST['Descripción']) && !empty($_POST['Descripción'])) {
                            $this->updateTipo($_POST['Descripción'], $_POST['id']);
                        } else {
                            echo json_encode([
                                'error' => true,
                                'message' => 'Falta descripción.'
                            ]);
                        }
                        break;
                    case 'postHotel':
                        if(isset($_POST['nombre_hotel']) && !empty($_POST['nombre_hotel'])) {
                            $this->postHotel();
                        } else {
                            echo json_encode([
                                'error' => true,
                                'message' => 'Falta nombre.'
                            ]);
                        }
                        break;
                    case 'updateHotel':
                        if(isset($_POST['id_hotel']) && !empty($_POST['id_hotel'])) {
                            $this->updateHotel();
                        } else {
                            echo json_encode([
                                'error' => true,
                                'message' => 'Falta descripción.'
                            ]);
                        }
                        break;
                    default:
                        echo json_encode([
                            'error' => true,
                            'message' => 'Acción no válida.'
                        ]);
                        break;
                }
            } else {
                echo json_encode([
                    'error' => true,
                    'message' => 'Falta accion.'
                ]);
            }
        } else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
            if (isset($_GET['tipo'])) {
                switch ($_GET['tipo']) {
                    case 'zona':
                        $this->deleteZona($_GET['id']);
                        break;
                    case 'tipo':
                        $this->deleteTipo($_GET['id']);
                        break;
                    case 'hotel':
                        $this->deleteHotel();
                        break;
                    }
                }
        } else{
            echo json_encode([
                'error' => true,
                'message' => 'Método no permitido. Solo se permiten solicitudes GET.'
            ]);
        }
    }
}

$otroTransfer = new otroTransfer();

$otroTransfer->handleGetRequest();

?>
                    

}*/