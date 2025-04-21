<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert(['c_categoria_id' => '1', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '2', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '3', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '4', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '5', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '6', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '7', 'c_etario_id' => '1', 'c_sexo_id' => '1']);
        
        DB::table('categorias')->insert(['c_categoria_id' => '1', 'c_etario_id' => '1', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '2', 'c_etario_id' => '1', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '3', 'c_etario_id' => '1', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '4', 'c_etario_id' => '1', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '5', 'c_etario_id' => '1', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '6', 'c_etario_id' => '1', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '7', 'c_etario_id' => '1', 'c_sexo_id' => '2']);

        DB::table('categorias')->insert(['c_categoria_id' => '1', 'c_etario_id' => '2', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '2', 'c_etario_id' => '2', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '3', 'c_etario_id' => '2', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '4', 'c_etario_id' => '2', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '5', 'c_etario_id' => '2', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '6', 'c_etario_id' => '2', 'c_sexo_id' => '1']);
        DB::table('categorias')->insert(['c_categoria_id' => '7', 'c_etario_id' => '2', 'c_sexo_id' => '1']);

        DB::table('categorias')->insert(['c_categoria_id' => '1', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '2', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '3', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '4', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '5', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '6', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
        DB::table('categorias')->insert(['c_categoria_id' => '7', 'c_etario_id' => '2', 'c_sexo_id' => '2']);
    }
}
