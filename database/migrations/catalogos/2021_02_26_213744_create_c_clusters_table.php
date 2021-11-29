<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCClustersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_clusters', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->timestamps();
            $table->foreignId('distrito_id')->references('id')->on('c_distritos'); 
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
        Schema::dropIfExists('c_clusters');
    }
}
