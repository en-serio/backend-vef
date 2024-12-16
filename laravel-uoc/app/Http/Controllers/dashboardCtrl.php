<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cliente;
use App\Models\TransferVehiculo;

class dashboardCtrl extends Controller
{
    private $db;
    private $userEntity;

    public function __construct()
    {
      
    }


    public function index()
    {
        // Verifica si la sesión contiene un usuario activo
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión primero.');
        }

        // Recupera el rol para usarlo en la vista
        $rol = Session::get('rol');

        return view('dashboard.dashboard', compact('rol'));
    }


    public function procesaPost(Request $request)
    {
        $post = $request->all(); 

        return response()->json(['success' => true, 'message' => 'Datos procesados correctamente.']);
    }
}
