<?php

use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('estados')->insert(['name' => 'INCIADA', 'activo' => 1]);
                DB::table('estados')->insert(['name' => 'FINALIZADA', 'activo' => 1]);
                DB::table('estados')->insert(['name' => 'CANCELADA', 'activo' => 1]);
                DB::table('estados')->insert(['name' => 'ABONADA', 'activo' => 1]);
    }
    
}
