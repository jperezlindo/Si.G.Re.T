<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Canchas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canchas', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string      ('cod', 6)->unique();
            $table->string      ('name', 20);
            $table->string      ('tipo', 20);
            $table->string      ('ancho_cm', 4 )->nullable();
            $table->string      ('largo_cm', 4)->nullable();
            $table->text        ('descripcion')->nullable();
            $table->string      ('foto')->nullable()->default('cancha.png');
            $table->boolean     ('activo')->default(true);
            
            $table->integer     ('empresa_id')->unsigned();
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
        Schema::dropIfExists('canchas');
    }
}
