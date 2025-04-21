<?php

use Illuminate\Database\Seeder;

class c_categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_categoria')->insert(['name' => 'PRIMERA']);
        DB::table('c_categoria')->insert(['name' => 'SEGUNDA']);
        DB::table('c_categoria')->insert(['name' => 'TERCERA']);
        DB::table('c_categoria')->insert(['name' => 'CUARTA' ]);
        DB::table('c_categoria')->insert(['name' => 'QUINTA' ]);
        DB::table('c_categoria')->insert(['name' => 'SEXTA'  ]);
        DB::table('c_categoria')->insert(['name' => 'SEPTIMA']);
    }
}
