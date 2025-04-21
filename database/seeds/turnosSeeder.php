<?php

use Illuminate\Database\Seeder;

class turnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turnos = [
            ['name' => 'MAÑANA', 'hr_ini' => '8:00:00', 'hr_fin' => '12:00:00',   'activo' => 1, 'empresa_id' => 1],
            ['name' => 'TARDE', 'hr_ini' => '15:00:00', 'hr_fin' => '19:00:00',   'activo' => 1, 'empresa_id' => 1],
            ['name' => 'NOCHE', 'hr_ini' => '19:00:00', 'hr_fin' => '24:00:00',   'activo' => 1, 'empresa_id' => 1],
        ];
        

        foreach($turnos as $turno) {
            App\Turno::create($turno);
        }
    }
}
