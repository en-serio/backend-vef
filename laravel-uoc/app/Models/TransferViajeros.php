<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferViajeros extends Model
{
    protected $table = 'transfer_viajeros';
    protected $primaryKey = 'id_viajero';
    protected $fillable = [
        'id_viajero',
        'nombre',
        'apellido1',
        'apellido2',
        'direccion',
        'codigoPostal',
        'ciudad',
        'pais',
        'email',
        'password',
        'telefono',
        'dni',
    ];
    public $timestamps = false;
}
