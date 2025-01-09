<?php

namespace App\Http\Controllers;

use App\Models\TransferZona;
use App\Models\TransferTipoReserva;
use App\Models\TransferHotel;
use App\Models\TransferReservas;
use App\Models\TransferVehiculo;
use App\Models\User;
use App\Models\TransferViajeros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function estadisticas(){
        Log::info(session('rol'));
        try{
            // if(session('rol') == 2){
            //     $this->obtenerHotelesUser();
            // }else if(session('rol') == 3){
            //     return Inertia::render('Dashboard');
            // }
            $hot = TransferHotel::all();
            $users = User::select('id', 'name')->get();
            $zon = TransferZona::all();
            $transfers = TransferReservas::all();
            return Inertia::render('Estadisticas', [
                'transfers' => $transfers,
                'hoteles' => $hot,
                'usuarios' => $users,
                'zonas' => $zon,
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getUsuarios(){
        if(session('rol') != 1){
            return Inertia::render('dashboard');
        }
        try{
            $usuarios = User::select('id', 'name', 'apellido1', 'apellido2', 'email', 'rol', 'id_viajero')->get();
            return Inertia::render('Usuarios', [
                'usuarios' => $usuarios,
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function cargarPrefer(){
        Log::info(session('rol'));
        
        try{
            // Crear datos falsos
            $tiposReserva = transferTipoReserva::all();
            $zonas = transferZona::all();
            return Inertia::render('Preferencias', [
                'tiposReserva' => $tiposReserva,
                'zonas' => $zonas,
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }   

    public function obtenerVehCliente(Request $request){
        Log::info(session('rol'));
        try{
            $hot = TransferHotel::select('id_hotel', 'nombre_hotel', 'direccion_hotel')->get();
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

    public function vehiculos(){
        Log::info(session('rol'));
        if(session('rol') == 3){
            return Inertia::render('dashboard');
        }
        try{
            $vehiculos = TransferVehiculo::select('id_vehiculo', 'Descripción', 'email_conductor', 'plazas')->get();
            return Inertia::render('Conductor', [
                'vehiculos' => $vehiculos,
            ]);
        }catch(\Exception $e){
            Log::info('erroreees'.$e->getMessage());

        }
    }
    
    public function gestionTransfers(){
        Log::info(session('rol'));
        try{
            $tiposReserva = '';
            $hoteles = '';
            $usuarios = '';
            $vehiculos = '';
            $transfers = '';
            $viajeros = '';
            if(session('rol') == 1){
                $tipoReservas = TransferTipoReserva::all();
                $hoteles = TransferHotel::all();
                $usuarios = User::all();
                $transfers = TransferReservas::all();
                $viajeros = TransferViajeros::all();
            }else if(session('rol') == 2){
                $tipoReservas = TransferTipoReserva::all();
                $hoteles = TransferHotel::select('id_hotel', 'direccion_hotel', 'nombre_hotel', 'id_zona')->where('usuario', session('id'))->get();
                $usuarios = User::where('id', session('id'))->get();
                $transfers = TransferReservas::all(); //aqui iba a filtrar por los hoteles pero si es un corporativo puede ver todos los transfers de momento
                $viajeros = TransferViajeros::select('id_viajero', 'email', 'nombre')->get();
            }else if(session('rol') == 3){
                $tipoReservas = TransferTipoReserva::all();
                $hoteles = TransferHotel::select('id_hotel', 'direccion_hotel', 'nombre_hotel', 'id_zona')->get();
                $usuarios = User::where('id', session('id'))->get();
                $viajeros = TransferViajeros::select('id_viajero', 'email', 'nombre')->where('id_viajero', $usuarios[0]->id_viajero)->get();
                $transfers = TransferReservas::where('email_cliente', $viajeros[0]->id_viajero)->get();
            }
            return Inertia::render('Transfers', [
                'transfers' => $transfers,
                'tipoReservas' => $tipoReservas,
                'hoteles' => $hoteles,
                'usuarios' => $usuarios,
                'viajeros' => $viajeros,
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function crearTransfer(){
        try{
            log::info('llegamos');
            $tiposReserva = transferTipoReserva::all();
            $rol = session('rol');
            $hoteles = [];
            if($rol == 1){
                $hoteles = TransferHotel::all();
            } else if($rol == 2){
                
                $hoteles = TransferHotel::select('id_hotel', 'direccion_hotel', 'nombre_hotel', 'id_zona')->where('usuario', session('id'))->get();
            } else {
                $hoteles = TransferHotel::select('id_hotel', 'direccion_hotel', 'nombre_hotel', 'id_zona')->get();
            }
            Log::info($hoteles);
            return Inertia::render('CrearTransfer', [
                'tipos' => $tiposReserva,
                'hoteles' => $hoteles,
                'usuario' => User::select('name', 'apellido1', 'apellido2', 'email')->where('id', session('id'))->get(),
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

    public function getCalendario(){
        try{
            $transfers = TransferReservas::all();
            if(session('rol') != 1){
                return Inertia::render('dashboard');
            }
            return Inertia::render('Calendario', [
                'transfers' => $transfers,
                'hoteles' => TransferHotel::select('id_hotel', 'direccion_hotel', 'nombre_hotel', 'id_zona')->get(),
                'tipoReservas' => TransferTipoReserva::all(),
                'viajeros' => TransferViajeros::select('id_viajero', 'email')->get(),
            ]);
        }catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }
}
