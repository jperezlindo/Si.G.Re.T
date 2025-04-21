<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jugadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->increments  ('id');
            $table->boolean     ('confirmo')->default(false);
            $table->boolean     ('activo')->default(true);

            $table->integer     ('detalle_reserva_id')->unsigned();
            $table->integer     ('user_empresa_id')->unsigned();
            
            $table->foreign('detalle_reserva_id')->references('id')->on('detalles_reserva');
            $table->foreign('user_empresa_id')->references('id')->on('user_empresa');         
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
        Schema::dropIfExists('jugadores');
    }
}
