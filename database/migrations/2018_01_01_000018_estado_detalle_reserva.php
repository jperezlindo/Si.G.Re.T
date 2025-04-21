<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadoDetalleReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_detalle_reserva', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string  ('comentario')->nullable();
            $table->integer ('estado_id')->unsigned();
            $table->integer ('detalle_reserva_id')->unsigned();
            
            $table->foreign ('estado_id')->references('id')->on('estados');
            $table->foreign ('detalle_reserva_id')->references('id')->on('detalles_reserva');

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
        Schema::dropIfExists('estado_detalle_reserva');
    }
}
