<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferZona extends Model
{
    use HasFactory;

    protected $table = 'transfer_zona';

    protected $primaryKey = 'id_zona';

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    public static function insertTransferZona($descripcion)
    {
        return self::create(['descripcion' => $descripcion]);
    }

    public static function selectTransferZona($idZona)
    {
        return self::find($idZona);
    }

    public static function getZonas()
    {
        return self::all();
    }

    public static function updateTransferZona($idZona, $descripcion)
    {
        $zona = self::find($idZona);
        if ($zona) {
            $zona->descripcion = $descripcion;
            $zona->save();
            return $zona;
        }
        return null;
    }

    public static function deleteTransferZona($idZona)
    {
        return self::destroy($idZona);
    }

    public static function checkZonaUsage($idZona)
    {
        $count = TranferHotel::where('id_zona', $idZona)->count();
        if ($count > 0) {
            return ['error' => true, 'message' => 'No se puede eliminar esta zona porque está siendo utilizada en un transfer.'];
        }
        return ['error' => false, 'message' => 'La zona no está siendo utilizada y puede eliminarse.'];
    }

    public static function getNombreZona($idZona)
    {
        $zona = self::find($idZona);
        return $zona ? $zona->descripcion : null;
    }

}
