<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_materiales', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
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
        Schema::dropIfExists('c_materiales');
    }
}
