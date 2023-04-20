<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class camiseta_a_categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // 2 -> categoria Club
    // 3 -> categoria Argentina 
    // 9 -> categoria Boca
    // 10 -> categoria River
    public function run(): void
    {
        // Camiseta Boca
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 1,
            'categorias_id' => 2, //Categoria club
        ]);
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 1,
            'categorias_id' => 3,
        ]);
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 1,
            'categorias_id' => 9,
        ]);
        // Camiseta River
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 2,
            'categorias_id' => 2,
        ]);
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 2,
            'categorias_id' => 3,
        ]);
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 2,
            'categorias_id' => 10,
        ]);
        // Camiseta Seleccion Argentina
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 3,
            'categorias_id' => 1,
        ]);
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 3,
            'categorias_id' => 3,
        ]);
        // Camiseta Seleccion Alemania
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 4,
            'categorias_id' => 1,
        ]);
        DB::table('camisetas_a_categorias')->insert([
            'camisetas_id' => 4,
            'categorias_id' => 4,
        ]);
    }
}
