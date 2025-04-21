<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservasTorneo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas_torneo', function (Blueprint $table) {

            $table->increments  ('id');
            $table->boolean     ('activo')->default(true);
            $table->integer     ('torneo_id')->unsigned();
            $table->integer     ('detalle_reserva_id')->unsigned();
            
            $table->foreign('torneo_id')->references('id')->on('torneos');
            $table->foreign('detalle_reserva_id')->references('id')->on('detalles_reserva');

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
        Schema::dropIfExists('reservas_torneo');
    }
}
