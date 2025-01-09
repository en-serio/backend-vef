<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferPrecios extends Model
{
    protected $table = 'transfer_precios';
    protected $primaryKey = 'id_precios';
    protected $fillable = [
        'id_precios',
        'id_vehiculo',
        'id_hotel',
        'Precio',
    ];
    public $timestamps=false;
}