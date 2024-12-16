<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cliente;
use App\Models\Transfer;
use App\Models\TransferVehiculo;
use App\Models\TransferPrecios;
use App\Models\TransferHotel;
use App\Models\TransferZona;
use App\Models\Hoteles;

class TransferCtrl extends Controller
{
    // Procesar las peticiones AJAX
    public function procesaPost(Request $request)
    {
        $action = $request->input('action');
        $response = new \stdClass();
        $response->error = false;
        $response->message = '';
        $response->out = null;

        try {
            switch ($action) {
                case 'loadUserData':
                    $response->out = $this->loadUserData();
                    break;
                case 'loadTransfer':
                    $response->out = $this->loadTransfer();
                    break;
                case 'editTransfer':
                    $response->out = $this->drawEditTransfer($request->input('idTransfer'));
                    break;
                case 'viewTransfer':
                    $response->out = $this->viewEditTransfer($request->input('idTransfer'));
                    break;
                case 'createTransfer':
                    $response->localizador = $this->createTransfer($request);
                    break;
                case 'deleteTransfer':
                    $this->deleteTransfer($request->input('idTransfer'));
                    $response->message = "Transfer eliminado correctamente.";
                    break;
                case 'saveEditData':
                    $this->saveEditData($request);
                    $response->message = "Transfer modificado correctamente.";
                    break;
                default:
                    throw new \Exception("Acción no válida.");
            }
        } catch (\Exception $e) {
            $response->error = true;
            $response->message = $e->getMessage();
        }

        return response()->json($response);
    }

    // Generar contraseña aleatoria
    public function generarPasswordAleatorio($longitud = 8): string
    {
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()'), 0, $longitud);
    }

    // Generar localizador de reserva
    public function generaLocalizadorReserva($longitud = 5): string
    {
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, $longitud);
    }

    // Asignar vehículo al transfer
    private function asignaVehiculo($idCliente): int
    {
        $descripcion = "Transfer vendido";
        $vehiculo = new TransferVehiculo();
        return $vehiculo->insertTransferVehiculo($descripcion, $idCliente);
    }

    // Cargar la lista de hoteles según el rol
    public function drawHotelesList()
    {
        $rol = Session::get('rol');
        $hotelEntity = new Hoteles();
        $hoteles = [];

        if ($rol == 1 || $rol == 3) {
            $hoteles = $hotelEntity->getHoteles();
        } elseif ($rol == 2) {
            $clienteEntity = new Cliente();
            $cliente = $clienteEntity->getClienteByUsername(Session::get('user'));
            $idHotel = $hotelEntity->getIdHotelByIdCliente($cliente['idCliente']);
            $hoteles = $hotelEntity->getHotelArray($idHotel);
        }

        return $hoteles;
    }

    // Mostrar el formulario de edición de un transfer
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

    // Mostrar detalles de un transfer
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

    // Crear un nuevo transfer
    private function createTransfer(Request $request)
    {
        $data = json_decode($request->input('transfer'), true);
        $localizador = $this->generaLocalizadorReserva();

        $transferEntity = new Transfer();
        $transferEntity->insertTransfer($data, $localizador);

        return $localizador;
    }

    // Eliminar un transfer
    private function deleteTransfer($idTransfer)
    {
        $transferEntity = new Transfer();
        $transferEntity->delete($idTransfer);
    }

    // Guardar datos editados de un transfer
    private function saveEditData(Request $request)
    {
        $data = json_decode($request->input('transfer'), true);
        $idTransfer = $request->input('idTransfer');

        $transferEntity = new Transfer();
        $transferEntity->update($idTransfer, $data);
    }

    // Cargar datos del usuario
    private function loadUserData()
    {
        $user = Session::get('user');
        $clienteEntity = new Cliente();
        return $clienteEntity->getClienteByUsername($user);
    }

    // Cargar todos los transfers activos
    private function loadTransfer()
    {
        $rol = Session::get('rol');
        $transferEntity = new Transfer();

        switch ($rol) {
            case 1: // Admin
                return $transferEntity->getAllTransfersActivos();
            case 2: // Hotel
                return $this->getHotelTransfers();
            case 3: // Cliente
                return $this->getClientTransfers();
            default:
                throw new \Exception("Rol no válido.");
        }
    }

    // Obtener transfers de un cliente
    private function getClientTransfers()
    {
        $clienteEntity = new Cliente();
        $user = Session::get('user');
        $cliente = $clienteEntity->getClienteByUsername($user);

        $transferEntity = new Transfer();
        return $transferEntity->getTransferByIdCliente($cliente['idCliente']);
    }

    // Obtener transfers asociados a un hotel
    private function getHotelTransfers()
    {
        $clienteEntity = new Cliente();
        $user = Session::get('user');
        $cliente = $clienteEntity->getClienteByUsername($user);

        $hotelesEntity = new Hoteles();
        $idHotel = $hotelesEntity->getIdHotelByIdCliente($cliente['idCliente']);

        $transferEntity = new Transfer();
        return $transferEntity->getAllTransfersActivosByIdHotel($idHotel);
    }
}
