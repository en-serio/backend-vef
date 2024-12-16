<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('tranfer_hotel')) 
        {
        Schema::create('tranfer_hotel', function (Blueprint $table) {
            $table->id('id_tranfer_hotel');
            $table->unsignedBigInteger('id_hotel');
            $table->unsignedBigInteger('id_zona')->nullable();
            $table->integer('Comision')->nullable();
            $table->string('usuario', 100)->nullable();
            $table->unsignedBigInteger('idCliente')->nullable();
            $table->string('nombre_hotel', 100);
            $table->string('direccion_hotel', 255)->comment('nom');
    
            // Claves foráneas
            $table->foreign('id_zona')->references('id_zona')->on('transfer_zona')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('idCliente')->references('idCliente')->on('cliente')->onDelete('restrict')->onUpdate('restrict');
    
            // Índices
            $table->index('id_zona', 'FK_HOTEL_ZONA');
            $table->index('idCliente', 'FK_cliente');
            $table->index('usuario');
            $table->index('id_hotel');
        });
        }
    }

    
    public function down()
    {
        if (Schema::hasTable('tranfer_hotel')) {
            Schema::table('tranfer_hotel', function (Blueprint $table) {
                
                $table->dropForeign(['idCliente']); 
                $table->dropForeign(['id_zona']); 
            });
        }
    
        // Finalmente, eliminar la tabla
        Schema::dropIfExists('tranfer_hotel');
    }
    
};