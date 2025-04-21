<?php

use Illuminate\Database\Seeder;

class c_sexo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_sexo')->insert(['name' => 'CABALLEROS']);
        DB::table('c_sexo')->insert(['name' => 'DAMAS']);
        DB::table('c_sexo')->insert(['name' => 'MIXTO']);
    }
}
