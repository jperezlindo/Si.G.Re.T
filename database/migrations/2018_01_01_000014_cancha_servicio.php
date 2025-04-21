<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CanchaServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancha_servicio', function (Blueprint $table) {

            $table->increments  ('id');
            $table->decimal     ('precio', 5, 2);
            $table->boolean     ('requerido');
            $table->boolean     ('xhr');
            $table->boolean     ('activo')->default(true);

            $table->integer     ('cancha_id')->unsigned();
            $table->integer     ('servicio_id')->unsigned();

            $table->foreign('cancha_id')->references('id')->on('canchas');
            $table->foreign('servicio_id')->references('id')->on('servicios');

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
        Schema::dropIfExists('cancha_servicio');
    }
}
