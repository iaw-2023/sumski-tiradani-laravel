<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class pedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pedidos')->insert([
            'compras_id' => 1,
            'camisetas_id' => 1,
            'nombre_a_estampar' => 'Martin Palermo',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'L' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 1,
            'camisetas_id' => 1,
            'nombre_a_estampar' => 'Juan Roman Riquelme',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'M' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 2,
            'camisetas_id' => 2,
            'nombre_a_estampar' => 'Marcelo Gallardo',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'S' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 3,
            'camisetas_id' => 1,
            'nombre_a_estampar' => 'Nestor Ortigoza',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'XXL' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 4,
            'camisetas_id' => 2,
            'nombre_a_estampar' => 'Ricardo Bochini',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'M' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 5,
            'camisetas_id' => 3,
            'nombre_a_estampar' => 'Lionel Messi',
            'numero_a_estampar' => '30',
            'talle_elegido' => 'M' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 6,
            'camisetas_id' => 4,
            'nombre_a_estampar' => 'Karim Benzema',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'L' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 7,
            'camisetas_id' => 4,
            'nombre_a_estampar' => 'Bukayo Saka',
            'numero_a_estampar' => '7',
            'talle_elegido' => 'M' 
        ]);
        DB::table('pedidos')->insert([
            'compras_id' => 7,
            'camisetas_id' => 1,
            'nombre_a_estampar' => 'Jack Grealish',
            'numero_a_estampar' => '66',
            'talle_elegido' => 'S' 
        ]);
    }
}
