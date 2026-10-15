<?php

namespace App\Http\Requests;

use App\Models\Livro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Form Request: aqui ficam as regras do formulário de livro.
// O Laravel confere tudo isso ANTES de chegar no controller.
class LivroRequest extends FormRequest
{
    // Quem pode usar este formulário. Como a rota já exige login, libera para todos.
    public function authorize(): bool
    {
        return true;
    }

    // Roda antes da validação para arrumar alguns dados.
    protected function prepareForValidation(): void
    {
        $this->merge([
            // Caixinha desmarcada não é enviada pelo navegador. Aqui ela vira true ou false.
            'ativo' => $this->boolean('ativo'),
            // Troca a vírgula do preço por ponto (ex: 49,90 vira 49.90).
            'preco' => str_replace(',', '.', (string) $this->input('preco')),
        ]);
    }

    // As regras de cada campo.
    public function rules(): array
    {
        // Na edição, pega o livro que está sendo editado (na criação fica vazio).
        $livro = $this->route('livro');

        return [
            'titulo' => ['required', 'string', 'max:255'],
            'subtitulo' => ['nullable', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:255'],
            'editora' => ['nullable', 'string', 'max:255'],
            // ISBN: só números, traços e a letra X. Não pode repetir (na edição ignora o próprio livro).
            'isbn' => ['required', 'regex:/^[0-9X-]{10,17}$/', Rule::unique('livros', 'isbn')->ignore($livro)],
            'ano_publicacao' => ['nullable', 'integer', 'between:1000,'.date('Y')],
            'edicao' => ['nullable', 'integer', 'between:1,999'],
            'numero_paginas' => ['nullable', 'integer', 'between:1,100000'],
            // Só aceita valores que estão nas listas do model Livro.
            'idioma' => ['required', Rule::in(Livro::IDIOMAS)],
            'genero' => ['required', Rule::in(Livro::GENEROS)],
            'formato' => ['required', Rule::in(Livro::FORMATOS)],
            'preco' => ['required', 'numeric', 'between:0,99999.99'],
            'quantidade_estoque' => ['required', 'integer', 'between:0,999999'],
            'sinopse' => ['nullable', 'string', 'max:5000'],
            'ativo' => ['boolean'],
        ];
    }

    // Mensagens personalizadas para alguns casos.
    public function messages(): array
    {
        return [
            'isbn.regex' => 'O ISBN deve ter de 10 a 17 caracteres, usando só números, traços e a letra X.',
        ];
    }

    // Nomes "bonitos" dos campos para as mensagens de erro.
    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'subtitulo' => 'subtítulo',
            'isbn' => 'ISBN',
            'ano_publicacao' => 'ano de publicação',
            'edicao' => 'edição',
            'numero_paginas' => 'número de páginas',
            'genero' => 'gênero',
            'preco' => 'preço',
            'quantidade_estoque' => 'quantidade em estoque',
        ];
    }
}
