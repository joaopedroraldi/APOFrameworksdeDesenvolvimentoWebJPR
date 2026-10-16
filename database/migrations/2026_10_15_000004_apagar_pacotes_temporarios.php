<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

// Migration que apaga do servidor os pacotes temporários já apagados no computador.
// Precisa existir porque o SFTP do VS Code envia os arquivos, mas não apaga os que saíram.
return new class extends Migration
{
    // Lista dos arquivos para apagar (o caminho começa na pasta do projeto).
    private array $arquivos = [
        'titulo.tar.gz',
        'ra.tar.gz',
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
