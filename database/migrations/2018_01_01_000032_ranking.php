<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ranking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking', function (Blueprint $table) {

            $table->increments  ('id');
            $table->decimal     ('promedio')->nullable();
            $table->decimal     ('puntos')->nullable();
            $table->integer     ('torneos_jugados')->nullable();
            $table->boolean     ('activo')->default(true);
            $table->integer     ('categoria')->unsigned()->nullable();
            $table->integer     ('au')->unsigned()->nullable();
            
            $table->integer     ('user_empresa_id')->unsigned();
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
        Schema::dropIfExists('ranking');
    }
}
