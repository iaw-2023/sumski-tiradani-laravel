<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class categoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria')->insert([
            'name' => 'Selecciones'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Clubes'
        ]);

        DB::table('categoria')->insert([
            'name' => 'Argentina'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Inglaterra'
        ]);
        DB::table('categoria')->insert([
            'name' => 'España'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Francia'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Alemania'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Colombia'
        ]);

        DB::table('categoria')->insert([
            'name' => 'Boca'
        ]);
        DB::table('categoria')->insert([
            'name' => 'River'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Barcelona'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Real Madrid'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Bayern Munchen'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Olimpo'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Villa Mitre'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Paris Saint-Germain'
        ]);
    }
}
