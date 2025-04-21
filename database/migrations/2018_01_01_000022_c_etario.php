<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CEtario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('c_etario', function (Blueprint $table) {

            $table->increments  ('id');
            $table->string      ('name', 15);
            $table->string      ('descripcion')->nullable();
            $table->boolean     ('activo')->default(true);
                    
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
        Schema::dropIfExists('c_etario');
    }
}
