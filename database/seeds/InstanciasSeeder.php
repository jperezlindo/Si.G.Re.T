<?php

use Illuminate\Database\Seeder;

class InstanciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instancias')->insert(['name' => 'FINAL',   			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'SEMIFINAL',   		'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'CUARTOS DE FINAL',  'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'OCTAVOS DE FINAL',  'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 1',  			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 2',  			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 3',  			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 4',  			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 5',  			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 6',  			'activo' => 1 ]);
        DB::table('instancias')->insert(['name' => 'RONDA 7',  			'activo' => 1 ]);
    }
}
