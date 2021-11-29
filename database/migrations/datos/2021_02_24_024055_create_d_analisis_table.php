<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateDAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_analisis', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->foreignId('tfolio_id')->references('id')->on('c_tipo_folios');
            $table->foreignId('turno_id')->references('id')->on('c_turnos');
            $table->foreignId('distrito_id')->references('id')->on('c_distritos');
            $table->foreignId('cluster_id')->references('id')->on('c_clusters');
            $table->foreignId('falla_id')->references('id')->on('c_fallas');
            $table->foreignId('causa_id')->references('id')->on('c_causas');
            $table->string('OT')->nullable();
            $table->integer('clientes_afectados');
            $table->foreignId('despacho_id')->references('id')->on('c_despachos');
            $table->foreignId('supervisor_id')->references('id')->on('c_supervisors');
            $table->foreignId('tecnico_id')->references('id')->on('c_tecnicos');
            $table->foreignId('estatus_id')->references('id')->on('c_estatus');
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
        Schema::dropIfExists('d_analisis');
    }
}
