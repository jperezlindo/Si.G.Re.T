<?php

use Illuminate\Database\Seeder;

class User_Empresa_EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$e = 1;
        for ($i = 5; $i < 17; $i++){
    		DB::table('user_empresa_equipo')->insert([
        		'user_empresa_id' 	 => $i,
        		'equipo_id'  => $e,
                'activo'     => 1,
        	]);
    		$e++;
		}

        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 24, 'equipo_id'  => 14, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 23, 'equipo_id'  => 14, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 22, 'equipo_id'  => 15, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 21, 'equipo_id'  => 15, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 20, 'equipo_id'  => 16, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 19, 'equipo_id'  => 16, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 18, 'equipo_id'  => 17, 'activo'     => 1,]);
        DB::table('user_empresa_equipo')->insert(['user_empresa_id' => 17, 'equipo_id'  => 17, 'activo'     => 1,]);
    }
}
