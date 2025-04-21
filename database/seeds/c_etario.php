<?php

use Illuminate\Database\Seeder;

class c_etario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_etario')->insert(['name' => 'SENIOR']);
        DB::table('c_etario')->insert(['name' => 'AMATEUR']);
        DB::table('c_etario')->insert(['name' => 'VETERANOS']);
    }
}
