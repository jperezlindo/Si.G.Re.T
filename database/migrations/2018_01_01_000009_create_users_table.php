<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
           
            $table->increments  ('id');
            $table->string      ('user', 30)->unique();
            $table->string      ('dni',8)->unique()->nullable();
            $table->string      ('apellido',30)->nullable();
            $table->string      ('name', 30)->nullable();
            $table->date        ('fecha_nacimiento')->nullable();
            $table->string      ('email', 50)->unique();
            $table->string      ('cel', 30)->default('0000000000');
            $table->string      ('direccion',250)->nullable();
            $table->char        ('sexo', 10)->nullable();
            $table->string      ('password');
            $table->string      ('foto')->nullable()->default('avatar.png');
            $table->boolean     ('activo')->default(true);
            $table->integer     ('categoria')->nullable();
            $table->integer     ('au')->unsigned()->nullable();

            $table->integer('ciudad_id')->unsigned();
            $table->foreign('ciudad_id')->references('id')->on('ciudades');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
