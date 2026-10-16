<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration que cria a tabela "livros" no banco.
return new class extends Migration
{
    // up(): o que fazer quando a migration roda (criar a tabela).
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();                                              // Número único do livro (1, 2, 3...).
            $table->string('titulo');                                  // Título do livro.
            $table->string('subtitulo')->nullable();                   // Subtítulo. O nullable deixa ficar vazio.
            $table->string('autor');                                   // Nome do autor.
            $table->string('editora')->nullable();                     // Editora.
            $table->string('isbn', 17)->unique();                      // Código ISBN. O unique não deixa repetir.
            $table->unsignedSmallInteger('ano_publicacao')->nullable(); // Ano em que foi publicado.
            $table->unsignedSmallInteger('edicao')->nullable();        // Número da edição (1ª, 2ª...).
            $table->unsignedInteger('numero_paginas')->nullable();     // Quantidade de páginas.
            $table->string('idioma', 50)->default('Português');        // Idioma. Se não informar, fica "Português".
            $table->string('genero', 100);                             // Gênero (Romance, Ficção...).
            $table->string('formato', 30)->default('Capa comum');      // Capa comum, capa dura ou e-book.
            $table->decimal('preco', 10, 2);                           // Preço com 2 casas depois da vírgula.
            $table->unsignedInteger('quantidade_estoque')->default(0); // Quantos tem no estoque.
            $table->text('sinopse')->nullable();                       // Resumo da história (texto grande).
            $table->boolean('ativo')->default(true);                   // Se está à venda (sim ou não).
            $table->timestamps();                                      // Datas de criação e de alteração.
        });
    }

    // down(): o que fazer para desfazer a migration (apagar a tabela).
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
