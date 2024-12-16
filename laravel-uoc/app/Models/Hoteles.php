<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Exception;


class Hoteles extends Model
{
    use HasFactory;

    protected $table = 'hoteles';

    protected $primaryKey = 'id_hotel';

    public $timestamps = false;  



    protected $fillable = [
        'nombre_hotel',
        'direccion_hotel',
        'id_zona',
        'comision',
        'idCliente',
    ];


    public function insertHotel($idZona, $comision, $idCliente, $nombreHotel, $direccionHotel)
    {
        try
        {
            $hotel = new Hoteles();
            
            $hotel->id_zona = $idZona;
            $hotel->comision = $comision;
            $hotel->idCliente = $idCliente;
            $hotel->nombre_hotel = $nombreHotel;
            $hotel->direccion_hotel = $direccionHotel;
            
            if ($hotel->save()) {
                return $hotel->id_hotel;  
            }
    
        } catch (Exception $e) {
            return ['error al insertar' => $e->getMessage()];
        }
    
        return false;
    }

    public function getHotelArray(array $ids)
    {
        if (empty($ids)) {
            throw new Exception("El array de IDs está vacío.");
    }

        $hoteles = Hoteles::whereIn('id_hotel', $ids)->get();

        if ($hoteles) {
            return $hoteles;
        }

        return null;
    }

    public function getHotelString($id)
    {
        $hotel = Hoteles::find($id);

        if ($hotel) {
            return $hotel;
        }

        return null;
    }

    public function getHoteles()
    {
        $hoteles = Hoteles::orderBy('id_hotel')->get();

        return $hoteles;
        }

    public function updateHotel()
    {
        $hotel = Hoteles::find($this->idHotel);

        if ($hotel) {
            $hotel->id_zona = $this->idZona;
            $hotel->comision = $this->comision;
            $hotel->idCliente = $this->idCliente;
            $hotel->nombre_hotel = $this->nombreHotel;
            $hotel->direccion_hotel = $this->direccionHotel;

            return $hotel->save();
        }

        return false;
    }

    public function deleteHotel($id)
    {
        $hotel = Hoteles::find($id);

        if ($hotel) {
            return $hotel->delete();
        }

        return false;
    }

    public function getIdHotelByIdCliente($idCliente)
    {
        $hoteles = Hoteles::where('idCliente', $idCliente)->pluck('id_hotel');

        return $hoteles->toArray();
    }







}
