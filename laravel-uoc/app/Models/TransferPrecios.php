<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransferPrecios extends Model
{
    protected $table = 'transfer_precios'; 
    protected $primaryKey = 'idPrecios'; 
    public $timestamps = false;

    protected $fillable = [
        'id_vehiculo',
        'id_hotel',
        'Precio',
    ];

    // Método para insertar un precio
    public static function insertPrecio($idHotel, $idVehiculo, $precioTotal)
    {
        $data = [
            'id_vehiculo' => $idVehiculo,
            'id_hotel' => $idHotel,
            'Precio' => $precioTotal,
        ];

        $precio = self::create($data);
        return $precio ? $precio->idPrecios : false;
    }

    // Método para obtener un precio específico por ID
    public static function getPrecios($idPrecios)
    {
        return self::where('idPrecios', $idPrecios)->first();
    }

    // Obtener todos los precios por usuario
    public static function getAllPreciosByUser($user)
    {
        $query = "
            SELECT 
                tp.id_hotel, 
                tp.id_vehiculo, 
                tp.Precio, 
                th.usuario, 
                c.idCliente, 
                c.email, 
                c.nombre, 
                c.apellido1, 
                tr.id_tipo_reserva,
                th.nombre_hotel AS nombre_hotel 
            FROM 
                transfer_precios tp
            INNER JOIN 
                tranfer_hotel th ON tp.id_hotel = th.id_hotel
            INNER JOIN 
                transfer_reservas tr ON tp.id_hotel = tr.id_hotel
            INNER JOIN 
                cliente c ON th.idCliente = c.idCliente
            WHERE 
                c.nombreUsuario = :user
        ";

        return DB::select($query, ['user' => $user]);
    }

    // Método para eliminar un precio
    public function deletePrecio()
    {
        return self::where('idPrecios', $this->idPrecios)->delete();
    }

    // Mapear datos manualmente (similar a mapaDB)
    public function mapaDB($data)
    {
        $this->idPrecios = $data['idPrecios'] ?? null;
        $this->idVehiculo = $data['id_vehiculo'] ?? null;
        $this->idHotel = $data['id_hotel'] ?? null;
        $this->precio = $data['Precio'] ?? null;
    }
}