<?php

use Illuminate\Database\Seeder;

class Tipos_TorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_torneo')->insert(['cod' => 001, 'name' => 'TORNEO OPEN C/ CABEZA DE SERIE' ]);
        DB::table('tipos_torneo')->insert(['cod' => 002, 'name' => 'TORNEO OPEN S/ CABEZA DE SERIE' ]);

    }
}
