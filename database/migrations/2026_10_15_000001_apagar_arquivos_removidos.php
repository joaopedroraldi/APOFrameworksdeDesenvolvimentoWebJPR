<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

// Migration que apaga do servidor os arquivos que já foram apagados no computador.
// Precisa existir porque o SFTP do VS Code envia os arquivos, mas não apaga os que saíram.
return new class extends Migration
{
    // Lista dos arquivos para apagar (o caminho começa na pasta do projeto).
    private array $arquivos = [
        // Views que não são mais usadas.
        'resources/views/welcome.blade.php',
        'resources/views/inicio.blade.php',

        // Pacotes temporários usados para enviar os arquivos durante o desenvolvimento.
        'apo-laravel.tar.gz',
        'manifest.tsv',
        'etapa2.tar.gz',
        'etapa3.tar.gz',
        'etapa4.tar.gz',
        'etapa5.tar.gz',
        'etapa6.tar.gz',
        'etapa7.tar.gz',
        'etapa8.tar.gz',
        'padroniza.tar.gz',
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
