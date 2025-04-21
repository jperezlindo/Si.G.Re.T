<?php

use Illuminate\Database\Seeder;

class turnos_diasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turnos_dias = [
            ['dia_id' => 1, 'turno_id' => 1, 'activo' => 1],
            ['dia_id' => 1, 'turno_id' => 2, 'activo' => 1],
            ['dia_id' => 1, 'turno_id' => 3, 'activo' => 1],

            ['dia_id' => 2, 'turno_id' => 1, 'activo' => 1],
            ['dia_id' => 2, 'turno_id' => 2, 'activo' => 1],
            ['dia_id' => 2, 'turno_id' => 3, 'activo' => 1],

            ['dia_id' => 3, 'turno_id' => 1, 'activo' => 1],
            ['dia_id' => 3, 'turno_id' => 2, 'activo' => 1],
            ['dia_id' => 3, 'turno_id' => 3, 'activo' => 1],

            ['dia_id' => 4, 'turno_id' => 1, 'activo' => 1],
            ['dia_id' => 4, 'turno_id' => 2, 'activo' => 1],
            ['dia_id' => 4, 'turno_id' => 3, 'activo' => 1],

            ['dia_id' => 5, 'turno_id' => 1, 'activo' => 1],
            ['dia_id' => 5, 'turno_id' => 2, 'activo' => 1],
            ['dia_id' => 5, 'turno_id' => 3, 'activo' => 1],

            ['dia_id' => 6, 'turno_id' => 2, 'activo' => 1],
            ['dia_id' => 6, 'turno_id' => 3, 'activo' => 1],

        ];
        

        foreach($turnos_dias as $td) {
            App\Turno_dia::create($td);
        }
    }
}
