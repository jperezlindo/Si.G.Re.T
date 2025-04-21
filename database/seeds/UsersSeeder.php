<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $password;

        DB::table('users')->insert([
       	'user'					=> 'xdeb',
        'dni' 					=> '34562157',
        'apellido' 				=> 'BENITEZ',
        'name' 					=> 'MARCO',
        'email' 				=> 'administrador@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1989-09-13",
        'direccion'          	=> 'agregar direccion',
        'categoria'             => 4,
        'password' 				=> $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token' 		=> str_random(10),
        'au'                    => 1,

        ]);

        DB::table('users')->insert([
        'user'                  => 'jap_86',
        'dni'                   => '11111111',
        'apellido'              => 'ENCARGADO',
        'name'                  => 'ENCAR GADO',
        'email'                 => 'encargado@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1989-09-13",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,

        ]);

        DB::table('users')->insert([
        'user'                  => 'mague_go',
        'dni'                   => '22222222',
        'apellido'              => 'MAGUERA',
        'name'                  => 'CRISTIAN',
        'email'                 => 'empleado@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1989-09-13",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'AUDITOR',
        'dni'                   => '34821623',
        'apellido'              => 'AUDITOR',
        'name'                  => 'AUDI TOR',
        'email'                 => 'auditor@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1989-09-13",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'jperezlindo',
        'dni'                   => '34821622',
        'apellido'              => 'PEREZLINDO',
        'name'                  => 'JOSE ARIEL',
        'email'                 => 'perzlindo@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1989-09-13",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'bignacio',
        'dni'                   => '36474527',
        'apellido'              => 'BELING',
        'name'                  => 'IGNACIO',
        'email'                 => 'ignaciobeling@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1993-04-16",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'fmauro',
        'dni'                   => '39225231',
        'apellido'              => 'FERNANDEZ',
        'name'                  => 'MAURO',
        'email'                 => 'maurodjchacorta@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'scaballero',
        'dni'                   => '33333333',
        'apellido'              => 'CABALLERO',
        'name'                  => 'SERGIO',
        'email'                 => 'scaballero@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'fyachezen',
        'dni'                   => '44444444',
        'apellido'              => 'YACHEZEN',
        'name'                  => 'FACUNDO',
        'email'                 => 'fyachezen@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'abergmeier',
        'dni'                   => '55555555',
        'apellido'              => 'BERGMEIER',
        'name'                  => 'ADRIAN',
        'email'                 => 'abergmeier@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'nplujartor',
        'dni'                   => '66666666',
        'apellido'              => 'PLUJATOR',
        'name'                  => 'NICOLAS',
        'email'                 => 'nplujartor@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'mcubilla',
        'dni'                   => '77777777',
        'apellido'              => 'CUBILLA',
        'name'                  => 'MAURO',
        'email'                 => 'mcubilla@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'alopez',
        'dni'                   => '88888888',
        'apellido'              => 'LOPEZ',
        'name'                  => 'ALEJANDRO',
        'email'                 => 'alopez@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'abarrios',
        'dni'                   => '99999999',
        'apellido'              => 'SEWALD',
        'name'                  => 'ALFREDO',
        'email'                 => 'abarrios@gmail.com',
        'sexo'                  => 'Femenino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'cvillalba',
        'dni'                   => '10101010',
        'apellido'              => 'VILLALBA',
        'name'                  => 'CARLOS',
        'email'                 => 'cvillalba@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'fcabrera',
        'dni'                   => '10101011',
        'apellido'              => 'CABRERA',
        'name'                  => 'FACUNDO',
        'email'                 => 'fcabrera@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'adutra',
        'dni'                   => '10101012',
        'apellido'              => 'DUTRA',
        'name'                  => 'ADRIAN',
        'email'                 => 'adutra@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);


        DB::table('users')->insert([
        'user'                  => 'pwagner',
        'dni'                   => '10101013',
        'apellido'              => 'WAGNER',
        'name'                  => 'PABLO',
        'email'                 => 'pwagner@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'cgalarza',
        'dni'                   => '10101014',
        'apellido'              => 'GALARZA',
        'name'                  => 'CRISTIAN',
        'email'                 => 'cgalarza@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'dmendoza',
        'dni'                   => '10101015',
        'apellido'              => 'MENDOZA',
        'name'                  => 'DARIO',
        'email'                 => 'dmendoza@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'jvenialgo',
        'dni'                   => '10101016',
        'apellido'              => 'VENIALGO',
        'name'                  => 'JONATAN',
        'email'                 => 'jvenialgo@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'cfereira',
        'dni'                   => '10101017',
        'apellido'              => 'FERREIRA',
        'name'                  => 'CESAR',
        'email'                 => 'cferreira@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'gvenialgo',
        'dni'                   => '10101018',
        'apellido'              => 'VENIALGO',
        'name'                  => 'GUSTAVO',
        'email'                 => 'gvenialgo@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

        DB::table('users')->insert([
        'user'                  => 'tapiani',
        'dni'                   => '10101019',
        'apellido'              => 'APIANI',
        'name'                  => 'TIAGO',
        'email'                 => 'tapiani@gmail.com',
        'sexo'                  => 'Masculino',
        'fecha_nacimiento'      => "1996-04-20",
        'direccion'             => 'agregar direccion',
        'categoria'             => 4,
        'password'              => $password ?: $password = bcrypt('123456'),
        'ciudad_id'             => 1,
        'remember_token'        => str_random(10),
        'au'                    => 1,
        ]);

    }
}
