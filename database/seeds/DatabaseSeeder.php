<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        $this->truncateTables([
            'reservas_torneo',
            'auditorias',
            'ranking',
            'detalle_partido',
            'partidos',
            'instancias',
            'inscripciones',
            'user_empresa_equipo',
            'equipos',
            'categorias_torneo',
            'torneos',
            'tipos_torneo',
            'categorias',
            'c_categoria',
            'c_etario',
            'c_sexo',
            'servicios_requeridos',
            'jugadores',
            'estado_detalle_reserva',
            'estados',
            'detalles_reserva',
            'reservas',
            'cancha_servicio',
            'servicios',
            'canchas',
            'user_empresa',
            'users',
            'turnos_dias', 
            'dias',
            'turnos',
            'empresas',
            'roles',
            'ciudades',
            'provincias',
            'paises',
        ]);

        $this->call(PaisesSeeder::class);
        $this->call(ProvinciasSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(EmpresasSeeder::class);
        $this->call(diasSeeder::class);
        $this->call(turnosSeeder::class);
        $this->call(turnos_diasSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(User_EmpresaSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(ServiciosSeeder::class);
        $this->call(CanchasSeeder::class);
        $this->call(Cancha_ServicioSeeder::class);
        $this->call(c_categorias::class);
        $this->call(c_etario::class);
        $this->call(c_sexo::class);        
        $this->call(CategoriasSeeder::class);
        $this->call(EquiposSeeder::class);
        $this->call(User_Empresa_EquipoSeeder::class);
        $this->call(Tipos_TorneoSeeder::class);
        $this->call(RankingSeeder::class);
        //$this->call(TorneoSeeder::class);
        //$this->call(InscripcionesSeeder::class);
        $this->call(InstanciasSeeder::class);
    }


    //metodo para eliminar las tablas en cada ejecucion del seeder
    protected function truncateTables(array $tables){

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
            foreach ($tables as $table) {
                DB::table($table)->truncate();
            }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
