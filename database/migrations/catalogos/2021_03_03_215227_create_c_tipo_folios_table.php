<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCTipoFoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_tipo_folios', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->integer('time_max');
            $table->timestamps();
            $table->integer('campo_1');
            $table->foreignId('estado_id')->references('id')->on('c_estados');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_tipo_folios');
    }
}
