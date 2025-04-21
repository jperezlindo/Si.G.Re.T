<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string      ('name',30);
            $table->string      ('razon_social',40);
            $table->string      ('cuit',15);
            $table->string      ('tel',30)->nullable();
            $table->string      ('cel',30)->nullable();
            $table->string      ('email',30)->nullable();
            $table->string      ('direccion',100)->nullable();
            $table->string      ('rubro',30)->nullable();
            $table->string      ('logo')->nullable()->default('logo.png');
            $table->boolean     ('activo')->default(true);
            $table->integer     ('au')->nullable();

            $table->integer('ciudad_id')->unsigned();
            $table->foreign('ciudad_id')->references('id')->on('ciudades');
            
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
        Schema::dropIfExists('empresas');
    }
}
