<?php

namespace Database\Factories;

use App\Models\Livro;
use Database\Seeders\LivroSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

// Fábrica de livros falsos, para testar o sistema com dados.
class LivroFactory extends Factory
{
    // Diz que esta fábrica cria objetos do model Livro.
    protected $model = Livro::class;

    // Como cada campo de um livro falso deve ser preenchido.
    public function definition(): array
    {
        return [
            'titulo' => rtrim($this->faker->sentence(3), '.'),
            'subtitulo' => $this->faker->optional()->sentence(4),
            'autor' => $this->faker->name(),
            'editora' => $this->faker->randomElement(LivroSeeder::EDITORAS),
            'isbn' => $this->faker->unique()->isbn13(),
            'ano_publicacao' => $this->faker->numberBetween(1900, (int) date('Y')),
            'edicao' => $this->faker->numberBetween(1, 10),
            'numero_paginas' => $this->faker->numberBetween(80, 900),
            'idioma' => $this->faker->randomElement(Livro::IDIOMAS),
            'genero' => $this->faker->randomElement(Livro::GENEROS),
            'formato' => $this->faker->randomElement(Livro::FORMATOS),
            'preco' => $this->faker->randomFloat(2, 19.9, 199.9),
            'quantidade_estoque' => $this->faker->numberBetween(0, 50),
            'sinopse' => $this->faker->paragraph(),
            'ativo' => $this->faker->boolean(85),
        ];
    }
}
