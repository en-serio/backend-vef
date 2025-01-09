<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['user'];
$_SESSION['rol'];


include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/dbConnection.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/controller/controller.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/clienteEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferTipoReservaEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferVehiculoEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferPreciosEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferZonaEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/transferHotelEntity.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/class/entity/hotelesEntity.php';



class TransferCtrl extends controller
{
    private $db;
    private $userEntity;

    public function __construct(){}

    public function generarPasswordAleatorio($longitud = 8):string {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        $password = '';
        $maxIndex = strlen($caracteres) - 1;
    
        for ($i = 0; $i < $longitud; $i++) {
            $password .= $caracteres[random_int(0, $maxIndex)];
        }
    
        return $password;
    }

    public function generaLocalizadorReserva($longitud = 5):string {
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $localizador = '';
        $maxIndex = strlen($caracteres) - 1;
    
        for ($i = 0; $i < $longitud; $i++) {
            $localizador .= $caracteres[random_int(0, $maxIndex)];
        }
    
        return $localizador;
    }

    public function asignaVehiculo($idCliente):int
    {
       $descripcion = "Transfer vendido";
       $vehiculo = new TransferVehiculoEntity;
       $idVehiculo = $vehiculo->insertTransferVehiculo($descripcion, $idCliente); 
       return $idVehiculo;
    }

    function drawHotelesList(): void {
        $rol = $_SESSION['rol'];

            switch ($rol) {
                
                case 1: // Administrador
                    $hotelEntity = new HotelesEntity;
                    $hoteles = $hotelEntity->getHoteles();
                
                    echo '<option value="" disabled selected>Escoge un hotel de la lista</option>';
                
                    foreach ($hoteles as $hotel) {
                    echo '<option value="' . htmlspecialchars($hotel['nombre_hotel']) . '" data-id="' 
                        . htmlspecialchars($hotel['id_hotel']) . '" data-direccion="' 
                        . htmlspecialchars($hotel['direccion_hotel']) . '">' 
                        . htmlspecialchars($hotel['nombre_hotel']) . '</option>';
                    }
                    break;
    
                case 2:
                    $clienteEntity = new clienteEntity;
                    $cliente = $clienteEntity->getClienteByUsername($_SESSION['user']);

                    $hotelEntity = new HotelesEntity;
                    $idHotel = $hotelEntity->getIdHotelByIdCliente($cliente['idCliente']);
                    $hoteles = $hotelEntity->getHotelArray($idHotel);

                
                    echo '<option value="" disabled selected>Escoge un hotel de la lista</option>';
                
                    foreach ($hoteles as $hotel) {
                    echo '<option value="' . htmlspecialchars($hotel['nombre_hotel']) . '" data-id="' 
                        . htmlspecialchars($hotel['id_hotel']) . '" data-direccion="' 
                        . htmlspecialchars($hotel['direccion_hotel']) . '">' 
                        . htmlspecialchars($hotel['nombre_hotel']) . '</option>';
                    }
                break;

                case 3: // Cliente
                    $hotelEntity = new HotelesEntity;
                    $hoteles = $hotelEntity->getHoteles();
                
                    echo '<option value="" disabled selected>Escoge un hotel de la lista</option>';
                
                    foreach ($hoteles as $hotel) {
                    echo '<option value="' . htmlspecialchars($hotel['nombre_hotel']) . '" data-id="' 
                        . htmlspecialchars($hotel['id_hotel']) . '" data-direccion="' 
                        . htmlspecialchars($hotel['direccion_hotel']) . '">' 
                        . htmlspecialchars($hotel['nombre_hotel']) . '</option>';
                    }
                    break;
            }
        }
    
/*    function drawHotelesList():void {
        $hotelEntity = new HotelesEntity;
        $hoteles = $hotelEntity->getHoteles();

        echo '<option value="" disabled selected>Escoge un hotel de la lista</option>';
                                                    
        foreach ($hoteles as $hotel) {
            echo '<option value="' . htmlspecialchars($hotel['nombre_hotel']) . '" data-id="' 
                . htmlspecialchars($hotel['id_hotel']) . '" data-direccion="' 
                . htmlspecialchars($hotel['direccion_hotel']) . '">' 
                . htmlspecialchars($hotel['nombre_hotel']) . '</option>';
    }
    }*/

    function drawUserTransfer()
    {
        if($_SESSION['rol']==3)
        {
            $clienteEntity = new clienteEntity;
            $user = $_SESSION['user'];
            $cliente = $clienteEntity->getClienteByUsername($user);

            $out = 
                '<div class ="row">
                    <button class="btn btn-sm btn-primary loadDatosBtn mb-3" onclick="loadDatosUser()" >Cargar datos cliente</button>
                    <div class="col-6">
                        <label for="nombreCliente" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreCliente" data-value="'.$cliente['nombre'].'"readonly>
                    </div>
                    <div class="col-6">
                        <label for="apellido1" class="form-label">Apellido 1</label>
                        <input type="text" class="form-control" id="apellido1" data-value="'.$cliente['apellido1'].'"readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="apellido2" class="form-label">Apellido 2</label>
                        <input type="text" class="form-control" id="apellido2" data-value="'.htmlspecialchars($cliente['apellido2']).'" >
                    </div>
                    <div class="col-6">
                        <label for="emailCliente" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="emailCliente" data-value="'.htmlspecialchars($cliente['email']).'" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="telefonoCliente" class="form-label">Teléfono de contacto</label>
                        <input type="tel" class="form-control" id="telefonoCliente" data-value="'.htmlspecialchars($cliente['telefono']).'">
                    </div>
                    <div class="col-6">
                        <label for="dniCliente" class="form-label">DNI/Pasaporte</label>
                        <input type="text" class="form-control" id="dniCliente" data-value="'.htmlspecialchars($cliente['dni']).'">
                    </div>
                </div>';
            
                
        }else{

            $out = '
                <div class ="row">
                    <div class="col-6">
                        <label for="nombreCliente" class="form-label">Nombre </label>
                        <input type="text" class="form-control" id="nombreCliente" placeholder="Nombre">
                    </div>
                    <div class="col-6">
                        <label for="nombreCliente" class="form-label">Apellido 1</label>
                        <input type="text" class="form-control" id="apellido1" placeholder="Apellido 1">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="nombreCliente" class="form-label">Apellido 2</label>
                        <input type="text" class="form-control" id="apellido2" placeholder="Apellido 2">
                    </div>
                    <div class="col-6">
                        <label for="emailCliente" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="emailCliente" placeholder="Correo electrónico">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="telefonoCliente" class="form-label">Teléfono de contacto</label>
                        <input type="tel" class="form-control" id="telefonoCliente" placeholder="Número de teléfono">
                    </div>
                    <div class="col-6">
                        <label for="dniCliente" class="form-label">DNI/Pasaporte</label>
                        <input type="text" class="form-control" id="dniCliente" placeholder="DNI o pasaporte">
                    </div>
                </div>';
            }
        
        echo $out;
    }


    public function drawTransfers($transfers): string
    {

        $head = '<div class="row mb-3">
                    <h5>Gestión de transfers</h5>
                    <h6>Aquí podrás ver y gestionar los transfers activos</h6>                       
                </div>';

        $out = '<table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Personas</th>
                        <th>Fecha ida</th>
                        <th>Fecha vuelta</th>
                        <th>Hora ida</th>
                        <th>Hora vuelta</th>
                        <th>Localizador</th>

                        
                    </tr>
                </thead>
                <tbody>';                  
    
    
        foreach ($transfers as $index => $value) {

            $fVueloSalida = ($value['fecha_vuelo_salida']) ? DateTime::createFromFormat('Y-m-d', $value['fecha_vuelo_salida'])->format('d-m-Y'): null;
            $fVueloEntrada = ($value['fecha_entrada']) ? DateTime::createFromFormat('Y-m-d', $value['fecha_entrada'])->format('d-m-Y') : null;
            $hora_entrada = ($value['hora_entrada']) ? htmlspecialchars($value['hora_entrada']) : null;
            $hora_salida = ($value['hora_vuelo_salida']) ? htmlspecialchars($value['hora_vuelo_salida']) : null;

            switch ($_SESSION['rol']) {
                case 1:
                    $editBtn = '<button class="btn btn-sm btn-primary editTransferBtn" data-target="edit" data-id="'.$value['id_reserva'].'">Editar</button>';
                    $transferBtn = '<button class="btn btn-sm btn-danger deleteTransferBtn" data-target="delete" data-id="'.$value['id_reserva'].'">Eliminar Transfer</button>';
                    break;
                case 2:
                    $editBtn = "";
                    $transferBtn = '<button class="btn btn-sm btn-info viewTransferBtn" data-target="view" data-id="'.$value['id_reserva'].'">Ver</button>';
                    break;
                case 3:
                    $editBtn = '<button class="btn btn-sm btn-primary editTransferBtn" data-target="edit" data-id="'.$value['id_reserva'].'">Editar</button>';
                    $transferBtn = '<button class="btn btn-sm btn-warning deleteTransferBtn" data-target="delete" data-id="'.$value['id_reserva'].'">Cancelar Transfer</button>';
                    break;
            }

            $out .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . htmlspecialchars($value['email_cliente']) . '</td>
                        <td>' . htmlspecialchars($value['num_viajeros']) . '</td>
                        <td>' . $fVueloEntrada . '</td>
                        <td>' . $fVueloSalida . '</td>
                        <td>' . $hora_entrada . '</td>
                        <td>' . $hora_salida . '</td>
                        <td>' . htmlspecialchars($value['localizador']) . '</td>
                        <td>'.$editBtn.'</td>
                        <td>'.$transferBtn.'</td>
                    </tr>';
        }
    
        $out .= '</tbody>
                </table>';

            return $head.$out;
    }

    public function viewEditTransfer($transfer):string
    {
        $tipoTrayecto = '';
    
        switch ($transfer['id_tipo_reserva']) {
            case 1:
                $tipoTrayecto = 'Ida';
                break;
            case 2:
                $tipoTrayecto = 'Vuelta';
                break;
            case 3:
                $tipoTrayecto = 'Ida y Vuelta';
                break;
        }
    
        $fechaEntrada = ($transfer['fecha_entrada']) ? date('Y-m-d', strtotime($transfer['fecha_entrada'])) : null;
        $horaRecogida = ($transfer['hora_recogida']) ? date('h:i:s', strtotime($transfer['hora_recogida'])) : null;
        $fechaSalida = ($transfer['fecha_vuelo_salida']) ? date('Y-m-d', strtotime($transfer['fecha_vuelo_salida'])) : null;
        $horaSalida = ($transfer['hora_vuelo_salida']) ? date('h:i:s', strtotime($transfer['hora_vuelo_salida'])) : null;
        $horaEntrada = ($transfer['hora_entrada']) ? date('h:i:s',  strtotime($transfer['hora_entrada'])) : null;
    
        $footer = '<div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>';
    
        $datosPersonales = '<div class="row">
                                <h4>Datos personales</h4>
                                <div class="col-6">
                                    <div class="p-1"><strong>Nombre:</strong> <input type="text" class="form-control" value="'.$transfer['nombre'].'" disabled></div>
                                    <div class="p-1"><strong>Apellidos:</strong> <input type="text" class="form-control" value="'.$transfer['apellido1']." ". $transfer['apellido2'].'" disabled></div>
                                    <div class="p-1">
                                        <strong>Trayecto:</strong>
                                        <input type="text" class="form-control" value="'.$tipoTrayecto.'" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-1"><strong>Teléfono:</strong> <input type="text" class="form-control" value="'.$transfer['telefono'].'" disabled></div>
                                    <div class="p-1"><strong>Email:</strong> <input type="text" class="form-control" value="'.$transfer['email_cliente'].'" disabled></div>
                                    <div class="p-1"><strong>Localizador reserva:</strong> <input type="text" class="form-control" value="'.$transfer['localizador'].'" disabled></div>
                                </div>
                            </div>
                                <hr class="border border-light mt-3">';
    
        $ini = '<div class="row">';
        $end = '</div>';
    
        $ida = '<div class="row" id="datosIda">
                    <div class="row">
                        <h4>Datos de la ida</h4>
                        <div class="col-12 col-md-6">
                            <div class="p-1"><strong>Fecha ida:</strong> <input type="date" class="form-control" value="'.$fechaEntrada.'" disabled></div>
                            <div class="p-1"><strong>Hora transfer ida:</strong> <input type="time" class="form-control" value="'.$horaEntrada.'" disabled></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="p-1"><strong>Número de vuelo:</strong> <input type="text" class="form-control" value="'.$transfer['numero_vuelo_entrada'].'" disabled></div>
                            <div class="p-1"><strong>Aeropuerto llegada:</strong> <input type="text" class="form-control" value="'.$transfer['origen_vuelo_entrada'].'" disabled></div>
                        </div>
                    </div>
                    <hr class="border border-light mb-3">
                </div>';
    
        $vuelta = '<div class="row" id="datosVuelta">
                        <div class="row">
                            <h4>Datos de la vuelta</h4>
                            <div class="col-12 col-md-6">
                                <div class="p-1"><strong>Fecha vuelta:</strong> <input type="date" class="form-control" value="'.$fechaSalida.'" disabled></div>
                                <div class="p-1"><strong>Hora recogida:</strong> <input type="time" class="form-control" value="'.$horaRecogida.'" disabled></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="p-1"><strong>Número vuelo vuelta:</strong> <input type="text" class="form-control" value="'.$transfer['numero_vuelo_vuelta'].'" disabled></div>
                                <div class="p-1"><strong>Hora del vuelo:</strong> <input type="time" class="form-control" value="'.$horaSalida.'" disabled></div>
                            </div>
                        </div>
                    </div>';
    
        $hotel = '<hr class="border border-light mt-3">
                <div class="row">
                    <h4> Datos del hotel</h4>
                    <div class="col-12 col-md-6">
                        <div class="p-1"><strong>Hotel:</strong> <input type="text" class="form-control" value="'.$transfer['nombre_hotel'].'" disabled></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-1"><strong>Número de viajeros:</strong> <input type="number" class="form-control" value="'.$transfer['num_viajeros'].'" disabled></div>
                    </div>
                    <div class="col-12">
                        <div class="p-1 mb-5"><strong>Dirección:</strong> <input type="text" class="form-control" value="'.$transfer['direccion_hotel'].'" disabled></div>
                    </div>
                </div>';
            
        $body = "";
        $body .= $hotel;
        $out = $datosPersonales.$ini.$body.$ida.$vuelta.$end . $footer;
    
        return $out;
    }

    public function drawEditTransfer($transfer): string
    {
        $tipoTrayecto = '';

        switch ($transfer['id_tipo_reserva']) {
            case 1:
                $tipoTrayecto = 'Ida';
                break;
            case 2:
                $tipoTrayecto = 'Vuelta';
                break;
            case 3:
                $tipoTrayecto = 'Ida y Vuelta';
                break;
        }

            
            $fechaEntrada = ($transfer['fecha_entrada']) ? date('Y-m-d', strtotime($transfer['fecha_entrada'])) : null;
            $horaRecogida = ($transfer['hora_recogida']) ? date('h:i:s', strtotime( $transfer['hora_recogida'])) : null;
            $fechaSalida = ($transfer['fecha_vuelo_salida']) ? date('Y-m-d', strtotime($transfer['fecha_vuelo_salida'])) : null;
            $horaSalida = ($transfer['hora_vuelo_salida']) ? date('h:i:s', strtotime( $transfer['hora_vuelo_salida'])) : null;
            $horaEntrada = ($transfer['hora_entrada']) ? date('h:i:s',  strtotime($transfer['hora_entrada'])) : null;
            

        $footer = '<div class="modal-footer">     
                <button type="button" class="btn btn-success saveEditBtn" data-id = "'.$transfer['id_reserva'].'">Modificar Transfer</button>
            </div>';

        $datosPersonales = '<div class="row">
                                <h4>Datos personales</h4>
                                <div class="col-6">
                                    <div class="p-1"><strong>Nombre:</strong> <input type="text" class="form-control "  value="'.$transfer['nombre'].'" disabled></div>
                                    <div class="p-1"><strong>Apellios:</strong> <input type="text" class="form-control " value="'.$transfer['apellido1']." ". $transfer['apellido2'].'" disabled></div>
                                    <div class="p-1">
                                        <strong>Trayecto:</strong>
                                        <select class="form-control tipoTrayecto">
                                            <option value="ida" ' . (($transfer['id_tipo_reserva']== 1) ? 'selected="selected"' : '') . '>Ida</option>
                                            <option value="vuelta" ' . (($transfer['id_tipo_reserva']== 2) ? 'selected="selected"' : '') . '>Vuelta</option>
                                            <option value="ida_vuelta" ' . (($transfer['id_tipo_reserva']== 3) ? 'selected="selected"' : '') . '>Ida y vuelta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-1"><strong>Teléfono:</strong> <input type="text" class="form-control" value="'.$transfer['telefono'].'"></div>
                                    <div class="p-1"><strong>Email:</strong> <input type="text" class="form-control emailCliente" value="'.$transfer['email_cliente'].'" disabled></div>
                                    <div class="p-1"><strong>Localizador reserva:</strong> <input type="text" class="form-control emailCliente" value="'.$transfer['localizador'].'" disabled></div>
                                </div>
                            </div>
                             <hr class="border border-light mt-3">';



        $ini = '<div class="row">';
        $end = '</div>';

        $ida = '<div class="row" id="datosIda">
                    <div class="row">
                        <h4>Datos de la ida</h4>
                        <div class="col-12 col-md-6">
                            <div class="p-1"><strong>Fecha ida:</strong> <input type="date" class="form-control fechaEntrada" value="'.$fechaEntrada.'"></div>
                            <div class="p-1"><strong>Hora transfer ida:</strong> <input type="time" class="form-control horaIda" value="'.$horaEntrada.'"></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="p-1"><strong>Número de vuelo:</strong> <input type="text" class="form-control numVueloEntr" value="'.$transfer['numero_vuelo_entrada'].'"></div>
                            <div class="p-1"><strong>Aeropuerto llegada:</strong> <input type="text" class="form-control aeropuertoIda" value="'.$transfer['origen_vuelo_entrada'].'"></div>
                        </div>
                    </div>
                    <hr class="border border-light mb-3">
                </div>';


        $vuelta = '<div class="row" id="datosVuelta">
                        <div class="row">
                            <h4>Datos de la vuelta</h4>
                            <div class="col-12 col-md-6">
                                <div class="p-1"><strong>Fecha vuelta:</strong> <input type="date" class="form-control fechaVuelta" value="'.$fechaSalida.'"></div>
                                <div class="p-1"><strong>Hora recogida:</strong> <input type="time" class="form-control horaRecogida" value="'.$horaRecogida.'"></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="p-1"><strong>Número vuelo vuelta:</strong> <input type="text" class="form-control numVueloVuelta" value="'.$transfer['numero_vuelo_vuelta'].'"></div>
                                <div class="p-1"><strong>Hora del vuelo:</strong> <input type="time" class="form-control horaVueloVuelta" value="'.$horaSalida.'"></div>
                            </div>
                        </div>
                    </div>';

        $hotel = '<hr class="border border-light mt-3">
                <div class="row">
                    <h4> Datos del hotel</h4>
                    <div class="col-12 col-md-6">
                        <div class="p-1"><strong>Hotel:</strong> <input type="text" class="form-control nombreHotel" value="'.$transfer['nombre_hotel'].'" disabled></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-1"><strong>Número de viajeros:</strong> <input type="number" class="form-control numViajeros" value="'.$transfer['num_viajeros'].'"></div>
                    </div>
                    <div class="col-12">
                        <div class="p-1 mb-5"><strong>Dirección:</strong> <input type="text" class="form-control direccionHotel" value="'.$transfer['direccion_hotel'].'" disabled></div>
                    </div>
                </div>';
            
        $body = "";
        $body .= $hotel;
        $out = $datosPersonales.$ini.$body.$ida.$vuelta.$end . $footer;

        return $out;
    }


    public static function procesaPost()
    { 
            
        $db = new Database();
        $db->getConnection();
        $post = self::cleanPost();

        if($post['action']== "loadUserData"){
            
            $user = $_SESSION['user'];
            $clienteEntity = new clienteEntity;
            $cliente = $clienteEntity->getClienteByUsername($user);
    
            // Respuesta en formato JSON
            $clienteData = [
                'nombre' => $cliente['nombre'],
                'apellido1' => $cliente['apellido1'],
                'apellido2' => $cliente['apellido2'],
                'email' => $cliente['email'],
                'telefono' => $cliente['telefono'],
                'dni' => $cliente['dni']
            ];
    
            // Devolver los datos como JSON
            echo json_encode($clienteData);
        }



        if($post['action']== "loadCalendarTransfer")
        
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            $transferCtrl = new TransferCtrl;

            try {

                switch($_SESSION['rol']) {
                    case 1://rol administrador
                        $user =   $_SESSION['user'];

                        $transferEntity = new TransferEntity;
                        $transfers = $transferEntity->getAllTransfersActivos();
                        
                        $result->out = [];
                        foreach ($transfers as $transfer) {
                                                         
                            //obtenemos la info del hotel
                            $hotel = new TransferHotelEntity;
                            $hotelInfo = $hotel->getHotel($transfer['id_hotel']);

                            $zona = new TransferZonaEntity;
                            $zonaInfo = $zona->selectTransferZona($transfer['id_destino']);

                            switch ($transfer['id_tipo_reserva']) {
                                case 1:
                                    $tipoTrayecto = 'Ida';
                                    break;
                                case 2:
                                    $tipoTrayecto = 'Vuelta';
                                    break;
                                case 3:
                                    $tipoTrayecto = 'Ida y Vuelta';
                                    break;
                            }

                            $result->out[] = [
                                'id_reserva' => $transfer['id_reserva'],
                                'localizador' => $transfer['localizador'],
                                'nombre_hotel' => $hotelInfo['nombre_hotel'],
                                'descripcion_hotel' => $hotelInfo['direccion_hotel'], 
                                'id_tipo_reserva' => $tipoTrayecto,
                                'email_cliente' => $transfer['email_cliente'],
                                'descripcion' => $zonaInfo['descripcion'],
                                'fecha_entrada' => $transfer['fecha_entrada'],
                                'hora_entrada' => $transfer['hora_entrada'],
                                'numero_vuelo_entrada' => $transfer['numero_vuelo_entrada'],
                                'origen_vuelo_entrada' => $transfer['origen_vuelo_entrada'],
                                'hora_vuelo_salida' => $transfer['hora_vuelo_salida'],
                                'fecha_vuelo_salida' => $transfer['fecha_vuelo_salida'],
                                'num_viajeros' => $transfer['num_viajeros'],
                                'id_vehiculo' => $transfer['id_vehiculo'],
                                'numero_vuelo_vuelta' => $transfer['numero_vuelo_vuelta'],
                                'hora_recogida' => $transfer['hora_recogida']
                            ];
                         }

                        $result->error = false;
                    break;

                    case 2: // rol hotel
                        $clienteEntity = new clienteEntity;
                        $cliente = $clienteEntity->getClienteByUsername($_SESSION['user']);
                    
                        $hotelEntity = new HotelesEntity;
                        $idHotel = $hotelEntity->getIdHotelByIdCliente($cliente['idCliente']);
                        $hoteles = $hotelEntity->getHotelArray($idHotel);
                    
                        $transferEntity = new TransferEntity;
                        $transfers = $transferEntity->getAllTransfersActivos();
                    
                        $result->out = [];
                        foreach ($transfers as $transfer) {
                            $hotelFound = false;
                            foreach ($hoteles as $hotel) {
                                if ($transfer['id_hotel'] == $hotel['id_hotel']) {
                                    $hotelFound = true;
                                    break;
                                }
                            }
                    
                            if (!$hotelFound) {
                                continue;
                            }
                    
                            $hotel = new TransferHotelEntity;
                            $hotelInfo = $hotel->getHotel($transfer['id_hotel']);
                    
                            $zona = new TransferZonaEntity;
                            $zonaInfo = $zona->selectTransferZona($transfer['id_destino']);
                    
                          
                            switch ($transfer['id_tipo_reserva']) {
                                case 1:
                                    $tipoTrayecto = 'Ida';
                                    break;
                                case 2:
                                    $tipoTrayecto = 'Vuelta';
                                    break;
                                case 3:
                                    $tipoTrayecto = 'Ida y Vuelta';
                                    break;
                            }
                    
                            $result->out[] = [
                                'id_reserva' => $transfer['id_reserva'],
                                'localizador' => $transfer['localizador'],
                                'nombre_hotel' => $hotelInfo['nombre_hotel'],
                                'descripcion_hotel' => $hotelInfo['direccion_hotel'],
                                'id_tipo_reserva' => $tipoTrayecto,
                                'email_cliente' => $transfer['email_cliente'],
                                'descripcion' => $zonaInfo['descripcion'],
                                'fecha_entrada' => $transfer['fecha_entrada'],
                                'hora_entrada' => $transfer['hora_entrada'],
                                'numero_vuelo_entrada' => $transfer['numero_vuelo_entrada'],
                                'origen_vuelo_entrada' => $transfer['origen_vuelo_entrada'],
                                'hora_vuelo_salida' => $transfer['hora_vuelo_salida'],
                                'fecha_vuelo_salida' => $transfer['fecha_vuelo_salida'],
                                'num_viajeros' => $transfer['num_viajeros'],
                                'id_vehiculo' => $transfer['id_vehiculo'],
                                'numero_vuelo_vuelta' => $transfer['numero_vuelo_vuelta'],
                                'hora_recogida' => $transfer['hora_recogida']
                            ];
                        }
                        break;
                    
                    case 3: //rol cliente
                        $user =   $_SESSION['user'];

                        $clienteEntity = new clienteEntity;
                        $cliente = $clienteEntity->getClienteByUsername($user);
                        $idCliente = $cliente['idCliente'];
                        
                        $transferEntity = new TransferEntity;
                        $transfers = $transferEntity->getTransferByIdCliente($idCliente);
                        $transferCtrl = new transferCtrl;

                        $result->out = [];
                        foreach ($transfers as $transfer) {
                                                         
                            //obtenemos la info del hotel
                            $hotel = new TransferHotelEntity;
                            $hotelInfo = $hotel->getHotel($transfer['id_hotel']);

                            $zona = new TransferZonaEntity;
                            $zonaInfo = $zona->selectTransferZona($transfer['id_destino']);

                            switch ($transfer['id_tipo_reserva']) {
                                case 1:
                                    $tipoTrayecto = 'Ida';
                                    break;
                                case 2:
                                    $tipoTrayecto = 'Vuelta';
                                    break;
                                case 3:
                                    $tipoTrayecto = 'Ida y Vuelta';
                                    break;
                            }

                            $result->out[] = [
                                'id_reserva' => $transfer['id_reserva'],
                                'localizador' => $transfer['localizador'],
                                'nombre_hotel' => $hotelInfo['nombre_hotel'],
                                'descripcion_hotel' => $hotelInfo['direccion_hotel'], 
                                'id_tipo_reserva' => $tipoTrayecto,
                                'email_cliente' => $transfer['email_cliente'],
                                'descripcion' => $zonaInfo['descripcion'],
                                'fecha_entrada' => $transfer['fecha_entrada'],
                                'hora_entrada' => $transfer['hora_entrada'],
                                'numero_vuelo_entrada' => $transfer['numero_vuelo_entrada'],
                                'origen_vuelo_entrada' => $transfer['origen_vuelo_entrada'],
                                'hora_vuelo_salida' => $transfer['hora_vuelo_salida'],
                                'fecha_vuelo_salida' => $transfer['fecha_vuelo_salida'],
                                'num_viajeros' => $transfer['num_viajeros'],
                                'id_vehiculo' => $transfer['id_vehiculo'],
                                'numero_vuelo_vuelta' => $transfer['numero_vuelo_vuelta'],
                                'hora_recogida' => $transfer['hora_recogida']
                            ];
                }
                        $result->error = false;

                    break;
                }
              
            } catch (Exception $e) {
                $result->error = true;
                $result->message = $e->getMessage();
            }

            echo json_encode($result);
            exit();
        }


        if($post['action']== "loadTransfer")
        {
            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            $transferCtrl = new TransferCtrl;

            try
            {
                switch($_SESSION['rol']) {
                    case 1://rol administrador
                        $user =   $_SESSION['user'];

                        $transferEntity = new TransferEntity;
                        $transfers = $transferEntity->getAllTransfersActivos();
                        $transferCtrl = new transferCtrl;

                        $result->out = $transferCtrl->drawTransfers($transfers);

                        $result->error = false;

                    break;


                    case 2://rol hotel
                        $user =   $_SESSION['user'];

                        $clienteEntity = new clienteEntity;
                        $cliente = $clienteEntity->getClienteByUsername($user);


                        $hotelesEntity = new HotelesEntity;
                        $idHotel = $hotelesEntity->getIdHotelByIdCliente($cliente['idCliente']);

                        $transferEntity = new TransferEntity;
                        $transfers = $transferEntity->getAllTransfersActivosByIdHotel($idHotel);
                        $transferCtrl = new transferCtrl;

                        $result->out = $transferCtrl->drawTransfers($transfers);

                        $result->error = false;

                    break;
                        
                    case 3: //rol cliente

                        $user =   $_SESSION['user'];

                        $clienteEntity = new clienteEntity;
                        $cliente = $clienteEntity->getClienteByUsername($user);
                        $idCliente = $cliente['idCliente'];
                        
                        $transferEntity = new TransferEntity;
                        $transfers = $transferEntity->getTransferByIdCliente($idCliente);
                        $transferCtrl = new transferCtrl;

                        $result->out = $transferCtrl->drawTransfers($transfers);
                        $result->error = false;

                    break;
                }


            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();

            }
            echo json_encode($result);
            exit();

        }

        if($post['action']=="saveEditData")
        {   
            $result = new stdClass();
            $result->error = false;
            $result->message = null;

            $data = json_decode($_POST['transfer'], true);

            $idTransfer = $post['idTransfer'];
            $fechaSQL = date('Y-m-d H:i:s');

            try
            {
                switch ($data['tipoTrayecto']) {
                    case 'ida':
                        $idTipoReserva = 1; 

                        $fechaEntrada = $data['fechaEntrada'];
                        $horaLlegada = $data['horaIda'];
                        $numVueloIda = $data['numVueloEntr'];
                        $aeropuertoIda = $data['aeropuertoIda'];
                        $numViajeros = $data['numViajeros'];
                        $fechaVuelta = null;
                        $horaVueloVuelta = null;
                        $horaRecogida = null;
                        $numVueloVuelta = null;
                        //$aeropuertoVuelta = $data['aeropuertoVuelta'];

                        $numViajeros = $data['numViajeros'];


                        $fechaActual = date('Y-m-d');
                        $horaActual = date('H:i:s');

                        $fechaLimite = date('Y-m-d', strtotime('+48 hours', strtotime($fechaActual)));

                        if ($fechaEntrada < $fechaLimite || ($fechaEntrada == $fechaLimite && $horaLlegada <= $horaActual)) {
                            throw new Exception("Deben haber al menos 48h de antelación a la fecha del vuelo.");
                        }
                        
                        $data = [
                            'id_tipo_reserva' => $idTipoReserva,
                            'fecha_entrada' => $fechaEntrada,
                            'hora_entrada' => $horaLlegada,
                            'numero_vuelo_entrada' => $numVueloIda,
                            'origen_vuelo_entrada' => $aeropuertoIda,
                            'hora_vuelo_salida' => $horaVueloVuelta,
                            'fecha_vuelo_salida' => $fechaVuelta,
                            'num_viajeros' => $numViajeros,
                            'numero_vuelo_vuelta' => $numVueloVuelta,
                            'hora_recogida' => $horaRecogida,
                            'fecha_modificacion' => $fechaSQL];

                        $transferEntity = new TransferEntity;
                        $transferEntity->update($idTransfer, $data);

                        break;

                    case 'vuelta':
                        $idTipoReserva = 2; 

                        $fechaEntrada = null;
                        $horaLlegada = null;
                        $numVueloIda = null;
                        $aeropuertoIda = null;
                        $numViajeros = $data['numViajeros'];
                        $fechaVuelta = $data['fechaVuelta'];
                        $horaVueloVuelta = $data['horaVueloVuelta'];
                        $horaRecogida = $data['horaRecogida'];
                        $numVueloVuelta = $data['numVueloVuelta'];
                        //$aeropuertoVuelta = $data['aeropuertoVuelta'];

                        $numViajeros = $data['numViajeros'];
                        
                        $fechaActual = date('Y-m-d');
                        $horaActual = date('H:i:s');

                        $fechaLimite = date('Y-m-d', strtotime('+48 hours', strtotime($fechaActual)));

                        if ($fechaVuelta < $fechaLimite || ($fechaVuelta == $fechaLimite && $horaVueloVuelta <= $horaActual)) {
                            throw new Exception("Deben haber al menos 48h de antelación a la fecha del vuelo.");
                        }

                        $horaVueloVueltaTimestamp = strtotime($fechaVuelta . ' ' . $horaVueloVuelta);
                        $horaRecogidaTimestamp = strtotime($horaRecogida);

                        if ($horaVueloVueltaTimestamp <= $horaRecogidaTimestamp) {
                            $horaVueloVueltaTimestamp += 86400; // Sumamos 24 horas
                        }

                        if (($horaVueloVueltaTimestamp - $horaRecogidaTimestamp) < 3 * 60 * 60) {
                            throw new Exception("La hora del vuelo de vuelta no puede ser menor que la hora de recogida, debe haber al menos 3 horas de antelación.");
                        }


                        $data = [
                            'id_tipo_reserva' => $idTipoReserva,
                            'fecha_entrada' => $fechaEntrada,
                            'hora_entrada' => $horaLlegada,
                            'numero_vuelo_entrada' => $numVueloIda,
                            //'origen_vuelo_entrada' => $aeropuertoVuelta,
                            'hora_vuelo_salida' => $horaVueloVuelta,
                            'fecha_vuelo_salida' => $fechaVuelta,
                            'num_viajeros' => $numViajeros,
                            'numero_vuelo_vuelta' => $numVueloVuelta,
                            'hora_recogida' => $horaRecogida,
                            'fecha_modificacion' => $fechaSQL
                        ];

                        $transferEntity = new TransferEntity;
                        $transferEntity->update($idTransfer, $data);

                    break;

                    case 'ida_vuelta':
                        $idTipoReserva = 3;
                        
                        $fechaEntrada = $data['fechaEntrada'];
                        $horaLlegada = $data['horaIda'];
                        $numVueloIda = $data['numVueloEntr'];
                        $aeropuertoIda = $data['aeropuertoIda'];
                        $numViajeros = $data['numViajeros'];
                        $fechaVuelta = $data['fechaVuelta'];
                        $horaVueloVuelta = $data['horaVueloVuelta'];
                        $horaRecogida = $data['horaRecogida'];
                        $numVueloVuelta = $data['numVueloVuelta'];
                        //$aeropuertoVuelta = $data['aeropuertoVuelta'];

                        $numViajeros = $data['numViajeros'];

                        $fechaActual = date('Y-m-d');
                        $horaActual = date('H:i:s');

                        $fechaLimite = date('Y-m-d', strtotime('+48 hours', strtotime($fechaActual)));

                        if ($fechaVuelta < $fechaLimite || ($fechaVuelta == $fechaLimite && $horaVueloVuelta <= $horaActual)) {
                            throw new Exception("Deben haber al menos 48h de antelación a la fecha del vuelo.");
                        }

                        $horaVueloVueltaTimestamp = strtotime($fechaVuelta . ' ' . $horaVueloVuelta);
                        $horaRecogidaTimestamp = strtotime($horaRecogida);

                        if ($horaVueloVueltaTimestamp <= $horaRecogidaTimestamp) {
                            $horaVueloVueltaTimestamp += 86400; // Sumamos 24 horas
                        }

                        if (($horaVueloVueltaTimestamp - $horaRecogidaTimestamp) < 3 * 60 * 60) {
                            throw new Exception("La hora del vuelo de vuelta no puede ser menor que la hora de recogida, debe haber al menos 3 horas de antelación.");
                        }

                        $data = [
                            'id_tipo_reserva' => $idTipoReserva,
            
                            'fecha_entrada' => $fechaEntrada,
                            'hora_entrada' => $horaLlegada,
                            'numero_vuelo_entrada' => $numVueloIda,
                            'origen_vuelo_entrada' => $aeropuertoIda,
                            'hora_vuelo_salida' => $horaVueloVuelta,
                            'fecha_vuelo_salida' => $fechaVuelta,
                            'num_viajeros' => $numViajeros,
                            'numero_vuelo_vuelta' => $numVueloVuelta,
                            'hora_recogida' => $horaRecogida,
                            'fecha_modificacion' => $fechaSQL];

                        $transferEntity = new TransferEntity;
                        $transferEntity->update($idTransfer, $data);

                    break;
                }

            $result->message = ("Transfer modificado correctamente");


            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }

            echo json_encode($result);
            exit();
        }


        if($post['action']=="deleteTransfer")
        {

            $result = new stdClass();
            $result->error = false;
            $result->message = null;
            $result->out = null;

            $idTransfer = $post['idTransfer'];

            $diasRestantes = date('Y-m-d');
            $horasRestantes = date('H:i:s');

            $fechaHoraActual = strtotime("$diasRestantes $horasRestantes");
            

            try
            {

                switch($_SESSION['rol'])
                {
                    case 1:
                        if(!$idTransfer or $idTransfer ==null)
                            throw new Exception ("No ha sido posible encontrar la reserva asociada.");

                        $transferEntity = new TransferEntity;
                        $transferEntity->delete($idTransfer);

                        $result->message =("Transfer eliminado correctamente. Se ha enviado un email al usuario.");

                    break;

                    case 2:
                        if(!$idTransfer or $idTransfer ==null)
                            throw new Exception ("No ha sido posible encontrar la reserva asociada.");    

                        $transferEntity = new TransferEntity;
                        $transferEntity->delete($idTransfer);

                        $result->message =("Transfer eliminado correctamente. Se ha enviado un email al usuario.");
                    break;

                    case 3:
                        if(!$idTransfer or $idTransfer ==null)
                            throw new Exception ("No ha sido posible encontrar la reserva asociada.");

                        //comprobamos que faltan más de 48h para la hora del transfer
                        $transferEntity = new TransferEntity;
                        $transfer = $transferEntity->getTransferEdit($idTransfer);

                        $fechaHoraEntrada = strtotime($transfer['fecha_entrada'] . ' ' . $transfer['hora_entrada']);
                        $fechaHoraSalida = strtotime($transfer['fecha_vuelo_salida'] . ' ' . $transfer['hora_recogida']);

                        $horas48EnSegundos = 48 * 60 * 60;              

                        if (
                            ($transfer['id_tipo_reserva'] === 1 && $fechaHoraEntrada - $fechaHoraActual <= $horas48EnSegundos) ||
                            ($transfer['id_tipo_reserva'] === 2 && $fechaHoraSalida - $fechaHoraActual <= $horas48EnSegundos) ||
                            ($transfer['id_tipo_reserva'] === 3 && 
                             (($fechaHoraEntrada - $fechaHoraActual <= $horas48EnSegundos) || 
                              ($fechaHoraSalida - $fechaHoraActual <= $horas48EnSegundos)))
                        ) {
                            throw new Exception("No es posible cancelar este transfer. Está fuera de plazo.");
                        }
                        
                        $transferEntity->delete($idTransfer);

                        $result->message =("Has eliminado correctamente el transfer. Recibirás email de confirmación.");

                    break;
                }

            }catch(Exception $e)
            {
                $result->error = true;
                $result->message = $e->getMessage();
            }

            echo json_encode($result);
            exit();
                
            }

            if($post['action']=="editTransfer")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;
                $result->out = null;

                $idTransfer = $post['idTransfer'];
                try
                {

                    if(!$idTransfer or $idTransfer ==null)
                        throw new Exception ("No ha sido posible encontrar la reserva asociada");
    
                    $transferEntity = new TransferEntity;
                    $transfer = $transferEntity->getTransferEdit($idTransfer);

                    $transferCtrl = new TransferCtrl;
                    $result->out = $transferCtrl->drawEditTransfer($transfer);

                        

                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }

                
                
                echo json_encode($result);
                exit();
            }

            if($post['action']=="viewTransfer")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;
                $result->out = null;

                $idTransfer = $post['idTransfer'];
                try
                {

                    if(!$idTransfer or $idTransfer ==null)
                        throw new Exception ("No ha sido posible encontrar la reserva asociada");
    
                    $transferEntity = new TransferEntity;
                    $transfer = $transferEntity->getTransferEdit($idTransfer);

                    $transferCtrl = new TransferCtrl;
                    $result->out = $transferCtrl->viewEditTransfer($transfer);

                        

                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();
                }

                
                
                echo json_encode($result);
                exit();
            }

            if($post["action"]=="createTransfer")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;
                $result->localizador = "";
                $transferCtrl = new TransferCtrl;

                $data = json_decode($_POST['transfer'], true);

                $trayecto = $data['trayecto'];
                $fechaIda = $data['fechaIda'];
                $horaIda = $data['horaIda'];
                $aeropuertoOrigen = $data['aeropuertoOrigen'];
                $numeroVueloIda = $data['numeroVueloIda'];
                $numeroViajeros = $data['numeroViajeros'];
                $nombreCliente = $data['nombreCliente'];
                $emailCliente = $data['emailCliente'];
                $apellido1 = $data['apellido1'];
                $apellido2 = $data['apellido2'];
                $telefonoCliente = $data['telefonoCliente'];
                $dniCliente = $data['dniCliente'];
                $fechaVuelta = $data['fechaVuelta'];
                $horaVueloVuelta = $data['horaVueloVuelta'];
                $horaRecogida = $data['horaRecogida'];
                $numeroVueloVuelta = $data['numeroVueloVuelta'];
                $direccionHotel = $data['direccionVuelta'];
                $nombreHotel = $data['hotelIda'];
                $idHotel = $data['idHotel'];

                

                $tipoTrayecto = [
                    'ida' => 1,
                    'vuelta' => 2,
                    'idaVuelta' => 3
                ];
                $tipoReserva = $tipoTrayecto[$trayecto];
                $fecha = date("Y-m-d H:i:s");
                $fechaSQL = date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));

                $horaRecogidaFormat = $fechaSQL . ' ' . $horaRecogida;
                $horaVueloVueltaFormat = $fechaSQL . ' ' . $horaVueloVuelta;
                $horaIdaFormat = $fechaSQL . ' ' . $horaIda;
               // $horaVueltaFormat = $fechaSQL . ' ' . $horaV;

               $precioIda = 100.00;
               $precioVuelta = 100.00;

                $localizador = $transferCtrl->generaLocalizadorReserva();
                
                try
                {
                    $cliente = new clienteEntity();

                    if(!$row = $cliente->getClienteByEmail($emailCliente))
                    {
                        $user = $emailCliente;
                        $rol = "cliente";
                        
                        $transferCtrl = new TransferCtrl;
                        $pass = $transferCtrl->generarPasswordAleatorio();
                        $idCliente = $cliente->insertUser($user, $nombreCliente, $apellido1, $apellido2, $rol, $emailCliente, $telefonoCliente, $fechaSQL, $pass, $dniCliente);
                       
                        $hotelesEntity = new HotelesEntity;
                        $hotel = $hotelesEntity->getHotelString($idHotel);
                        
                        //aquí como sólo queremos una zona y no tenemos la lógica para implementarlo, asiganmos una zona y un precio estandar para insertar el hotel
                        $idZona =$hotel['id_zona'];
                        $comision = $hotel['comision'];;
                        $transferHotelEntity = new TransferHotelEntity;
                        $transferHotelEntity->insertHotel($idHotel, $idZona, $comision, $idCliente, $user, $direccionHotel, $nombreHotel);
                        
                        $idVehiculo = $transferCtrl->asignaVehiculo($idCliente);

                        if($tipoReserva=== 1)
                        {
                            $fechaVuelta=null;
                            $horaRecogidaFormat=null;
                            $numeroVueloVuelta=null;
                            $horaVueloVueltaFormat=null;

                            $transferPrecio = new TransferPreciosEntity;
                            //Precio fijo para un transfer
                            $precioTotal = $precioIda;
                            $transferPrecio->insertPrecio($idHotel, $idVehiculo, $precioTotal);

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }else if ($tipoReserva=== 2){

                            $fechaIda=null;
                            $horaIdaFormat=null;
                            $numeroVueloIda=null;
                            //$horaVueloVueltaFormat=null;


                            $transferPrecio = new TransferPreciosEntity;
                            //Precio fijo para un transfer
                            $precioTotal = $precioVuelta;
                            $transferPrecio->insertPrecio($idHotel, $idVehiculo, $precioTotal);

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }else{

                            $transferPrecio = new TransferPreciosEntity;
                            //Precio fijo para un transfer
                            $precioTotal = $precioIda + $precioVuelta;
                            $transferPrecio->insertPrecio($idHotel, $idVehiculo, $precioTotal);

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }

                    }else
                    {
                        $idCliente = $row['idCliente'];

                        $user = $cliente->getNombreUsuario();
                        $cliente->setIdCliente($idCliente);
                        $cliente->setNombre($nombreCliente);
                        $cliente->setApellido1($apellido1);
                        $cliente->setApellido2($apellido2);
                        $cliente->setDNI($dniCliente);
                        $cliente->setTelefono($telefonoCliente);
                        $cliente->updateCliente();

                        $hotelesEntity = new HotelesEntity;
                        $hotel = $hotelesEntity->getHotelString($idHotel);
                        
                        //aquí como sólo queremos una zona y no tenemos la lógica para implementarlo, asiganmos una zona y un precio estandar para insertar el hotel
                        $idZona =$hotel['id_zona'];
                        $comision = $hotel['comision'];
                        $transferHotelEntity = new TransferHotelEntity;
                        $transferHotelEntity->insertHotel($idHotel, $idZona, $comision, $idCliente, $user, $direccionHotel, $nombreHotel);

                        $idVehiculo = $transferCtrl->asignaVehiculo($idCliente);

                        if($tipoReserva=== 1)
                        {
                            $fechaVuelta=null;
                            $horaRecogidaFormat=null;
                            $numeroVueloVuelta=null;
                            $horaVueloVueltaFormat=null;

                            $transferPrecio = new TransferPreciosEntity;
                            //Precio fijo para un transfer
                            $precioTotal = $precioIda;
                            $transferPrecio->insertPrecio($idHotel, $idVehiculo, $precioTotal);

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);


                        }else if ($tipoReserva=== 2){

                            $fechaIda=null;
                            $horaIdaFormat=null;
                            $numeroVueloIda=null;
                            //$horaVueloVueltaFormat=null;

                            $transferPrecio = new TransferPreciosEntity;
                            //Precio fijo para un transfer
                            $precioTotal = $precioVuelta;
                            $transferPrecio->insertPrecio($idHotel, $idVehiculo, $precioTotal);

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }else{

                            $transferPrecio = new TransferPreciosEntity;
                            //Precio fijo para un transfer
                            $precioTotal = $precioIda + $precioVuelta;
                            $transferPrecio->insertPrecio($idHotel, $idVehiculo, $precioTotal);

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }

                    }
                    $result->error = false;
                    $result->localizador = $localizador;
                    $result->precio = $precioTotal;
                    $result->message = ("Se han enviado los detalles del transfer al email.");

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

if(array_key_exists('controller', $_POST) && $_POST['controller']=="transferCtrl"){    

    TransferCtrl::procesaPost();
    
}
