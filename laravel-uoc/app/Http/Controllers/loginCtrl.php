<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\log;
use App\Models\Cliente;

class loginCtrl extends Controller
{
    // Mapeo de acciones a métodos
    private $actions = [
        'login' => 'login',
        'logout' => 'logout',
    ];

    public function index()
    {
        return view('auth.login');
    }

    public function procesaPost(Request $request)
    {
        try {
            $request->validate([
                'action' => 'required|string',
                'userName' => 'required|string',
                'password' => 'required|string',
            ]);

            $action = $request->input('action');

            if ($action === 'login') {
                $username = $request->input('userName');
                $password = $request->input('password');

                $cliente = new Cliente();

                if (!$cliente->verifyUser($username, $password)) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Usuario o contraseña incorrecto. Vuelve a intentarlo'
                    ]);
                }

                $cliente->getClienteByUsername($username);
                $rol = $cliente->rol;

                Session::put('user', $username);
                Session::put('rol', $rol);

                return response()->json([
                    'error' => false,
                    'message' => 'Inicio de sesión exitoso.'
                ]);
            }

            throw new \Exception('Acción no válida.');
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }



    private function login(Request $request)
    {
        $result = new \stdClass();
        $result->error = false;

        // Validar los campos enviados
        $request->validate([
            'userName' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('userName');
        $password = $request->input('password');

        $cliente = new Cliente();

        if (!$cliente->verifyUser($username, $password)) {
            throw new \Exception("Usuario o contraseña incorrecto. Vuelve a intentarlo");
        }

        $cliente->getClienteByUsername($username);
        $rol = $cliente->rol;

        Session::put('user', $username);
        Session::put('rol', $rol);

        $result->message = "Inicio de sesión exitoso.";
        return $result;
        exit();
    }

    private function logout(Request $request)
    {
        $result = new \stdClass();
        $result->error = false;

        Session::flush();
        $result->message = "Sesión cerrada correctamente.";
        return $result;
    }
}
