<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciaHasTfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencia_has_tfolios', function (Blueprint $table) {
            $table->foreignId('incidencia_id')->references('id')->on('c_incidencias');
            $table->foreignId('tfolio_id')->references('id')->on('c_tipo_folios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencia_has_tfolios');
    }
}
