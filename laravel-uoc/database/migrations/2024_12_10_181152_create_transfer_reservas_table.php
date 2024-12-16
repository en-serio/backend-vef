<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferReservasTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('transfer_reservas')) {
            Schema::create('transfer_reservas', function (Blueprint $table) {
                $table->id('id_reserva'); // Clave primaria
                $table->string('localizador', 100);

                // Definir campos de clave foránea como unsignedBigInteger
                $table->unsignedBigInteger('id_hotel')->nullable();
                $table->unsignedBigInteger('id_tipo_reserva');
                $table->unsignedBigInteger('id_destino');
                $table->unsignedBigInteger('id_vehiculo');

                $table->string('email_cliente', 100);

                // Timestamps personalizados
                $table->timestamp('fecha_reserva')->nullable();
                $table->timestamp('fecha_modificacion')->nullable();

                $table->date('fecha_entrada')->nullable();
                $table->time('hora_entrada')->nullable();
                $table->string('numero_vuelo_entrada', 50)->nullable();
                $table->string('origen_vuelo_entrada', 50);
                $table->time('hora_vuelo_salida')->nullable();
                $table->date('fecha_vuelo_salida')->nullable();
                $table->integer('num_viajeros');
                $table->string('numero_vuelo_vuelta', 50)->nullable();
                $table->time('hora_recogida')->nullable();

                // Definir las claves foráneas manualmente
                $table->foreign('id_hotel')->references('id_hotel')->on('tranfer_hotel')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('id_tipo_reserva')->references('id_tipo_reserva')->on('transfer_tipo_reserva')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('id_destino')->references('id_zona')->on('transfer_zona')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('id_vehiculo')->references('id_vehiculo')->on('transfer_vehiculo')->onDelete('restrict')->onUpdate('cascade');

                // Índices (opcional)
                $table->index('email_cliente');
            });
        }
    }

    public function down()
{
   
    if (Schema::hasTable('transfer_reservas')) {
        Schema::table('transfer_reservas', function (Blueprint $table) {

            $table->dropForeign('transfer_reservas_ibfk_3'); 
            $table->dropForeign('transfer_reservas_ibfk_4'); 
        });
    }

    // Finalmente, eliminar la tabla transfer_reservas
    Schema::dropIfExists('transfer_reservas');
}

}
