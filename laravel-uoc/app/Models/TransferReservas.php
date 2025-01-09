<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferReservas extends Model
{
    protected $table = 'transfer_reservas';
    protected $primaryKey = 'id_reserva';
    protected $fillable = [
        'id_reserva',
        'localizador',
        'id_hotel',
        'id_tipo_reserva',
        'email_cliente',
        'fecha_reserva',
        'fecha_modificacion',
        'id_destino',
        'fecha_entrada',
        'hora_entrada',
        'numero_vuelo_entrada',
        'origen_vuelo_entrada',
        'hora_vuelo_salida',
        'fecha_vuelo_salida',
        'num_viajeros',
        'id_vehiculo',
    ];
    public $timestamps = false;
}
