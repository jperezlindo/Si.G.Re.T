<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TiposTorneo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_torneo', function (Blueprint $table) {

            $table->increments  ('id');
            $table->integer     ('cod')->unsigned();
            $table->string      ('name',50)->nullable();
            $table->string      ('algoritmo_1')->nullable();
            $table->string      ('algoritmo_2')->nullable();
            $table->string      ('algoritmo_3')->nullable();
            $table->string      ('descripcion')->nullable();
            $table->boolean     ('activo')->default(true);
                               
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
        Schema::dropIfExists('tipos_torneo');
    }
}
