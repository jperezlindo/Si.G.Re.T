<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('categorias', function (Blueprint $table) {

            $table->increments  ('id');
            $table->boolean     ('activo')->default(true);          

            $table->integer     ('c_categoria_id')->unsigned();        
            $table->foreign     ('c_categoria_id')->references('id')->on('c_categoria');
            
            $table->integer     ('c_etario_id')->unsigned();        
            $table->foreign     ('c_etario_id')->references('id')->on('c_etario');
            
            $table->integer     ('c_sexo_id')->unsigned();        
            $table->foreign     ('c_sexo_id')->references('id')->on('c_sexo');      
            
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
        Schema::dropIfExists('categorias');
    }
}
