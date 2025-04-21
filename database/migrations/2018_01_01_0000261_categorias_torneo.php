<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriasTorneo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('categorias_torneo', function (Blueprint $table) {

            $table->increments  ('id');
            $table->integer     ('n_ptes');
            $table->decimal     ('valor');
            $table->integer     ('cupo');
            $table->boolean     ('activo')->default(true);
            $table->string      ('descripcion')->nullable();
            $table->integer     ('winn')->default(0);

            $table->integer     ('campeon')->nullable();
            $table->integer     ('subcampeon')->nullable();
            $table->integer     ('semifinal')->nullable();
            $table->integer     ('cuartos')->nullable();
            $table->integer     ('octavos')->nullable();

            $table->integer     ('au')->unsigned()->nullable();    
            
            $table->integer     ('categoria_id')->unsigned();        
            $table->foreign     ('categoria_id')->references('id')->on('categorias');
            
            $table->integer     ('torneo_id')->unsigned();        
            $table->foreign     ('torneo_id')->references('id')->on('torneos');

                               
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
        Schema::dropIfExists('categorias_torneo');
    }
}
