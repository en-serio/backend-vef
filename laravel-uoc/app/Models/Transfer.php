<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Exception;

use App\Models\TranferHotel;


class Transfer extends Model
{
    use HasFactory;

    protected $table = 'transfer_reservas';

    protected $primaryKey = 'id_reserva';

    public $timestamps = true;  

    //nombres personalizados de la tabla
    const CREATED_AT = 'fecha_reserva';  
    const UPDATED_AT = 'fecha_modificacion';  

    protected $fillable = [
        'localizador',
        'id_hotel',
        'id_tipo_reserva',
        'email_cliente',
        'id_destino',
        'fecha_entrada',
        'hora_entrada',
        'numero_vuelo_entrada',
        'origen_vuelo_entrada',
        'hora_vuelo_salida',
        'fecha_vuelo_salida',
        'num_viajeros',
        'id_vehiculo',
        'numero_vuelo_vuelta',
        'hora_recogida',

    ];

    // Relaciones
    public function hotel()
    {
        return $this->belongsTo(TranferHotel::class, 'id_hotel');
    }

    public function tipoReserva()
    {
        return $this->belongsTo(TransferTipoReserva::class, 'id_tipo_reserva');
    }

    public function vehiculo()
    {
        return $this->belongsTo(TransferVehiculo::class, 'id_vehiculo');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'email_cliente', 'email');
    }

    protected $dates = ['fecha_reserva', 'fecha_modificacion', 'fecha_entrada', 'fecha_vuelo_salida'];



    public static function insertTransfer($data)
    {
        return DB::table('transfer_reservas')->insertGetId($data);
    }

    // READ - Obtener un transfer por ID
    public static function getTransfer($idReserva)
    {
        return DB::table('transfer_reservas')
            ->where('id_reserva', $idReserva)
            ->first();
    }

    // UPDATE
    public static function updateTransfer($idReserva, $data)
    {
        return DB::table('transfer_reservas')
            ->where('id_reserva', $idReserva)
            ->update($data);
    }

    // DELETE
    public static function deleteTransfer($idReserva)
    {
        return DB::table('transfer_reservas')
            ->where('id_reserva', $idReserva)
            ->delete();
    }

    // OBTENER TRANSFERS POR CLIENTE
    public static function getTransferByIdCliente($idCliente)
    {
        return DB::table('transfer_reservas as tr')
            ->join('cliente as c', 'tr.email_cliente', '=', 'c.email')
            ->select('tr.*', 'c.idCliente', 'c.nombreUsuario', 'c.email')
            ->where('c.idCliente', $idCliente)
            ->get();
    }

    // TRANSFERS ACTIVOS
    public static function getAllTransfersActivos()
    {
        return DB::table('transfer_reservas')
            ->whereDate('fecha_entrada', '>=', now())
            ->orWhereDate('fecha_vuelo_salida', '>=', now())
            ->orderBy('email_cliente')
            ->get();
    }

    // TRANSFERS POR HOTEL ACTIVO
    public static function getAllTransfersActivosByIdHotel($idHoteles)
    {
        return DB::table('transfer_reservas')
            ->whereIn('id_hotel', $idHoteles)
            ->where(function ($query) {
                $query->whereDate('fecha_entrada', '>=', now())
                      ->orWhereDate('fecha_vuelo_salida', '>=', now());
            })
            ->orderBy('email_cliente')
            ->get();
    }

    // EDITAR TRANSFER
    public static function getTransferEdit($idReserva)
    {
        return DB::table('transfer_reservas as tr')
            ->join('cliente as c', 'tr.email_cliente', '=', 'c.email')
            ->join('tranfer_hotel as th', 'tr.id_hotel', '=', 'th.id_hotel')
            ->select(
                'tr.*', 
                'c.nombre', 'c.apellido1', 'c.apellido2', 'c.telefono', 'c.dni',
                'th.nombre_hotel', 'th.direccion_hotel'
            )
            ->where('tr.id_reserva', $idReserva)
            ->first();
    }

    // TRANSFERS POR HOTEL
    public static function getTransfersByHotelArray($idHotel)
    {
        return DB::table('transfer_reservas')
            ->where('id_hotel', $idHotel)
            ->orderBy('email_cliente')
            ->get();
    }

    // TRANSFERS POR HOTEL Y FECHAS
    public static function getTransfersByHotelFecha($idHotel, $fechaInicio, $fechaFin)
    {
        return DB::table('transfer_reservas')
            ->where('id_hotel', $idHotel)
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_entrada', [$fechaInicio, $fechaFin])
                      ->orWhereBetween('fecha_vuelo_salida', [$fechaInicio, $fechaFin]);
            })
            ->get();
    }
}