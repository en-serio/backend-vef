<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferHotel extends Model
{
    protected $table = 'transfer_hotel';
    protected $primaryKey = 'id_tranfer_hotel';
    public $timestamps = false;

    protected $fillable = [
        'id_hotel',
        'id_zona',
        'Comision',
        'usuario',
        'nombre_hotel',
        'direccion_hotel',
    ];
}
