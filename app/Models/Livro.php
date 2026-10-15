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

    // Devolve o preço no formato brasileiro (ex: R$ 1.234,56).
    public function precoFormatado(): string
    {
        return 'R$ '.number_format((float) $this->preco, 2, ',', '.');
    }

    // Lista de dados que aparece no popup de "ver" (rótulo e valor).
    // Campo vazio aparece como "-".
    public function detalhes(): array
    {
        $dados = [
            ['Título', $this->titulo],
            ['Subtítulo', $this->subtitulo],
            ['Autor', $this->autor],
            ['Editora', $this->editora],
            ['ISBN', $this->isbn],
            ['Gênero', $this->genero],
            ['Idioma', $this->idioma],
            ['Ano', $this->ano_publicacao],
            ['Edição', $this->edicao ? $this->edicao.'ª edição' : null],
            ['Páginas', $this->numero_paginas],
            ['Formato', $this->formato],
            ['Preço', $this->precoFormatado()],
            ['Estoque', $this->quantidade_estoque === 0 ? 'Esgotado' : $this->quantidade_estoque],
            ['Situação', $this->ativo ? 'Ativo' : 'Inativo'],
            ['Sinopse', $this->sinopse],
            ['Cadastrado em', $this->created_at?->format('d/m/Y H:i')],
            ['Alterado em', $this->updated_at?->format('d/m/Y H:i')],
        ];

        // Troca os valores vazios por "-".
        return array_map(fn ($linha) => [$linha[0], filled($linha[1]) ? (string) $linha[1] : '-'], $dados);
    }

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
