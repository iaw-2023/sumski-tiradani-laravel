<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class compraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compra')->insert([
            'cliente_id' => 1,
            'precio_total' => 50000,
            'forma_de_pago' => 'Tarjeta Mastercard',
            'direccion_de_entrega' => 'Castelar 2051'
        ]);
        DB::table('compra')->insert([
            'cliente_id' => 2,
            'precio_total' => 500000,
            'forma_de_pago' => 'Tarjeta Visa',
            'direccion_de_entrega' => 'Alberdi 467'
        ]);
        DB::table('compra')->insert([
            'cliente_id' => 3,
            'precio_total' => 5000000,
            'forma_de_pago' => 'Efectivo',
            'direccion_de_entrega' => 'Castelar 2051'
        ]);
        DB::table('compra')->insert([
            'cliente_id' => 4,
            'precio_total' => 5000000,
            'forma_de_pago' => 'Transferencia bancaria',
            'direccion_de_entrega' => 'Brandsen 805'
        ]);
        DB::table('compra')->insert([
            'cliente_id' => 3,
            'precio_total' => 421.60,
            'forma_de_pago' => 'Transferencia bancaria',
            'direccion_de_entrega' => 'Antezana 247'
        ]);
        DB::table('compra')->insert([
            'cliente_id' => 2,
            'precio_total' => 123456,
            'forma_de_pago' => 'Transferencia bancaria',
            'direccion_de_entrega' => 'Avenida Figueroa Alcorta 7509'
        ]);
        DB::table('compra')->insert([
            'cliente_id' => 2,
            'precio_total' => 40739798,
            'forma_de_pago' => 'Efectivo',
            'direccion_de_entrega' => 'Parchappe y Falucho'
        ]);
    }
}