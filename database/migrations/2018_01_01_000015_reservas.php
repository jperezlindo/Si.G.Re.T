<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {

            $table->increments  ('id');
            $table->boolean     ('fija');
            $table->string      ('dia', 10)->nullable();
            $table->decimal     ('total')->nullable();
            $table->boolean     ('activo')->default(true);
            $table->boolean     ('confirmada')->default(false);
            $table->boolean     ('finalizada')->default(false);
            $table->boolean     ('abonada')->default(false);
            $table->integer     ('au')->unsigned();
            
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
        Schema::dropIfExists('reservas');
    }
}
