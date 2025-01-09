<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TransferHotel;
use App\Models\User;
use App\Models\TransferZona;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\TransferTipoReserva;
use App\Models\TransferVehiculo;
use App\Models\TransferViajeros;
use App\Models\TransferReservas;
use App\Models\TransferPrecios;

use function PHPUnit\Framework\isEmpty;

class TransferController extends Controller
{
    public function nuevoUsuario(Request $request){
        Log::info($request);
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'rol' => 'required|integer|min:1|max:3',
            'id_viajero' => 'required|integer',
        ]);
        $pass = $request->name . '1234';
        $contra = Hash::make($pass);
        User::create([
            'name' => $request->name,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'email' => $request->email,
            'rol' => $request->rol,
            'id_viajero' => $request->id_viajero,
            'password' => $contra,
        ]);
        $usuarios = User::select('id', 'name','apellido1', 'apellido2', 'email', 'rol', 'id_viajero')->get();
        return Inertia::render('Usuarios', [
            'usuarios' => $usuarios,
        ]);
    }


    public function actualizarUsuario(Request $request){
        Log::info($request);
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'rol' => 'required|integer|min:1|max:3',
            'id_viajero' => 'required|integer',
        ]);
        User::where('id', $request->id)->update([
            'name' => $request->name,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'email' => $request->email,
            'rol' => $request->rol,
            'id_viajero' => $request->id_viajero,
        ]);
        $usuarios = User::select('id', 'name', 'apellido1', 'apellido2', 'email', 'rol', 'id_viajero')->get();
        return Inertia::render('Usuarios', [
            'usuarios' => $usuarios,
        ]);
    }

    public function obtenerHoteles(){
        Log::info(session('rol'));
        try{
            if(session('rol') == 2){
                $this->obtenerHotelesUser();
            }else if(session('rol') == 3){
                return Inertia::render('Dashboard');
            }
            $hot = TransferHotel::all();
            $users = User::select('id', 'name')->get();
            $zon = TransferZona::all();
            return Inertia::render('Hoteles', [
                'hoteles' => $hot,
                'usuarios' => $users,
                'zonas' => $zon,
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function obtenerHotelesUser(){
        
        try{
            if(session('rol') == 1){
                $this->obtenerHoteles();
            }else if(session('rol') == 3){
                return Inertia::render('Dashboard');
            }
            $hot = TransferHotel::where('usuario', session('id'))->get();
            $users = User::where('id', session('id'))->select('id', 'name')->get();
            $zon = TransferZona::all();
            Log::info($hot);
            Log::info($users);
            Log::info($zon);
            return Inertia::render('Hoteles', [
                'hoteles' => $hot,
                'usuarios' => $users,
                'zonas' => $zon,
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function nuevoTipo(Request $request){
        Log::info($request);
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'tipoName' => 'required|string|max:255',
        ]);
        TransferTipoReserva::create([
            'Descripción' => $request->tipoName,
        ]);
        return Inertia::render('Preferencias', [
            'tiposReserva' => TransferTipoReserva::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function actualizarTipo(Request $request){
        Log::info($request);
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'id_tipo_reserva' => 'required|integer|exists:transfer_tipo_reserva,id_tipo_reserva',
            'tipoName' => 'required|string|max:255',
        ]);
        TransferTipoReserva::where('id_tipo_reserva', $request->id_tipo_reserva)->update([
            'Descripción' => $request->tipoName,
        ]);
        return Inertia::render('Preferencias', [
            'tiposReserva' => TransferTipoReserva::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function nuevaZona(Request $request){
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        Log::info($request);
        $request->validate([
            'zonaname' => 'required|string|max:255',
        ]);
        TransferZona::create([
            'descripcion' => $request->zonaname,
        ]);
        return Inertia::render('Preferencias', [
            'tiposReserva' => TransferTipoReserva::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function actualizarZona(Request $request){
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        Log::info($request);
        $request->validate([
            'id_zona' => 'required|integer|exists:transfer_zona,id_zona',
            'zonaname' => 'required|string|max:255',
        ]);
        TransferZona::where('id_zona', $request->id_zona)->update([
            'descripcion' => $request->zonaname,
        ]);
        return Inertia::render('Preferencias', [
            'tiposReserva' => TransferTipoReserva::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function nuevoHotel(Request $request){
        if(session('rol') == 2){
            $this->nuevoHotelUser($request);
        }else if(session('rol') == 3){
            return Inertia::render('Dashboard');
        }
        Log::info($request);
        $request->validate([
            'idzona' => 'required|integer|exists:transfer_zona,id_zona',
            'comision' => 'required|numeric|min:0',
            'idusuario' => 'required|integer|exists:users,id',
            'hotelname' => 'required|string|max:255',
            'dirhotel' => 'required|string|max:255',
        ]);
        TransferHotel::create([
            'id_zona' => $request->idzona,
            'Comision' => $request->comision,
            'usuario' => $request->idusuario,
            'nombre_hotel' => $request->hotelname,
            'direccion_hotel' => $request->dirhotel,
        ]);
        $precio = $request->comision + 100;
        TransferPrecios::create([
            'id_vehiculo' => 1,
            'id_hotel' => TransferHotel::orderBy('id_hotel', 'desc')->first()->id_hotel,
            'Precio' => $precio,
        ]);
        return Inertia::render('Hoteles', [
            'hoteles' => TransferHotel::all(),
            'usuarios' => User::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function actualizarHotel(Request $request){
        Log::info($request);
        if(session('rol') == 2){
            $this->actualizarHotelUser($request);
        }else if(session('rol') == 3){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'idhotel' => 'required|integer|exists:transfer_hotel,id_hotel',
            'idzona' => 'required|integer|exists:transfer_zona,id_zona',
            'comision' => 'required|numeric|min:0',
            'idusuario' => 'required|integer|exists:users,id',
            'hotelname' => 'required|string|max:255',
            'dirhotel' => 'required|string|max:255',
        ]);
        TransferHotel::where('id_hotel', $request->idhotel)->update([
            'id_zona' => $request->idzona,
            'Comision' => $request->comision,
            'usuario' => $request->idusuario,
            'nombre_hotel' => $request->hotelname,
            'direccion_hotel' => $request->dirhotel,
        ]);
        $precio = $request->comision + 100;
        TransferPrecios::where('id_hotel', $request->idhotel)->update([
            'Precio' => $precio,
        ]);
        return Inertia::render('Hoteles', [
            'hoteles' => TransferHotel::all(),
            'usuarios' => User::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function nuevoHotelUser(Request $request){
        Log::info($request);
        $request->validate([
            'idzona' => 'required|integer|exists:transfer_zona,id_zona',
            'comision' => 'required|numeric|min:0',
            'idusuario' => 'required|integer|exists:users,id',
            'hotelname' => 'required|string|max:255',
            'dirhotel' => 'required|string|max:255',
        ]);
        TransferHotel::create([
            'id_zona' => $request->idzona,
            'Comision' => $request->comision,
            'usuario' => $request->idusuario,
            'nombre_hotel' => $request->hotelname,
            'direccion_hotel' => $request->dirhotel,
        ]);
        $precio = $request->comision + 100;
        TransferPrecios::create([
            'id_vehiculo' => 1,
            'id_hotel' => TransferHotel::orderBy('id_hotel', 'desc')->first()->id_hotel,
            'Precio' => $precio,
        ]);
        $hot = TransferHotel::where('usuario', $request->user()->id)->get();
        $users = User::where('id', $request->user()->id)->select('id', 'name')->get();
        $zon = TransferZona::all();
        return Inertia::render('Hoteles', [
            'hoteles' => $hot,
            'usuarios' => $users,
            'zonas' => $zon,
        ]);
    }

    public function actualizarHotelUser(Request $request){
        Log::info($request);
        $request->validate([
            'idhotel' => 'required|integer|exists:transfer_hotel,id_hotel',
            'idzona' => 'required|integer|exists:transfer_zona,id_zona',
            'comision' => 'required|numeric|min:0',
            'idusuario' => 'required|integer|exists:users,id',
            'hotelname' => 'required|string|max:255',
            'dirhotel' => 'required|string|max:255',
        ]);

        TransferHotel::where('id_hotel', $request->idhotel)->update([
            'id_zona' => $request->idzona,
            'Comision' => $request->comision,
            'usuario' => $request->idusuario,
            'nombre_hotel' => $request->hotelname,
            'direccion_hotel' => $request->dirhotel,
        ]);
        $precio = $request->comision + 100;
        TransferPrecios::where('id_hotel', $request->idhotel)->update([
            'Precio' => $precio,
        ]);
        $hot = TransferHotel::where('usuario', $request->user()->id)->get();
        $users = User::where('id', $request->user()->id)->select('id', 'name')->get();
        $zon = TransferZona::all();
        return Inertia::render('Hoteles', [
            'hoteles' => $hot,
            'usuarios' => $users,
            'zonas' => $zon,
        ]);
    }
    
    public function nuevoVehiculo(Request $request){
        Log::info($request);
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'desc' => 'required|string|max:255',
            'emailCond' => 'required|string|max:255',
            'plazas' => 'required|integer|min:1',
            'password' => 'required|string|max:255',
        ]);
        TransferVehiculo::create([
            'Descripción' => $request->desc,
            'email_conductor' => $request->emailCond,
            'plazas' => $request->plazas,
            'password' => $request->password,
        ]);
        return Inertia::render('Conductor', [
            'vehiculos' => TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')->get(),
        ]);
    }

    public function actualizarVehiculo(Request $request){
        Log::info($request);
        if(session('rol') != 1){
            return Inertia::render('Dashboard');
        }
        $request->validate([
            'idVehiculo' => 'required|integer|exists:transfer_vehiculo,id_vehiculo',
            'desc' => 'required|string|max:255',
            'emailCond' => 'required|string|max:255',
            'plazas' => 'required|integer|min:1',
            'password' => 'required|string|max:255',
        ]);
        TransferHotel::where('id_hotel', $request->idhotel)->update([
            'Descripción' => $request->desc,
            'email_conductor' => $request->emailCond,
            'plazas' => $request->plazas,
            'password' => $request->password,
        ]);
        return Inertia::render('Conductor', [
            'vehiculos' => TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')->get(),
        ]);
    }

    public function guardarTransfer(Request $request){
        Log::info($request);
        try{
            $request->validate([
                'selectedOption' => 'required|integer|exists:transfer_tipo_reserva,id_tipo_reserva',
                'numeroVia' => 'required|integer|min:1',
                'hotelDest' => 'required|integer|exists:transfer_hotel,id_hotel',
                'nombre' => 'required|string|max:100',
                'apellidouno' => 'required|string|max:100',
                'apellidodos' => 'required|string|max:100',
                'email' => 'required|string|max:100',
                'telefono' => 'required|integer',
                'direccion' => 'required|string|max:100',
                'codigoPostal' => 'required|string|max:10',
                'ciudad' => 'required|string|max:100',
                'pais' => 'required|string|max:100',
                'dni' => 'required|string|max:20',
            ]);
            $user = null;
            $viajero = null;
            if(session('rol') == 3){
                $user = User::where('id', session('id'))->get();
                if($user && $user[0]->id_viajero != 0){
                    $viajero = TransferViajeros::where('id_viajero', $user[0]->id_viajero)->get();
                    if(!$viajero){
                        $viajero = TransferViajeros::where('email', $request->email)->get();
                    }
                }
            }else{
                $viajero = TransferViajeros::where('email', $request->email)->get();
            }
            $idViajero = 0;
            $num = $this->generaPassword();
            $contra = Hash::make($num);
            Log::info('Hay viajero??' . $viajero);
            if($viajero->isNotEmpty()){
                Log::info('Viajero encontrado: Entro' );
                $idViajero = $viajero[0]->id_viajero;
                Log::info('Viajero encontrado: ' . $idViajero);
                TransferViajeros::where('id_viajero', $idViajero)->update([
                    'password' => $contra,
                ]);
                if(!$user){
                    $user = User::where('email', $request->email)->get();
                    if(!$user){
                        User::create([
                            'name' => $request->nombre,
                            'email' => $request->email,
                            'password' => $contra,
                            'rol' => 3,
                            'id_viajero' => $idViajero,
                        ]);
                    }
                }
            }else{
                TransferViajeros::create([
                    'nombre' => $request->nombre,
                    'apellido1' => $request->apellidouno,
                    'apellido2' => $request->apellidodos,
                    'direccion' => $request->direccion,
                    'codigoPostal' => $request->codigoPostal,
                    'ciudad' => $request->ciudad,
                    'pais' => $request->pais,
                    'email' => $request->email,
                    'password' => $contra,
                    'telefono' => $request->telefono,
                    'dni' => $request->dni,
                ]);
                Log::info('Viajero creado');
                $viajero = TransferViajeros::where('email', $request->email)->get();
                $user = User::where('email', $request->email)->get();
                $idViajero = $viajero[0]->id_viajero;
                if(!$user->isNotEmpty()){
                    User::create([
                        'name' => $request->nombre,
                        'email' => $request->email,
                        'password' => $contra,
                        'rol' => 3,
                        'id_viajero' => $idViajero,
                    ]);
                }else{
                    User::where('email', $request->email)->update([
                        'id_viajero' => $idViajero,
                    ]);
                }
            }
            $reservaExistente = true;
            $vehiculoIda = new \stdClass();
            $vehiculoVuelta = new \stdClass();
            
            Log::info('Buscando vehículo...');
            if($request->selectedOption == 1 ||$request->selectedOption == 3){
                $vehiculoIda = $this->obtenerVehiculoIdaTransfer($request);
                Log::info('Vehículo ida asignado: ' . ($vehiculoIda ? $vehiculoIda->id_vehiculo : 'Ninguno'));
            }
            if($request->selectedOption == 2 ||$request->selectedOption == 3){
                $vehiculoVuelta = $this->obtenerVehiculoVueltaTransfer($request);
                Log::info('Vehículo vuelta asignado: ' . ($vehiculoVuelta ? $vehiculoVuelta->id_vehiculo : 'Ninguno'));
            }
            
            $hoy = date("Y-m-d H:i:s");
            $localizador1 = $this->generaLocalizadorReserva();
            $localizador2 = $this->generaLocalizadorReserva();
            if($request->selectedOption == 1 ||$request->selectedOption == 3){
                $dateVacio = '1980-01-01';
                $timeVacio = '00:00:00';
                TransferReservas::create([
                    'localizador' => $localizador1,
                    'id_hotel' => $request->hotelDest,
                    'id_tipo_reserva' => 1,
                    'email_cliente' => $idViajero,
                    'fecha_reserva' => $hoy,
                    'fecha_modificacion' => $hoy,
                    'id_destino' => $request->hotelDest,
                    'fecha_entrada' => $request->diaLlegada,
                    'hora_entrada' => $request->horaLlegada,
                    'numero_vuelo_entrada' => $request->numeroVueloLlegada,
                    'origen_vuelo_entrada' => $request->aeropuertoOrigen,
                    'hora_vuelo_salida' => $timeVacio,
                    'fecha_vuelo_salida' => $dateVacio,
                    'num_viajeros' => $request->numeroVia,
                    'id_vehiculo' => $vehiculoIda->id_vehiculo,
                ]);
            }
            if($request->selectedOption == 2 ||$request->selectedOption == 3){
                $dateVacio = '1980-01-01';
                TransferReservas::create([
                    'localizador' => $localizador2,
                    'id_hotel' => $request->hotelDest,
                    'id_tipo_reserva' => 2,
                    'email_cliente' => $idViajero,
                    'fecha_reserva' => $hoy,
                    'fecha_modificacion' => $hoy,
                    'id_destino' => $request->hotelDest,
                    'fecha_entrada' => $dateVacio,
                    'hora_entrada' => $request->horaRecogida,
                    'numero_vuelo_entrada' => $request->numeroVueloSalida,
                    'origen_vuelo_entrada' => "Aeropuerto Local",
                    'hora_vuelo_salida' => $request->horaVuelo,
                    'fecha_vuelo_salida' => $request->diaVuelo,
                    'num_viajeros' => $request->numeroVia,
                    'id_vehiculo' => $vehiculoVuelta->id_vehiculo,
                ]);
            }
            if($request->selectedOption == 3){
                $reservas = TransferReservas::whereIn('localizador', [$localizador1, $localizador2])->get();
            }else if($request->selectedOption == 1){
                $reservas = TransferReservas::where('localizador', $localizador1)->get();
            }else{
                $reservas = TransferReservas::where('localizador', $localizador2)->get();
            }
            Log::info($reservas);
            return Inertia::render('NuevoTransfer', [
                'datos' => [
                    [
                        'contrasenya' => $num,
                        'localizador' => $request->selectedOption == 3 ? $localizador1 . '-' . $localizador2 : ($request->selectedOption == 1 ? $localizador1 : $localizador2),
                    ]
                ],
                'transfers' => $reservas,
                'hoteles' => TransferHotel::select('id_hotel', 'id_zona', 'nombre_hotel', 'direccion_hotel')->get(),
                'tipoReservas' => TransferTipoReserva::all(),
                'viajeros' => TransferViajeros::select('id_viajero', 'email')->where('id_viajero', $idViajero)->get(),
            ]);
        }catch(\Exception $e){ 
            Log::error('Error encontrado', [
                'mensaje' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile(),
                'traza' => $e->getTraceAsString(),
            ]);
        }
    }

    public function obtenerVehiculoIdaTransfer(Request $request){
        $idNo = [0];
        $vehiculo = TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')
                ->where('plazas', '>=', $request->numeroVia)
                ->first();
        return $vehiculo;
        // do {
        //     $vehiculo = TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')
        //         ->where('plazas', '>=', $request->numeroVia)
        //         ->whereNotIn('id_vehiculo', $idNo)
        //         ->first();
        //     if (is_null($vehiculo)) {
        //         Log::error('No hay vehículos disponibles con las plazas requeridas.');
        //         $vehiculoFicticio = new \stdClass();
        //         $vehiculoFicticio->id_vehiculo = 0;
        //         return $vehiculoFicticio;
        //     }
        //     Log::info('Vehículo encontrado: ' . $vehiculo->id_vehiculo);
        //     $horaInicio = Carbon::parse($request->horaLlegada)->subHour();
        //     $horaFin = Carbon::parse($request->horaLlegada)->addHour();
        //     $registros = TransferReservas::where('fecha_entrada', $request->diaLlegada)
        //     ->whereBetween('hora_entrada', [$horaInicio, $horaFin])
        //     ->get();
        //     if ($registros->isNotEmpty()) {
        //         $vehiculoEncontrado = $registros->contains('id_vehiculo', $vehiculo->id_vehiculo);
        //         if ($vehiculoEncontrado) {
        //             Log::info('Vehículo ocupado en la fecha y hora requeridas.');
        //             array_push($idNo, $vehiculo->id_vehiculo);
        //         } else {
        //             Log::info('Vehículo disponible,'. $vehiculo->id_vehiculo);
        //             return $vehiculo;
        //         }
        //     }
        // } while (true);
    }

    public function obtenerVehiculoVueltaTransfer(Request $request){
        $idNo = [0];
        $vehiculo = TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')
                ->where('plazas', '>=', $request->numeroVia)
                ->first();
        return $vehiculo;
        // do {
        //     $vehiculo = TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')
        //         ->where('plazas', '>=', $request->numeroVia)
        //         ->whereNotIn('id_vehiculo', $idNo)
        //         ->first();
        //     if (is_null($vehiculo)) {
        //         Log::error('No hay vehículos disponibles con las plazas requeridas.');
        //         $vehiculoFicticio = new \stdClass();
        //         $vehiculoFicticio->id_vehiculo = 0;
        //         return $vehiculoFicticio;
        //     }
        //     Log::info('Vehículo encontrado: ' . $vehiculo->id_vehiculo);
        //     $horaInicio = Carbon::parse($request->hora_vuelo_salida)->subHour();
        //     $horaFin = Carbon::parse($request->hora_vuelo_salida)->addHour();
        //     $registros = TransferReservas::where('fecha_entrada', $request->fecha_vuelo_salida)
        //     ->whereBetween('hora_entrada', [$horaInicio, $horaFin])
        //     ->get();
        //     if ($registros->isNotEmpty()) {
        //         $vehiculoEncontrado = $registros->contains('id_vehiculo', $vehiculo->id_vehiculo);
        //         if ($vehiculoEncontrado) {
        //             Log::info('Vehículo ocupado en la fecha y hora requeridas.');
        //             array_push($idNo, $vehiculo->id_vehiculo);
        //         } else {
        //             Log::info('Vehículo disponible,'. $vehiculo->id_vehiculo);
        //             return $vehiculo;
        //         }
        //     }
        // } while (true);
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

    public function generaPassword(){
        $longitud = 8;
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';
        $maxIndex = strlen($caracteres) - 1;
    
        for ($i = 0; $i < $longitud; $i++) {
            $password .= $caracteres[random_int(0, $maxIndex)];
        }
    
        return $password;
    }


    //funcion debug
    public function getReservas(){
        $localizador1 = 'PNLtu';
        $localizador2 = 'zF4zO';
        $num = '12345678';
        $idViajero = 1;
        $reservas = TransferReservas::whereIn('localizador', [$localizador1, $localizador2])->get();
        return Inertia::render('NuevoTransfer', [
            'datos' => [
                [
                    'contrasenya' => $num,
                    'localizador' => $localizador1 . '-' . $localizador2,
                ]
            ],
            'transfers' => $reservas,
            'hoteles' => TransferHotel::all(),
                'tipoReservas' => TransferTipoReserva::all(),
                'viajeros' => TransferViajeros::select('id_viajero', 'email')->where('id_viajero', $idViajero)->get(),
        ]);
    }

    public function deletearTrans(Request $request){
        Log::info($request);
        $request->validate([
            'id_reserva' => 'required|integer|exists:transfer_reservas,id_reserva',
        ]);
        TransferReservas::where('id_reserva', $request->id_reserva)->delete();
        $transfers = '';
        $hoteles = '';
        $usuarios = '';
        $viajeros = '';
        if(session('rol') == 1){
            $transfers = TransferReservas::all();
            $hoteles = TransferHotel::all();
            $usuarios = User::all();
            $viajeros = TransferViajeros::all();
        }else if(session('rol') == 2){
            $transfers = TransferReservas::where('id_hotel', session('id'))->get();
            $hoteles = TransferHotel::where('usuario', session()->get('id'))->get();
            $usuarios = User::where('id', session()->get('id'))->get();
            $viajeros = TransferViajeros::all();
        }else{
            $transfers = TransferReservas::where('email_cliente', session('id'))->get();
            $hoteles = TransferHotel::all();
            $usuarios = User::where('id', session('id'))->get();
            $viajeros = TransferViajeros::where('id_viajero', $usuarios->id_viajero)->get();
        }
        return Inertia::render('Transfers', [
            'tipoReservas' => TransferTipoReserva::all(),
            'transfers' => $transfers,
            'hoteles' => $hoteles,
            'usuarios' => $usuarios,
            'viajeros' => $viajeros,
            'vehiculos' => TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')->get(),
        ]);
    }

    public function deletearTipo(Request $request){
        Log::info($request);
        $request->validate([
            'id_tipo_reserva' => 'required|integer|exists:transfer_tipo_reserva,id_tipo_reserva',
        ]);
        TransferTipoReserva::where('id_tipo_reserva', $request->id_tipo_reserva)->delete();
        return Inertia::render('Preferencias', [
            'tiposReserva' => TransferTipoReserva::all(),
            'zonas' => TransferZona::all(),
        ]);
    }

    public function deletearZona(Request $request){
        Log::info($request);
        $request->validate([
            'id_zona' => 'required|integer|exists:transfer_zona,id_zona',
        ]);
        TransferZona::where('id_zona', $request->id_zona)->delete();
        return Inertia::render('Preferencias', [
            'tiposReserva' => TransferTipoReserva::all(),
            'zonas' => TransferZona::all(),
        ]);
    }
    public function deletearUsuario(Request $request){
        Log::info($request);
        $request->validate([
            'id' => 'required|integer|exists:users,id',
        ]);
        User::where('id', $request->id)->delete();
        return Inertia::render('Usuarios', [
            'usuarios' => User::select('id', 'name','apellido1', 'apellido2', 'email', 'rol', 'id_viajero')->get(),
        ]);
    }

    public function deletearVehiculo(Request $request){
        Log::info($request);
        $request->validate([
            'idVehiculo' => 'required|integer|exists:transfer_vehiculo,id_vehiculo',
        ]);
        TransferVehiculo::where('id_vehiculo', $request->idVehiculo)->delete();
        return Inertia::render('Conductor', [
            'vehiculos' => TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')->get(),
        ]);
    }

    public function deletearHotel(Request $request){
        Log::info($request);
        $request->validate([
            'idhotel' => 'required|integer|exists:transfer_hotel,id_hotel',
        ]);
        TransferHotel::where('id_hotel', $request->idhotel)->delete();
        $this->obtenerHoteles();
    }

    public function actualizarTransfer(Request $request){
        Log::info($request);
        $request->validate([
            'id_reserva' => 'required|integer|exists:transfer_reservas,id_reserva',
            'id_hotel' => 'required|integer|exists:transfer_hotel,id_hotel',
            'id_tipo_reserva' => 'required|integer|exists:transfer_tipo_reserva,id_tipo_reserva',
        ]);
        if($request->id_tipo_reserva == 1){
            $request->validate([
                'hora_entrada' => 'required|string|max:15',
                'fecha_entrada' => 'required|string|max:15',
            ]);
            TransferReservas::where('id_reserva', $request->id_reserva)->update([
                'id_hotel' => $request->id_hotel,
                'hora_entrada' => $request->hora_entrada,
                'fecha_entrada' => $request->fecha_entrada,
            ]);
        }else{
            $request->validate([
                'hora_entrada' => 'required|string|max:15',
                'fecha_vuelo_salida' => 'required|string|max:15',
            ]);
            TransferReservas::where('id_reserva', $request->id_reserva)->update([
                'id_hotel' => $request->id_hotel,
                'hora_vuelo_salida' => $request->hora_entrada,
                'hora_entrada' => $request->hora_entrada,
                'fecha_vuelo_salida' => $request->fecha_vuelo_salida,
            ]);
        }
        $transfers = TransferReservas::where('id_reserva', $request->id_reserva)->get();
        return Inertia::render('NuevoTransfer', [
            'datos' => [
                [
                    'contrasenya' => 'No se ha actualizado la contraseña',
                    'localizador' => $request->localizador,
                ]
            ],
            'transfers' => $transfers,
            'hoteles' => TransferHotel::select('id_hotel', 'id_zona', 'nombre_hotel', 'direccion_hotel')->get(),
            'tipoReservas' => TransferTipoReserva::all(),
            'viajeros' => TransferViajeros::select('id_viajero', 'email')->where('id_viajero', $request->email_cliente)->get(),
        ]);
    }

}
