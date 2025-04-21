<?php

use Illuminate\Database\Seeder;

class User_EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_empresa')->insert(['user_id' => 1, 'empresa_id' => 1, 'rol_id' => 1, 'au' => 1]);
        DB::table('user_empresa')->insert(['user_id' => 2, 'empresa_id' => 1, 'rol_id' => 2, 'au' => 2]);
        DB::table('user_empresa')->insert(['user_id' => 3, 'empresa_id' => 1, 'rol_id' => 3, 'au' => 3]);
        DB::table('user_empresa')->insert(['user_id' => 4, 'empresa_id' => 1, 'rol_id' => 6, 'au' => 4]);
    	
        for ($i = 5; $i <25; $i++){
    		DB::table('user_empresa')->insert([
        		'user_id' 	 => $i,
        		'empresa_id' => 1,
                'rol_id'     => 4, // 4 rol cliente
                'au'         => $i,
        	]);
		}
    }
}
