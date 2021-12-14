<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorHasTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_has_tecnicos', function (Blueprint $table) {
            $table->foreignId('supervisor_id')->references('c_supervisors')->on('id');
            $table->foreignId('tecnico_id')->references('c_tecnicos')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisor_has_tecnicos');
    }
}
