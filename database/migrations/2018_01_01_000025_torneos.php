<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Torneos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torneos', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string      ('name', 250)->unique();
            $table->date        ('f_desde');
            $table->date        ('f_hasta');
            $table->time        ('hora');
            $table->date        ('ini_ins');
            $table->date        ('fin_ins');

            
            $table->string      ('descripcion')->nullable();
            $table->boolean     ('activo')->default(false);
            $table->boolean     ('finalizado')->default(false);

            $table->integer     ('em')->nullable();

            $table->integer     ('tipo_torneo_id')->unsigned();        
            $table->foreign     ('tipo_torneo_id')->references('id')->on('tipos_torneo');
            
            $table->integer     ('user_empresa_id')->unsigned();        
            $table->foreign     ('user_empresa_id')->references('id')->on('user_empresa');

            $table->integer     ('au');       
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
        Schema::dropIfExists('torneos');
    }
}
