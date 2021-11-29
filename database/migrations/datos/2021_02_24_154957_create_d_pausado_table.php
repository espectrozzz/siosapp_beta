<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDPausadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_pausado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folio_id')->references('id')->on('d_analisis');
            $table->foreignId('justificacion_id')->references('id')->on('c_justificacion_pausas');
            $table->time('tiempo_muerto');
            $table->foreignId('estado_id')->references('id')->on('c_estados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_pausado');
    }
}
