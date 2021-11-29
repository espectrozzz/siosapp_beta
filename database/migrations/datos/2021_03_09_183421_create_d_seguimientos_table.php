<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folio_id')->references('id')->on('d_analisis');
            $table->text('observacion');
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
        Schema::dropIfExists('d_seguimientos');
    }
}
