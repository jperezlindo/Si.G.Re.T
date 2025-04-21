<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetallePartido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_partido', function (Blueprint $table) {

            $table->increments  ('id');
            $table->boolean     ('activo')->default(true);
            $table->integer     ('set_01')->nullable();
            $table->integer     ('set_02')->nullable();
            $table->integer     ('set_03')->nullable();
            $table->string      ('comentario', 250)->nullable();
            $table->boolean     ('isWinn');
            $table->integer     ('au')->nullable();
            
            $table->integer     ('equipo_id')->unsigned();
            $table->integer     ('partido_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('partido_id')->references('id')->on('partidos');
                                
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
        Schema::dropIfExists('detalle_partido');
    }
}
