<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model do Livro. É por ele que o Laravel lê e grava na tabela "livros".
class Livro extends Model
{
    // Permite criar livros falsos para teste (LivroFactory).
    use HasFactory;

    // Nome da tabela no banco.
    protected $table = 'livros';

    // Campos que podem ser preenchidos de uma vez pelo formulário.
    protected $fillable = [
        'titulo',
        'subtitulo',
        'autor',
        'editora',
        'isbn',
        'ano_publicacao',
        'edicao',
        'numero_paginas',
        'idioma',
        'genero',
        'formato',
        'preco',
        'quantidade_estoque',
        'sinopse',
        'ativo',
    ];

    // Lista de formatos que aparecem no formulário.
    public const FORMATOS = ['Capa comum', 'Capa dura', 'E-book'];

    // Lista de gêneros que aparecem no formulário.
    public const GENEROS = [
        'Romance',
        'Ficção científica',
        'Fantasia',
        'Suspense',
        'Terror',
        'Biografia',
        'Poesia',
        'Infantil',
        'Autoajuda',
        'História',
        'Tecnologia',
        'Clássico',
    ];

    // Lista de idiomas que aparecem no formulário.
    public const IDIOMAS = ['Português', 'Inglês', 'Espanhol', 'Francês', 'Outro'];

    // Diz para o Laravel o tipo de cada campo.
    protected function casts(): array
    {
        return [
            'preco' => 'decimal:2',            // Sempre com 2 casas decimais.
            'ativo' => 'boolean',              // Vira true ou false.
            'ano_publicacao' => 'integer',
            'edicao' => 'integer',
            'numero_paginas' => 'integer',
            'quantidade_estoque' => 'integer',
        ];
    }
}
