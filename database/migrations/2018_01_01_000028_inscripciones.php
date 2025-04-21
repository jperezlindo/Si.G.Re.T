<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inscripciones extends Migration
{
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {

            $table->increments  ('id');
            $table->boolean     ('activo')->default(true);
            $table->integer     ('categoria_torneo_id')->unsigned();
            $table->integer     ('user_empresa_id')->unsigned();
            $table->integer     ('equipo_id')->unsigned();
            $table->integer     ('au')->unsigned()->nullable();

            $table->foreign('categoria_torneo_id')->references('id')->on('categorias_torneo');
            $table->foreign('user_empresa_id')->references('id')->on('user_empresa');
            $table->foreign('equipo_id')->references('id')->on('equipos');
                    
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
        Schema::dropIfExists('inscripciones');
    }
}
