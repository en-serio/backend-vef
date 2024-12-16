<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferTipoReserva extends Model
{
    use HasFactory;

    protected $table = 'transfer_tipo_reserva';

    protected $primaryKey = 'id_tipo_reserva';

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];


    public static function insertTransferTipoReserva()
    {
    $tiposReserva = [
        ['id_tipo_reserva' => 1, 'descripcion' => 'Ida'],
        ['id_tipo_reserva' => 2, 'descripcion' => 'Vuelta'],
        ['id_tipo_reserva' => 3, 'descripcion' => 'Ida y Vuelta']
    ];

    foreach ($tiposReserva as $tipo) 
    {
        self::firstOrCreate(['id_tipo_reserva' => $tipo['id_tipo_reserva']], ['descripcion' => $tipo['descripcion']]);
    }
    }

    public static function selectTransferTipoReserva($id)
    {
        return self::find($id);
    }

    public static function updateTransferTipoReserva($id, $descripcion)
    {
        $tipoReserva = self::find($id);
        if ($tipoReserva) {
            $tipoReserva->descripcion = $descripcion;
            $tipoReserva->save();
            return $tipoReserva;
        }
        return null;
    }

    public static function deleteTransferTipoReserva($id)
    {
        return self::destroy($id);
    }



}

