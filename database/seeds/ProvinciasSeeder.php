<?php

use Illuminate\Database\Seeder;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provincias')->insert(['name' => 'MISIONES',   'pais_id' => 1 ]);
        DB::table('provincias')->insert(['name' => 'CORRIENTES', 'pais_id' => 1 ]);
        DB::table('provincias')->insert(['name' => 'ENTRE RIOS', 'pais_id' => 1 ]);
    }
}


