<?php

use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('torneos')->insert([
        	'name' 		 		=> 'GRAN FANTASMA', 
        	'f_desde' 	 		=> '2018-12-01',
            'f_hasta'           => '2018-12-02',
        	'hora'				=> '08:00:00', 
        	'ini_ins'	 		=> '2018-11-25',
        	'fin_ins'	 		=> '2018-11-30',
        	'descripcion' 		=> 'Premios hasta el 4to puesto',
        	'tipo_torneo_id'    => 2,
            'activo'	 		=> 1, 
        	'user_empresa_id' 	=> 1,
        	'em'				=> 1,
            'au'                => 1,
         ]);

        DB::table('categorias_torneo')->insert([
            'n_ptes' => 1, 'valor' => 600.00, 'cupo' => 16, 'descripcion' => 'S/D', 'categoria_id' => 4, 'torneo_id' => 1,
            'campeon' => 120, 'subcampeon' => 75, 'semifinal' => 50, 'cuartos' => 0, 'octavos' => 0, 'au' => 1,
        ]);
        

        DB::table('torneos')->insert([
            'name'              => '2018 FINAL SIGRET', 
            'f_desde'           => '2018-12-04',
            'f_hasta'           => '2018-12-05',
            'hora'              => '10:00:00', 
            'ini_ins'           => '2018-12-01',
            'fin_ins'           => '2018-12-03',
            'descripcion'       => 'TODOS SUMAN',
            'tipo_torneo_id'    => 2,
            'activo'            => 1, 
            'user_empresa_id'   => 1,
            'em'                => 1,
            'au'                => 1,
         ]);

        DB::table('categorias_torneo')->insert([
            'n_ptes' => 2, 'valor' => 750.00, 'cupo' => 4, 'descripcion' => 'S/D', 'categoria_id' => 4, 'torneo_id' => 2,
            'campeon' => 125, 'subcampeon' => 75, 'semifinal' => 25, 'cuartos' => 0, 'octavos' => 0, 'au' => 1,
        ]);

        DB::table('torneos')->insert([
            'name'              => 'SIGRET CLASIFICACION', 
            'f_desde'           => '2018-11-29',
            'f_hasta'           => '2018-11-30',
            'hora'              => '10:00:00', 
            'ini_ins'           => '2018-11-25',
            'fin_ins'           => '2018-11-28',
            'descripcion'       => 'TODOS SUMAN',
            'tipo_torneo_id'    => 2,
            'activo'            => 1, 
            'user_empresa_id'   => 1,
            'em'                => 1,
            'au'                => 1,
         ]);

        DB::table('categorias_torneo')->insert([
            'n_ptes' => 1, 'valor' => 750.00, 'cupo' => 4, 'descripcion' => 'S/D', 'categoria_id' => 4, 'torneo_id' => 3,
            'campeon' => 125, 'subcampeon' => 75, 'semifinal' => 25, 'cuartos' => 0, 'octavos' => 0, 'au' => 1,
        ]);

    }
}
