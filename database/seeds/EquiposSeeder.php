<?php

use Illuminate\Database\Seeder;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipos')->insert(['name' => 'UNO', 	    'categoria_id' 	 => 4]);
        DB::table('equipos')->insert(['name' => 'DOS', 	    'categoria_id' 	 => 4]);
        DB::table('equipos')->insert(['name' => 'TRES', 	'categoria_id'	 => 4]);
        DB::table('equipos')->insert(['name' => 'CUATRO',   'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'CINCO',    'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'SEIS',     'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'SIETE',    'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'OCHO',     'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'NUEVE',    'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'DIEZ',     'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'ONCE',     'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'DOCE',     'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'TRECE',    'categoria_id'   => 4]);


        DB::table('equipos')->insert(['name' => 'TAVENI',  'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'FELGO',   'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'MEGA',    'categoria_id'   => 4]);
        DB::table('equipos')->insert(['name' => 'DUWA',    'categoria_id'   => 4]);

    }
}
