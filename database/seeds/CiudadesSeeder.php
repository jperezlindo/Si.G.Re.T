<?php

use Illuminate\Database\Seeder;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ciudades')->insert([
            'name'          => 'APOSTOLES',
            'cp'            => '3350',
            'provincia_id'  => 1,
        ]); 

        DB::table('ciudades')->insert([
            'name'          => 'EL DORADO',
            'cp'            => '3380',
            'provincia_id'  => 1,
        ]); 

        DB::table('ciudades')->insert([
            'name'          => 'JARDIN AMERICA',
            'cp'            => '3328',
            'provincia_id'  => 1,
        ]);
        
        DB::table('ciudades')->insert([
            'name'          => 'LEANDRO N. ALEM',
            'cp'            => '6032',
            'provincia_id'  => 1,
        ]);   

        DB::table('ciudades')->insert([
            'name'          => 'OBERA',
            'cp'            => '3365',
            'provincia_id'  => 1,
        ]); 

        DB::table('ciudades')->insert([
            'name'          => 'POSADAS',
            'cp'            => '3300',
            'provincia_id'  => 1,
        ]); 

        DB::table('ciudades')->insert([
            'name'          => 'PUERTO IGUAZU',
            'cp'            => '3370',
            'provincia_id'  => 1,
        ]); 
  
    }
}
