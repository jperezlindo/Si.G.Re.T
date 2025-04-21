<?php

use Illuminate\Database\Seeder;

class diasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
        DB::table('dias')->insert(['name' => 'LUNES',   'activo' => 1]);
        DB::table('dias')->insert(['name' => 'MARTES',   'activo' => 1]);
        DB::table('dias')->insert(['name' => 'MIERCOLES',   'activo' => 1]);
        DB::table('dias')->insert(['name' => 'JUEVES',   'activo' => 1]);
        DB::table('dias')->insert(['name' => 'VIERNES',   'activo' => 1]);
        DB::table('dias')->insert(['name' => 'SABADO',   'activo' => 1]);
        DB::table('dias')->insert(['name' => 'DOMINGO',   'activo' => 1]);
    }
}
