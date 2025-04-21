<?php

use Illuminate\Database\Seeder;

class CanchasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('canchas')->insert(['cod' => '0001', 'name' => 'PRINCIPAL', 'tipo' => 'PADDLE', 'ancho_cm' => '1000', 'largo_cm' => '2000', 
            'empresa_id' => 1]);
        DB::table('canchas')->insert(['cod' => '0002', 'name' => 'SECUNDARIA', 'tipo' => 'PADDLE', 'ancho_cm' => '1000', 'largo_cm' => '2000',
            'empresa_id' => 1]);
    }
}
