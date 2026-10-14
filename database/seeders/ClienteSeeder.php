<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

// Seeder que cadastra clientes de exemplo.
class ClienteSeeder extends Seeder
{
    // Roda o seeder.
    public function run(): void
    {
        // Cria 40 clientes falsos usando a ClienteFactory.
        Cliente::factory()->count(40)->create();
    }
}
