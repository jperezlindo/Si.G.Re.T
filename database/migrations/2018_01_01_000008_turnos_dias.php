<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurnosDias extends Migration
{
    public function up(){
        
        Schema::create('turnos_dias', function (Blueprint $table) {

            $table->increments  ('id');
            
            $table->integer     ('dia_id')->unsigned();
            $table->integer     ('turno_id')->unsigned();
            $table->boolean     ('activo')->unsigned();
        
            $table->foreign('dia_id')->references('id')->on('dias');
            $table->foreign('turno_id')->references('id')->on('turnos');

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
        Schema::dropIfExists('turnos_dias');
    }
}
