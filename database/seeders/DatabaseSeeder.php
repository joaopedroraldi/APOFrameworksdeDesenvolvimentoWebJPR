<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Livro;
use Illuminate\Database\Seeder;

// Seeder principal. É ele que roda quando chamamos o "db:seed".
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Só cadastra os livros de exemplo se a tabela estiver vazia.
        // Assim, rodar de novo não cria livros repetidos.
        if (Livro::count() === 0) {
            $this->call(LivroSeeder::class);
        }

        // Mesma coisa para os clientes.
        if (Cliente::count() === 0) {
            $this->call(ClienteSeeder::class);
        }
    }
}
