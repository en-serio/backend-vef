<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranferHotel extends Model
{
    protected $table = 'tranfer_hotel';
    protected $primaryKey = 'id_tranfer_hotel';
    public $timestamps = false;

    // Campos permitidos
    protected $fillable = [
        'id_hotel',
        'id_zona',
        'Comision',
        'usuario',
        'idCliente',
        'nombre_hotel',
        'direccion_hotel',
    ];
    

    public static function insertHotel($idHotel, $idZona, $comision, $idCliente, $user, $direccionHotel, $nombreHotel)
    {
        $data = [
            'id_hotel' => $idHotel,
            'id_zona' => $idZona,
            'Comision' => $comision,
            'usuario' => $user,
            'idCliente' => $idCliente,
            'nombre_hotel' => $nombreHotel,
            'direccion_hotel' => $direccionHotel,
        ];

        $id = self::create($data)->id_tranfer_hotel;
        return $id ?: false;
    }


    public static function getHotel($id)
    {
        return self::where('id_hotel', $id)->first();
    }

    public function updateHotel()
    {
        return $this->update([
            'id_hotel' => $this->id_hotel,
            'id_zona' => $this->id_zona,
            'Comision' => $this->Comision,
            'usuario' => $this->usuario,
            'idCliente' => $this->idCliente,
            'nombre_hotel' => $this->nombre_hotel,
            'direccion_hotel' => $this->direccion_hotel,
        ]);
    }

  
    public static function deleteHotel($id)
    {
        return self::where('id_tranfer_hotel', $id)->delete();
    }
}

