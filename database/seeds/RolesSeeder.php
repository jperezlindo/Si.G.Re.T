<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'ADMINISTRADOR']);
        DB::table('roles')->insert(['name' => 'ENCARGADO']);
        DB::table('roles')->insert(['name' => 'EMPLEADO']);
        DB::table('roles')->insert(['name' => 'CLIENTE']);
        DB::table('roles')->insert(['name' => 'ORGANIZADOR']);
        DB::table('roles')->insert(['name' => 'AUDITOR']);
    }
}
