<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('transfer_vehiculo')) {
            Schema::create('transfer_vehiculo', function (Blueprint $table) {
                $table->id('id_vehiculo');
                $table->string('descripcion');
                $table->unsignedBigInteger('idCliente');
                $table->foreign('idCliente')->references('idCliente')->on('cliente')->onDelete('restrict')->onUpdate('restrict');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('transfer_vehiculo')) {
            Schema::table('transfer_vehiculo', function (Blueprint $table) {
                $table->dropForeign(['idCliente']);
            });
        }
        Schema::dropIfExists('transfer_vehiculo');
    }
};
