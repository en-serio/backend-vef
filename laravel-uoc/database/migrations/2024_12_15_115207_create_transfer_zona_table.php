<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('transfer_zona')) {
            Schema::create('transfer_zona', function (Blueprint $table) {
                $table->id('id_zona');
                $table->string('descripcion');
            });
        }
    }
    

    public function down()
    {
        Schema::dropIfExists('transfer_zona');
    }
};
