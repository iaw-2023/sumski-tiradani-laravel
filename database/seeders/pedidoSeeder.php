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
        DB::table('pedido')->insert([
            'compra_id' => 1,
            'camiseta_id' => 1,
            'nombre_a_estampar' => 'Martin Palermo',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'L' 
        ]);
        DB::table('pedido')->insert([
            'compra_id' => 2,
            'camiseta_id' => 2,
            'nombre_a_estampar' => 'Marcelo Gallardo',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'S' 
        ]);
        DB::table('pedido')->insert([
            'compra_id' => 3,
            'camiseta_id' => 1,
            'nombre_a_estampar' => 'Nestor Ortigoza',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'XXL' 
        ]);
        DB::table('pedido')->insert([
            'compra_id' => 4,
            'camiseta_id' => 2,
            'nombre_a_estampar' => 'Ricardo Bochini',
            'numero_a_estampar' => '10',
            'talle_elegido' => 'M' 
        ]);
        DB::table('pedido')->insert([
            'compra_id' => 5,
            'camiseta_id' => 3,
            'nombre_a_estampar' => 'Lionel Messi',
            'numero_a_estampar' => '30',
            'talle_elegido' => 'M' 
        ]);
        DB::table('pedido')->insert([
            'compra_id' => 6,
            'camiseta_id' => 4,
            'nombre_a_estampar' => 'Karim Benzema',
            'numero_a_estampar' => '9',
            'talle_elegido' => 'L' 
        ]);
    }
}
