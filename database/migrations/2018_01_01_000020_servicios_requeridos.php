<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiciosRequeridos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_requeridos', function (Blueprint $table) {

            $table->increments  ('id');
            $table->decimal     ('precio');
            $table->integer     ('cancha_servicio_id')->unsigned();
            $table->integer     ('detalle_reserva_id')->unsigned();


            $table->foreign('cancha_servicio_id')->references('id')->on('cancha_servicio');
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
        Schema::dropIfExists('servicios_requeridos');
    }
}
