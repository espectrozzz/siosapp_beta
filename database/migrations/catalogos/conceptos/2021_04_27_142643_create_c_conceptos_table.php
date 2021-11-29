<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_conceptos', function (Blueprint $table) {
            $table->id();
            $table->char('concepto',20);
            $table->text('descripcion');
            $table->foreignId('tconcepto_id')->references('id')->on('c_tipo_conceptos');
            $table->timestamps();
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
        Schema::dropIfExists('c_conceptos');
    }
}
