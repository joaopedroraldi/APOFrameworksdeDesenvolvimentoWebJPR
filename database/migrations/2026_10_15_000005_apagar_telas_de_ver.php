<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

// Migration que apaga do servidor as telas de "ver" de clientes e livros.
// Elas foram trocadas por um popup na própria lista e já saíram do computador.
return new class extends Migration
{
    // Lista dos arquivos para apagar (o caminho começa na pasta do projeto).
    private array $arquivos = [
        'resources/views/clientes/show.blade.php',
        'resources/views/livros/show.blade.php',
    ];

    // up(): apaga cada arquivo da lista. Se o arquivo não existir, só pula.
    public function up(): void
    {
        foreach ($this->arquivos as $arquivo) {
            File::delete(base_path($arquivo));
        }
    }

    // down(): não tem como desfazer, porque o arquivo apagado não volta.
    public function down(): void
    {
        //
    }
};
