<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferPreciosTable extends Migration
{
    
    public function up()
    {
        if (!Schema::hasTable('tranfer_hotel')) 
        {
        Schema::create('transfer_precios', function (Blueprint $table) {
            $table->id('idPrecios'); 
            $table->unsignedBigInteger('id_vehiculo');
            $table->unsignedBigInteger('id_hotel');
            $table->decimal('Precio', 10, 2); 


            $table->foreign('id_vehiculo')->references('id_vehiculo')->on('transfer_vehiculo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_hotel')->references('id_hotel')->on('hoteles')->onDelete('restrict')->onUpdate('cascade');
        });
        }
    }


    public function down()
{
    
    if (Schema::hasTable('transfer_precios')) {
        Schema::table('transfer_precios', function (Blueprint $table) {
            $table->dropForeign(['id_hotel']); 
        });
    }

  
    if (Schema::hasTable('transfer_reservas')) {
        Schema::table('transfer_reservas', function (Blueprint $table) {
            $table->dropForeign(['id_hotel']); 
            $table->dropForeign(['id_destino']);
        });
    }

    Schema::dropIfExists('tranfer_hotel');
}

}