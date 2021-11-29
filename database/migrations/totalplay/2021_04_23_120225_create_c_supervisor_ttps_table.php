<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSupervisorTtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_supervisor_ttps', function (Blueprint $table) {
            $table->id();
            $table->text('Nombre');
            $table->foreignId('distrito_id')->references('id')->on('c_distritos');
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
        Schema::dropIfExists('c_supervisor_ttps');
    }
}
