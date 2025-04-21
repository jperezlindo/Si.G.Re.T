<?php

use Illuminate\Database\Seeder;

class Cancha_ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ccss = [
            ['precio' => '350', 'requerido' => true, 'xhr' => true,   'activo' => 1, 'cancha_id' => 1 , 'servicio_id' => 1],
            ['precio' =>  '50', 'requerido' => true, 'xhr' => true,   'activo' => 1, 'cancha_id' => 1 , 'servicio_id' => 2],
            ['precio' => '100', 'requerido' => false, 'xhr' => false, 'activo' => 1, 'cancha_id' => 1 , 'servicio_id' => 3],
            ['precio' => '60', 'requerido' => false, 'xhr' => true,   'activo' => 1, 'cancha_id' => 1 , 'servicio_id' => 4],
            
            ['precio' => '250', 'requerido' => true, 'xhr' => true,   'activo' => 1, 'cancha_id' => 2 , 'servicio_id' => 1],
            ['precio' =>  '50', 'requerido' => false, 'xhr' => true,  'activo' => 1, 'cancha_id' => 2 , 'servicio_id' => 2],
            ['precio' => '100', 'requerido' => false, 'xhr' => false, 'activo' => 1, 'cancha_id' => 2 , 'servicio_id' => 3],
			['precio' => '60', 'requerido' => false, 'xhr' => true,   'activo' => 1, 'cancha_id' => 2 , 'servicio_id' => 4],
        ];
        

        foreach($ccss as $cs) {
            App\Cancha_Servicio::create($cs);
        }
    }
}