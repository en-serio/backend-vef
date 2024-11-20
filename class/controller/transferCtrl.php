<?php

session_start();

$_SESSION['user'];
$_SESSION['rol'];

require_once '../entity/dbConnection.php';
require_once '../controller/controller.php';
require_once '../entity/clienteEntity.php';
require_once '../entity/transferEntity.php';
require_once '../entity/transferTipoReservaEntity.php';
require_once '../entity/transferPreciosEntity.php';
require_once '../entity/transferVehiculoEntity.php';
require_once '../entity/transferZonaEntity.php';
require_once '../entity/transferHotelEntity.php';



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


    public function drawTransfers($transfers): string
    {

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
                        <th>Localizador reserva</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
    
    
        foreach ($transfers as $index => $value) {

            $fVueloSalida = ($value['fecha_vuelo_salida']) ? DateTime::createFromFormat('Y-m-d', $value['fecha_vuelo_salida'])->format('d-m-Y'): null;
            $fVueloEntrada = ($value['fecha_entrada']) ? DateTime::createFromFormat('Y-m-d', $value['fecha_entrada'])->format('d-m-Y') : null;
            $hora_entrada = ($value['hora_entrada']) ? htmlspecialchars($value['hora_entrada']) : null;
            $hora_salida = ($value['hora_vuelo_salida']) ? htmlspecialchars($value['hora_vuelo_salida']) : null;

            $out .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . htmlspecialchars($value['email_cliente']) . '</td>
                        <td>' . htmlspecialchars($value['num_viajeros']) . '</td>
                        <td>' . $fVueloEntrada . '</td>
                        <td>' . $fVueloSalida . '</td>
                        <td>' . $hora_entrada . '</td>
                        <td>' . $hora_salida . '</td>
                        <td>' . htmlspecialchars($value['localizador']) . '</td>
                        <td><button class="btn btn-sm btn-primary editTransferBtn" data-id="'.$value['id_reserva'].'">Editar</button></td>
                    </tr>';
        }
    
        $out .= '</tbody>
                </table>';

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
            $horaSalida = ($transfer['hora_recogida']) ? date('h:i:s', strtotime( $transfer['hora_recogida'])) : null;
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

        $ida = '<h4>Datos de la ida</h4>
                <div class="col-12 col-md-6">
                    <div class="p-1"><strong>Fecha ida:</strong> <input type="date" class="form-control fechaEntrada" value="'.$fechaEntrada.'"></div>
                    <div class="p-1"><strong>Hora transfer ida:</strong> <input type="time" class="form-control horaIda"value="'.$horaEntrada.'"></div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="p-1"><strong>Número de vuelo:</strong> <input type="text" class="form-control numVueloEntr" value="'.$transfer['numero_vuelo_entrada'].'"></div>
                    <div class="p-1"><strong>Aeropuerto llegada:</strong> <input type="text" class="form-control aeropuertoIda" value="'.$transfer['origen_vuelo_entrada'].'"></div>
                </div>
                <hr class="border border-light mb-3">';

        $vuelta = '<h4>Datos de la vuelta</h4>
                <div class="col-12 col-md-6">
                    <div class="p-1"><strong>Fecha vuelta:</strong> <input type="date" class="form-control fechaVuelta" value="'.$fechaSalida.'"></div>
                    <div class="p-1"><strong>Hora recogida:</strong> <input type="time" class="form-control horaRecogida" value="'.$horaRecogida.'"></div>
                    <div class="p-1"><strong>Hora del vuelo:</strong> <input type="time" class="form-control horaVueloVuelta" value="'.$horaSalida.'"></div>
                </div>
                <div class="col-12 col-md-6">
                    
                    <div class="p-1"><strong>Número vuelo vuelta:</strong> <input type="text" class="form-control numVueloVuelta" value="'.$transfer['numero_vuelo_vuelta'].'"></div>
                    <div class="p-1"><strong>Aeropuerto salida:</strong> <input type="text" class="form-control aeropuertoVuelta" value="'.$transfer['origen_vuelo_entrada'].'"></div>
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


        switch ($transfer['id_tipo_reserva']) {
            case 1:
                $body .= $ida;
                break;
            case 2:
                $body .= $vuelta;
                break;
            case 3:
                $body .= $ida.$vuelta;
                break;
        }


        $body .= $hotel;

        $out = $datosPersonales.$ini.$body.$end . $footer;

        return $out;
    }


    public static function procesaPost()
    { 
            
            $db = new Database();
            $db->getConnection();
            $post = self::cleanPost();


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
 
                             $out = $transferCtrl->drawTransfers($transfers);
 
                             $result->error = false;

                             break;


                        case 2://rol hotel

                            break;
                            
                        case 3: //rol cliente


                            $user =   $_SESSION['user'];

                            $clienteEntity = new clienteEntity;
                            $cliente = $clienteEntity->getClienteByUsername($user);
                            $idCliente = $cliente['idCliente'];
                           
                            $transferEntity = new TransferEntity;
                            $transfers = $transferEntity->getTransferByIdCliente($idCliente);
                            $transferCtrl = new transferCtrl;

                            $out = $transferCtrl->drawTransfers($transfers);
                            $result->error = false;

                            break;
                    }


                }catch(Exception $e)
                {
                    $result->error = true;
                    $result->message = $e->getMessage();

                }
                echo json_encode($out);
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
                            $aeropuertoVuelta = $data['aeropuertoVuelta'];

                            $numViajeros = $data['numViajeros'];
                            
                            $data = [
                                'id_tipo_reserva' => $idTipoReserva,
                
                                'fecha_entrada' => $fechaEntrada,
                                'hora_entrada' => $horaLlegada,
                                'numero_vuelo_entrada' => $numVueloIda,
                                'origen_vuelo_entrada' => $aeropuertoVuelta,
                                'hora_vuelo_salida' => $horaVueloVuelta,
                                'fecha_vuelo_salida' => $fechaVuelta,
                                'num_viajeros' => $numViajeros,
                                'numero_vuelo_vuelta' => $numVueloVuelta,
                                'hora_recogida' => $horaRecogida,
                                'fecha_modificacion' => $fechaSQL];

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
                            $aeropuertoVuelta = $data['aeropuertoVuelta'];

                            $numViajeros = $data['numViajeros'];
                            
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


            if($post['action']=="editTransfer")
            {
                $result = new stdClass();
                $result->error = false;
                $result->message = null;
                $result->out = null;

                $idTransfer = $post['idTransfer'];
                try
                {
                  //  $idTransfer = 9;

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
                $hotel = $data['hotelIda'];

                

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
                       
                        //falta hacer coger el idHotel o crearlo si no existe, luego el id destino el id vehículo también
                        $transferHotelEntity = new TransferHotelEntity;
                        $idZona = 1;
                        $comision = 10;
                        $idHotel = $transferHotelEntity->insertHotel($idZona, $comision, $idCliente, $user, $direccionHotel, $hotel);
                        $idVehiculo = $transferCtrl->asignaVehiculo($idCliente);

                        if($tipoReserva=== 1)
                        {
                            $fechaVuelta="-";
                            $horaRecogidaFormat="-";
                            $numeroVueloVuelta="-";
                            $horaVueloVueltaFormat="-";

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }else if ($tipoReserva=== 2){

                            $fechaIda="-";
                            $horaIdaFormat="-";
                            $numeroVueloIda="-";
                            //$horaVueloVueltaFormat="-";

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);
                        }else{

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }

                    }else
                    {
                        $idCliente = $row['idCliente'];

                        $transferHotelEntity = new TransferHotelEntity;
                        $idZona = 1;
                        $comision = 10;
                        $user = $cliente->getNombreUsuario();
                        $idHotel = $transferHotelEntity->insertHotel($idZona, $comision, $idCliente, $user, $hotel, $direccionHotel);
                        $idVehiculo = $transferCtrl->asignaVehiculo($idCliente);

                        if($tipoReserva=== 1)
                        {
                            $fechaVuelta=null;
                            $horaRecogidaFormat=null;
                            $numeroVueloVuelta=null;
                            $horaVueloVueltaFormat=null;

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }else if ($tipoReserva=== 2){

                            $fechaIda=null;
                            $horaIdaFormat=null;
                            $numeroVueloIda=null;
                            //$horaVueloVueltaFormat=null;

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);
                        }else{

                            $transfer = new TransferEntity;
                            $transfer->insertTransfer($idCliente, $emailCliente, $tipoReserva, $localizador, $fechaSQL, $fechaIda, $horaIdaFormat, $numeroVueloIda, $aeropuertoOrigen, $fechaVuelta, $horaVueloVueltaFormat, 
                            $horaRecogidaFormat, $numeroViajeros, $idVehiculo, $numeroVueloVuelta, $idHotel,  $idZona);

                        }


                    }
                    $result->error = false;
                    $result->localizador = $localizador;
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
