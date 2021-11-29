<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_distritos', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->foreignId('supervisor_id')->references('id')->on('c_supervisors');
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
        Schema::dropIfExists('c_distritos');
    }
}
