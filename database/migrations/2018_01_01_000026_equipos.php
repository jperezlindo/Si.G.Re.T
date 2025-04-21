<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Equipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string      ('name', 150);
            $table->string      ('descripcion')->nullable();
            $table->boolean     ('activo')->default(true);
            $table->integer     ('categoria_id')->unsigned();

            $table->foreign('categoria_id')->references('id')->on('categorias');
                    
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
        Schema::dropIfExists('equipos');
    }
}
