<?php

use Illuminate\Database\Seeder;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
		{
		
		DB::table('ranking')
		->insert(['promedio' => '50.00',  'puntos' => '150', 'torneos_jugados' => '3', 'user_empresa_id' => 5, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '67.50',  'puntos' => '270', 'torneos_jugados' => '4', 'user_empresa_id' => 6, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '66.66',  'puntos' => '200', 'torneos_jugados' => '3', 'user_empresa_id' => 7, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '72.00',  'puntos' => '360', 'torneos_jugados' => '5', 'user_empresa_id' => 8, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '104.00', 'puntos' => '520', 'torneos_jugados' => '5', 'user_empresa_id' => 9, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '86.00',  'puntos' => '430', 'torneos_jugados' => '5', 'user_empresa_id' => 10, 'categoria' => 4]);
		DB::table('ranking')
		->insert(['promedio' => '35.00',  'puntos' => '70', 'torneos_jugados'  => '2', 'user_empresa_id' => 11, 'categoria' => 4]);
		DB::table('ranking')
		->insert(['promedio' => '56.66',  'puntos' => '170', 'torneos_jugados' => '3', 'user_empresa_id' => 12, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '125.00',  'puntos' => '125', 'torneos_jugados' => '1', 'user_empresa_id' => 17, 'categoria' => 4 ]);
		DB::table('ranking')
		->insert(['promedio' => '125.00',  'puntos' => '125', 'torneos_jugados' => '1', 'user_empresa_id' => 18, 'categoria' => 4 ]);
    }
}
