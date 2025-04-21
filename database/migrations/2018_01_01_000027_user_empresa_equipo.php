<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEmpresaEquipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_empresa_equipo', function (Blueprint $table) {

            $table->increments  ('id');
            $table->boolean     ('activo')->default(true);
            $table->integer     ('user_empresa_id')->unsigned();
            $table->integer     ('equipo_id')->unsigned();

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
        Schema::dropIfExists('user_empresa_equipo');
    }
}
