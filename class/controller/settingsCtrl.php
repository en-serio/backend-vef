<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['user'];
$_SESSION['rol'];

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferZonaEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferTipoReservaEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferHotelEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/hotelesEntity.php';


class settingsCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}

    public function getZonas():void
    {
 
        $zonasEntity = new TransferZonaEntity;
        $zonas = $zonasEntity->getZonas();

        foreach($zonas as $zona)
        {
            echo '<option value="'. htmlspecialchars($zona['id_zona']) .'">'. 
            htmlspecialchars($zona['id_zona']) . ' - ' . htmlspecialchars($zona['descripcion']) .'</option>';
        }

    }

    public function getUsuarios():void
    {
        $rol = 2;
        $clienteEntity = new clienteEntity;
        $clientes = $clienteEntity->getClientesByRol($rol);

        foreach($clientes as $cliente)
        {
            echo '<option value="'. htmlspecialchars($cliente['idCliente']) .'">'. 
            htmlspecialchars($cliente['nombre']) . ' - ' . htmlspecialchars($cliente['apellido1']) .' - ' . htmlspecialchars($cliente['nombreUsuario']) .'</option>';
        }

    }


    public function drawZonas($zonas):string
    {
        $out = "";

        $out = '<table class="table table-hover">
        <thead>
            <tr>
                <th>ID Zona</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>';

        // Iterar sobre los hoteles
        foreach ($zonas as $zona) {
        $out .= '<tr>
        
                    <td>' . htmlspecialchars($zona['id_zona']) . '</td>
                    <td>' . htmlspecialchars($zona['descripcion']) . '</td>
                    <td>
                        <button class="btn btn-sm btn-danger borrarZonaBtn" data-id="'.$zona['id_zona'].'" onclick="borrarZona('.$zona['id_zona'].')">Borrar</button>
                    </td>
                </tr>';
        }

        // Cerrar la tabla
        $out .= '</tbody>
            </table>';

            return $out;
    }

    function mostrarHoteles(){

        $hotelesEntity = new HotelesEntity;
        $hoteles = $hotelesEntity->getHoteles();

        $out = '<table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Zona</th>
                            <th>Comisión</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>';
    
        foreach ($hoteles as $index => $hotel) {
            $idZona = $hotel['id_zona'];
            $zonaEntity = new TransferZonaEntity;
            $nombre = $zonaEntity->getNombreZona($idZona);


            $out .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . htmlspecialchars($hotel['nombre_hotel']) . '</td>
                        <td>' . htmlspecialchars($nombre) . '</td>
                        <td>' . htmlspecialchars($hotel['comision']) . '</td>
                        <td>' . htmlspecialchars($hotel['direccion_hotel']) . '</td>
                    </tr>';
        }
    
        // Cerrar la tabla
        $out .= '</tbody>
                </table>';
    
        echo $out;
    }
    

    public static  function procesaPost()
    { 
            
        $db = new Database();
        $db->getConnection();
        $post = self::cleanPost();


        if($post["action"]=="createZona")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;

            $descripcion = $post['descripcion'];
            
            try
            {
                $zonaEntity = new TransferZonaEntity;
                $idZona = $zonaEntity->insertTransferZona($descripcion);
                $result->zona = $zonaEntity->selectTransferZona($idZona);


            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
            
    
            echo json_encode($result);
            exit();
        }

        if($post["action"]=="updateZona")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;

            $id = $post['idZona'];
            $descripcion = $post['descripcion'];
            
            try
            {

                if($descripcion =="")
                    throw new Exception ("El nombre de la zona no puede estar vacío.");

                $zonaEntity = new TransferZonaEntity;
                $result->out =$zonaEntity->update($id, $descripcion);

                $result->error = false;



            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
            
    
            echo json_encode($result);
            exit();
        }
        

        if($post["action"]=="deleteZona")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;

            $id = $post['idZona'];
            
            try
            {
                $zonaEntity = new TransferZonaEntity;
                $uso = $zonaEntity->checkZonaUsage($id);

                if ($uso['error']) {
                   throw new exception("Esta zona tiene usos activos y no puede eliminarse.");
                } else {
                    $zonaEntity = new TransferZonaEntity;
                    $result->out = $zonaEntity->delete($id);
                }

                $result->error = false;


            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
            
    
            echo json_encode($result);
            exit();
        }

        if($post["action"]=="loadZonas")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            
            try
            {
                $zonaEntity = new TransferZonaEntity;
                $obj = $zonaEntity->getZonas();

                $settingsCtrl = new settingsCtrl;
                $result->out =$settingsCtrl->drawZonas($obj);

            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
                    
            echo json_encode($result);
            exit();
        }

        if($post["action"]=="initTipoTransfers")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            
            try
            {
                $tipoReserva = new TransferTipoReservaEntity;
                $tipoReserva->insertTransferTipoReserva();

            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
                    
            echo json_encode($result);
            exit();
        }

        if($post["action"]=="createHotel")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;

            $nombreHotel = $post['nombreHotel'];
            $zonaHotel  = $post['zonaHotelNumero'];
            $comisionHotel = $post['comisionHotel'];
            $direccionHotel = $post['direccionHotel'];
            $idCliente = $post['usuario'];


        
            try
            {
                $hotelEntity = new HotelesEntity;
                $idHotel = $hotelEntity->insertHotel($zonaHotel, $comisionHotel, $idCliente, $nombreHotel, $direccionHotel);
                $result->hotel = $hotelEntity->getHotelString($idHotel);
                $result->error = false;

            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
                    
            echo json_encode($result);
            exit();
        }

            
    }
}

if(array_key_exists('controller', $_POST) && $_POST['controller']=="settingsCtrl"){    

    settingsCtrl::procesaPost();
    
}

