<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Partidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string      ('name', 150);
            $table->date        ('fecha')->nullable()->default('01-01-01');
            $table->string      ('cancha', 150)->default('CANCHA');
            $table->time        ('hr_ini')->nullable()->default(0);
            $table->time        ('hr_fin')->nullable()->default(0);
            $table->boolean     ('activo')->default(true);
            $table->integer     ('finalizado')->default(false);
            $table->integer     ('au');
            $table->integer     ('winn')->nullable()->default(0);

            $table->integer     ('instancia_id')->unsigned();
            $table->integer     ('categoria_torneo_id')->unsigned();

            $table->foreign('instancia_id')->references('id')->on('instancias');
            $table->foreign('categoria_torneo_id')->references('id')->on('categorias_torneo');
                               
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
        Schema::dropIfExists('partidos');
    }
}
