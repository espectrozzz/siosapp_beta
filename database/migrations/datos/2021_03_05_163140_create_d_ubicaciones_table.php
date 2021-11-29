<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folio_id')->references('id')->on('d_analisis');
            $table->text('latitud');
            $table->text('longitud');
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
        Schema::dropIfExists('d_ubicaciones');
    }
}
