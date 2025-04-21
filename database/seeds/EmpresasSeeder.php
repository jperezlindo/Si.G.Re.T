<?php

use Illuminate\Database\Seeder;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
        	'name' 			=> 'Si.G.Re.T - GO',
        	'razon_social' 	=> 'Si.G.Re.T S.A',
        	'cuit' 			=> '30-34821622-9',
        	'ciudad_id'		=> 1,
            'email'         => 'sigret.go.paddel@gmail.com',
            'direccion'     => 'Av. Uruguay 555',
            'tel'           => '3743460892',
            'cel'           => '3743445563',
            'rubro'         => 'DEPORTES PADDEL'

        ]);
    }
}
