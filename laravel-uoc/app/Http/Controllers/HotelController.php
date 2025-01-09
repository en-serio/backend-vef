<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferHotel;
use Inertia\Inertia;

class HotelController extends Controller
{
    public function obtenerHoteles(){
        $result = new \stdClass();
        $result->error = false;
        $result->message = null;
        try{
            $hoteles = TransferHotel::all();
            $result->error = false;
            $result->message = "correcto";
            $result->hoteles = $hoteles;
            Inertia::render('Dash/HotelesDash', [
                'hoteles' => $hoteles,
            ]);
        }catch(\Exception $e){
            $result->error = true;
            $result->message = null;
            return response()->json($result);
        }
    }

    public function obtenerHotelesUsuario($request){
        try{
            $hoteles = TransferHotel::where('usuario', $request->id_usuario)->get();
        }catch(\Exception $e){
            
        }
    }

    public function crearHotel($request){
        $result = new \stdClass();
        $result->error = false;
        $result->message = null;
        $request->validate([
            'id_zona' => 'required|integer|exists:transfer_zona,id_zona',
            'Comision' => 'required|numeric|min:0',
            'usuario' => 'required|integer|exists:users,id',
            'nombre_hotel' => 'required|string|max:255',
            'direccion_hotel' => 'required|string|max:255',
        ]);

        try{
            $hotel = TransferHotel::create([
                'id_zona' => $request->id_zona,
                'Comision' => $request->Comision,
                'usuario' => $request->usuario,
                'nombre_hotel' => $request->nombre_hotel,
                'direccion_hotel' => $request->direccion_hotel,
            ]);
            $result->error = false;
            $result->message = "Hotel creado correctamente";
        }catch(\Exception $e){
            $result->error = true;
            $result->message = $e->getMessage();
        }
        return response()->json($result);
    }
}
