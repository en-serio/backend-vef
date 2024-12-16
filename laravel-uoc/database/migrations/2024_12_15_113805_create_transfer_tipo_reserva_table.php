<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('transfer_tipo_reserva')) {
            Schema::create('transfer_tipo_reserva', function (Blueprint $table) {
                $table->id('id_tipo_reserva');
                $table->string('Descripción');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('transfer_tipo_reserva');
    }
};
