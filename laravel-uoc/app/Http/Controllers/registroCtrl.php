<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Exception;

class registroCtrl extends Controller
{

    public function procesaPost(Request $request)
    {
        // Limpieza de POST
        $post = $this->cleanPost($request->all());

        // Respuesta inicial
        $result = new \stdClass();
        $result->error = false;
        $result->message = null;

        try {
            if ($post['action'] === 'registro') {
                // Recuperar variables
                $nombre = $post['nombre'];
                $user = $post['user'];
                $pass = $post['pass'];
                $email = $post['email'];
                $apellido1 = $post['apellido1'];
                $apellido2 = $post['apellido2'];
                $tel = $post['tel'];
                $rol = $post['rol'];

                // Validar que el usuario o email no existan
                $cliente = new Cliente();

                if ($cliente->userExists($user) || $cliente->emailExists($email)) {
                    throw new Exception("Email o nombre de usuario ya registrado.");
                }

                // Encriptar contraseña
                $passEncrypt = bcrypt($pass);

                // Insertar usuario
                $fechaSQL = now(); // Fecha actual en formato Laravel
                $dni = "-";
                $cliente->insertUser($user, $nombre, $apellido1, $apellido2, $rol, $email, $tel, $fechaSQL, $passEncrypt, $dni);

                $result->message = "Registro exitoso.";
            }
        } catch (Exception $e) {
            $result->error = true;
            $result->message = $e->getMessage();
        }

        // Retornar respuesta JSON
        return response()->json($result);
    }


    /*private function cleanPost($data)
    {
        return array_map('trim', $data);
    }*/
}
