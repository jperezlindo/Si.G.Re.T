<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_empresa', function (Blueprint $table) {

            $table->increments  ('id');   
            $table->boolean     ('activo')->default(true);
            
            $table->integer     ('user_id')->unsigned();
            $table->integer     ('empresa_id')->unsigned();
            $table->integer     ('rol_id')->unsigned();
            $table->integer     ('au')->unsigned();
            
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('empresa_id')->references('id')->on('empresas');           
            
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
        Schema::dropIfExists('user_empresa');
    }
}
