<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDCalcTiemposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_calc_tiempos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folio_id')->references('id')->on('d_analisis');
            $table->dateTime('asignacion_ios');
            $table->dateTime('llegada')->nullable();
            $table->dateTime('activacion')->nullable();
            $table->time('eta')->nullable();
            $table->time('sla')->nullable();
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
        Schema::dropIfExists('d_calc_tiempos');
    }
}
