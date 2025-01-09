<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferZona extends Model
{
    protected $table = 'transfer_zona';
    protected $primaryKey = 'id_zona';
    protected $fillable = [
        'id_zona',
        'descripcion'
    ];
    public $timestamps = false;
}
