<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(categoriaSeeder::class);
        $this->call(camisetaSeeder::class);
        $this->call(clienteSeeder::class);
        $this->call(pedidoSeeder::class);
        $this->call(compraSeeder::class);
    }
}
