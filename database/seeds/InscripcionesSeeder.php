<?php

use Illuminate\Database\Seeder;

class InscripcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$e = 1;
        for ($i = 5; $i < 13; $i++){
    		DB::table('inscripciones')->insert([
                'activo'              => 1,
                'categoria_torneo_id' => 1,
                'user_empresa_id'     => $i,
                'au'                  => $i,
                'equipo_id'           => $e,
        	]);
    		$e++;
		}

        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 2, 'user_empresa_id' => 24, 'au' => 24, 'equipo_id' => 14]);
        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 2, 'user_empresa_id' => 22, 'au' => 22, 'equipo_id' => 15]);
        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 2, 'user_empresa_id' => 20, 'au' => 20, 'equipo_id' => 16]);
        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 2, 'user_empresa_id' => 18, 'au' => 18, 'equipo_id' => 17]);

        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 3, 'user_empresa_id' => 5, 'au' => 5, 'equipo_id' => 1]);
        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 3, 'user_empresa_id' => 7, 'au' => 7, 'equipo_id' => 3]);
        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 3, 'user_empresa_id' => 9, 'au' => 9, 'equipo_id' => 5]);
        DB::table('inscripciones')
        ->insert(['activo' => 1,'categoria_torneo_id' => 3, 'user_empresa_id' => 11, 'au' => 11, 'equipo_id' => 7]);
    }
}
