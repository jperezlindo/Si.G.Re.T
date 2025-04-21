<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Auditorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {

            $table->increments  ('id');
            $table->integer     ('user_empresa');
            $table->string      ('tabla', 30);
            $table->string      ('accion',30);
            $table->text        ('new_data')->nullable();
            $table->text        ('old_data')->nullable();
            $table->dateTime    ('fecha_hora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditorias');
    }
}
