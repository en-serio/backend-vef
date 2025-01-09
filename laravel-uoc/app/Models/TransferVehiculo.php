<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferVehiculo extends Model
{
    protected $table = 'transfer_vehiculo';
    protected $primaryKey = 'id_vehiculo';
    protected $fillable = [
        'id_vehiculo',
        'Descripción',
        'email_conductor',
        'password',
        'plazas',
    ];
    public $timestamps = false;
}
