<?php

use Illuminate\Database\Seeder;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servicios')->insert(['name' => 'ALQUILER', 			'activo' => 1 , 'empresa_id' => 1 ]);
        DB::table('servicios')->insert(['name' => 'LUZ', 				'activo' => 1 , 'empresa_id' => 1 ]);
        DB::table('servicios')->insert(['name' => 'VESTUARIOS', 		'activo' => 1 , 'empresa_id' => 1 ]);
        DB::table('servicios')->insert(['name' => 'QUICHO/PARRILLA', 	'activo' => 1 , 'empresa_id' => 1 ]);
    }
}
