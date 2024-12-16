<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransferVehiculo extends Model
{

    protected $table = 'transfer_vehiculo';

    protected $fillable = ['descripcion', 'idCliente'];

    public $timestamps = false;

    protected $primaryKey = 'idVehiculo';
    protected $keyType = 'int';

    
    public function insertTransferVehiculo(string $descripcion, int $idCliente): ?int
    {
        $idVehiculo = DB::table($this->table)->insertGetId([
            'descripcion' => $descripcion,
            'idCliente' => $idCliente,
        ]);

        return $idVehiculo;
    }

    
    public function selectTransferVehiculo(int $idVehiculo): ?TransferVehiculo
    {
        return self::find($idVehiculo);
    }

    
    public function updateTransferVehiculo(int $idVehiculo, string $descripcion, int $idCliente): bool
    {
        return self::where('idVehiculo', $idVehiculo)->update([
            'descripcion' => $descripcion,
            'idCliente' => $idCliente,
        ]);
    }

   
    public function deleteTransferVehiculo(int $idVehiculo): bool
    {
        return self::where('idVehiculo', $idVehiculo)->delete();
    }
}
