<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetallesReserva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_reserva', function (Blueprint $table) {

            $table->increments  ('id');
            $table->date        ('fecha_reservada');
            $table->integer     ('hr_reservada');
            $table->decimal     ('cant_hs');
            $table->decimal     ('monto');
            $table->boolean     ('activo')->default(true);
            $table->boolean     ('confirmada')->default(false);
            $table->integer     ('ca');
            $table->integer     ('au')->unsigned()->nullable();

            $table->integer     ('reserva_id')->unsigned();
            $table->foreign('reserva_id')->references('id')->on('reservas');
            
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
        Schema::dropIfExists('detalles_reserva');
    }
}