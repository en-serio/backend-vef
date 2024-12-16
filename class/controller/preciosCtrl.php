<?php

session_start(); 
$user = $_SESSION['user'];
$rol = $_SESSION['rol']; 

include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferZonaEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/hotelesEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/transferCtrl.php';



class preciosCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}


    public function drawPreciosByCliente($obj)
    {
        $out = '<table class="table table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Precio</th>
                        <th>Id Hotel</th>
                        <th>Id Vehículo</th>
                        <th>nombre</th>                        
                    </tr>
                </thead>
                <tbody>';                  
    
    
        foreach ($obj as $value) {

            $out .= '<tr>
                        <td>' . htmlspecialchars($value['email']) . '</td>
                        <td>' . htmlspecialchars($value['precio']) . '</td>
                        <td>' . htmlspecialchars($value['id_hotel']) . '</td>
                        <td>' . htmlspecialchars($value['id_vehiculo']) . '</td>
                        <td>' . htmlspecialchars($value['nombre']) . '</td>';
        }
    
        $out .= '</tbody>
                </table>';

            return $out;
    }

    public function drawFilters(string $rol, int $idCliente): string
{

    $out = '<div class="row g-3 align-items-center">';


    $out .= '<div class="col-md-4">
                <label for="fechaRango" class="form-label">Seleccionar fechas:</label>
                <input type="text" id="fechaRango" name="fechaRango" class="form-control" placeholder="Selecciona el rango de fechas" />
             </div>';


    if ($rol === "1") {
        $hotelEntity = new HotelesEntity();
        $hoteles = $hotelEntity->getHoteles();

        $out .= '<div class="col-md-4">
                    <label for="hotelFilter" class="form-label">Seleccione un hotel:</label>
                    <select id="hotelFilter" name="idHotel" class="form-select">
                    <option value="" disabled selected>Seleccione un hotel de la lista</option>';
        

        foreach ($hoteles as $hotel) {
            $selected = (isset($_POST['idHotel']) && $_POST['idHotel'] == $hotel['id_hotel']) ? 'selected' : '';
            $out .= '<option data-id="' . htmlspecialchars($hotel['id_hotel']) . '" ' . $selected . '>' . htmlspecialchars($hotel['nombre_hotel']) . '</option>';
        }

        $out .= '</select>
                </div>';
    }else
    {
        $hotelesEntity = new HotelesEntity();
        $idHotel = $hotelesEntity->getIdHotelByIdCliente($idCliente);
        $hoteles = $hotelesEntity->getHotelArray($idHotel);

        $out .= '<div class="col-md-4">
                    <label for="hotelFilter" class="form-label">Seleccione un hotel:</label>
                    <select id="hotelFilter" name="idHotel" class="form-select">
                    <option value="" disabled selected>Seleccione un hotel de la lista</option>';

        foreach ($hoteles as $hotel) {
            $selected = (isset($_POST['idHotel']) && $_POST['idHotel'] == $hotel['id_hotel']) ? 'selected' : '';
            $out .= '<option data-id="' . htmlspecialchars($hotel['id_hotel']) . '" ' . $selected . '>' . htmlspecialchars($hotel['nombre_hotel']) . '</option>';
        }

        $out .= '</select>
                </div>';
    }


    $out .= '<div class="col-md-3 mt-5">
                <button class="btn btn-primary filtrarBtn">Filtrar</button>
             </div>
        </div>
        <div class="row row mb-5 pb-4" id="dynamicFilter">
                      <!-- Aquí se cargará el contenido dinámico de los filtros -->
                      </div>';

    return $out;
}


    public function drawTransfersFiltrados(array $transfers, string $user, string $rol,): string
    {

        $out = '<div class= "row mt-4">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Localizador</th>
                                <th>Hotel</th>
                                <th>Comisión</th>
                                <th>Fecha entrada</th>
                                <th>Fecha salida</th>
                            </tr>
                        </thead>
                        <tbody>';
    
        $totalComisiones = 0;
        if (!empty($transfers)) {
            foreach ($transfers as $transfer) {

                $hotelEntity = new HotelesEntity;
                $hotel = $hotelEntity->getHotelString($transfer['id_hotel']);
                $comision = $hotel['comision'];
                if (!empty($transfer['fecha_entrada']) && !empty($transfer['fecha_vuelo_salida'])) {
                    $comision *= 2;
                }
                $totalComisiones += (float)$comision;

    
                $out .= '<tr>
                            <td>' . htmlspecialchars($transfer['localizador']) . '</td>
                            <td>' . htmlspecialchars($hotel['nombre_hotel']) . '</td>
                            <td>' . number_format($comision, 2) . ' €</td>
                            <td>' . (!empty($transfer['fecha_entrada']) ? htmlspecialchars($transfer['fecha_entrada']) : '-') . '</td>
                            <td>' . (!empty($transfer['fecha_vuelo_salida']) ? htmlspecialchars($transfer['fecha_vuelo_salida']) : '-') . '</td>
                        </tr>';
            }
        } else {
            $out .= '<tr><td colspan="6" class="text-center">No se encontraron resultados</td></tr>';
        }
    
        // Sumatorio de comisiones
        $out .= '</tbody>
                 <tfoot>
                     <tr>
                         <th colspan="2">Total de Comisiones</th>
                         <th colspan="2">' . number_format($totalComisiones, 2) . ' €</th>
                         <th colspan="2"></th>
                     </tr>
                 </tfoot>
                </table>
                </div>';
    
        return $out;
    }
    


    public static  function procesaPost()
    { 
            
        $db = new Database();
        $db->getConnection();
        $post = self::cleanPost();

        if($post["action"]=="loadPrecios")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            
            $transfer = [];
            try
            {
                $user = $_SESSION['user'];
                $rol = $_SESSION['rol'];

                $clienteEntity = new clienteEntity;
                $cliente = $clienteEntity->getClienteByUsername($user);

                $idCliente = $cliente['idCliente'];

                $hotelEntity = new HotelesEntity;
                $idHotel = $hotelEntity->getIdHotelByIdCliente($idCliente);
              
                $transferEntity = new TransferEntity;
                $transfer = $transferEntity->getTransfersByHotelArray($idHotel);

                $preciosCtrl = new preciosCtrl;
                $result->out = $preciosCtrl->drawFilters($rol, $idCliente);

            

            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }
            
            
            echo json_encode($result);
            exit();
        }

        if($post["action"]=="filterHotel")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            
            $idHotel = $post['idHotel'];
            $fecha = $post['fecha']; 
            $fechas = explode(' - ', $fecha);

            
            $fechaInicio = $fechas[0]; 
            $fechaFin = $fechas[1];

            try
            {
                $user = $_SESSION['user'];
                $rol = $_SESSION['rol'];

                $transferEntity = new TransferEntity;
                $transfer = $transferEntity->getTransfersByHotelFecha($idHotel,  $fechaInicio, $fechaFin);

                $preciosCtrl = new preciosCtrl;
                $result->out = $preciosCtrl->drawTransfersFiltrados($transfer, $rol, $user);
              
            

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

if(array_key_exists('controller', $_POST) && $_POST['controller']=="preciosCtrl"){    

    preciosCtrl::procesaPost();
    
}

