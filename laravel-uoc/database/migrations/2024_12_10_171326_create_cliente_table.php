<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Cliente;


class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cliente')) {
            Schema::create('cliente', function (Blueprint $table) {
                $table->id('idCliente');
                $table->string('nombre');
                $table->string('apellido1');
                $table->string('apellido2');
                $table->string('email')->unique();
                $table->string('telefono');
                $table->timestamp('created')->nullable();
                $table->timestamp('updated')->nullable();
                $table->string('nombreUsuario')->unique();
                $table->string('password');
                $table->string('rol');
                $table->string('dni')->unique();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
    if (Schema::hasTable('tranfer_hotel')) {
        Schema::table('tranfer_hotel', function (Blueprint $table) {
            $table->dropForeign('FK_cliente');
        });
    }

    if (Schema::hasTable('transfer_reservas')) {
        Schema::table('transfer_reservas', function (Blueprint $table) {
            $table->dropForeign(['email_cliente']); 
        });
    }

    Schema::dropIfExists('cliente');
    }
}
