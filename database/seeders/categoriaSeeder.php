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
            'name' => 'Futbol Argentino'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Futbol Inglés'
        ]);
        DB::table('categoria')->insert([
            'name' => 'River'
        ]);
        DB::table('categoria')->insert([
            'name' => 'Boca'
        ]);
    }
}
