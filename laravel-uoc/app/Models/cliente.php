<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $primaryKey = 'idCliente';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'email',
        'telefono',
        'created',
        'updated',
        'nombreUsuario',
        'password',
        'rol',
        'dni',
    ];

    // Casts (para transformar tipos automáticamente)
    protected $casts = [
        'created' => 'datetime',
        'updated' => 'datetime',
    ];
}
