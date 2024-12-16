<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\QueryException;


use Exception;


class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $primaryKey = 'idCliente';

    public $timestamps = true;  

    //nombres personalizados de la tabla
    const CREATED_AT = 'created';  
    const UPDATED_AT = 'updated';  

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'email',
        'telefono',
        'nombreUsuario',
        'password',
        'rol',
        'dni',
    ];

    public static function insertCliente($nombre, $apellido1, $apellido2, $email, $telefono, $nombreUsuario, $password, $rol, $dni)
    {
        try {

            $cliente = new Cliente(); 

            $cliente->nombre = $nombre;
            $cliente->apellido1 = $apellido1;
            $cliente->apellido2 = $apellido2;
            $cliente->email = $email;
            $cliente->telefono = $telefono;
            $cliente->nombreUsuario = $nombreUsuario;
            $cliente->password = bcrypt($password); 
            $cliente->rol = $rol;
            $cliente->dni = $dni;


            $cliente->save();

            return $cliente; 

        } catch (Exception $e) {

            return ['error al insertar' => $e->getMessage()];
        }
    }



    public function getCliente($id)
    {
        return self::find($id);
    }


    public function getClientesByRol($rol)
    {
        return self::where('rol', $rol)->get();
    }

    public function updateCliente()
    {
        $this->updated = now();
        return $this->save();
    }


    public function deleteCliente($id)
    {
        return self::destroy($id);
    }

    public function userExists($username)
    {
        return self::where('nombreUsuario', $username)->exists();
    }

    public function emailExists($email)
    {
        return self::where('email', $email)->exists();
    }

    public function verifyUser($username, $password)
    {
        $cliente = self::where('nombreUsuario', $username)->first();
        if ($cliente && Hash::check($password, $cliente->password)) {
            return true;
        }
        return false;
    }

    public function getClienteByUsername($username)
    {
        return self::where('nombreUsuario', $username)->first();
    }

     public function getClienteByEmail($email)
     {
         return self::where('email', $email)->first();
     }
}