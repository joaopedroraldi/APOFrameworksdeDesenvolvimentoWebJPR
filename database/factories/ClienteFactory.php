<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

// Fábrica de clientes falsos, para testar o sistema com dados.
// O Faker em pt_BR gera nomes, CPFs e CEPs com cara de brasileiros.
class ClienteFactory extends Factory
{
    // Diz que esta fábrica cria objetos do model Cliente.
    protected $model = Cliente::class;

    // Como cada campo de um cliente falso deve ser preenchido.
    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName().' '.$this->faker->lastName().' '.$this->faker->lastName(),
            'cpf' => $this->faker->unique()->cpf(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->faker->cellphoneNumber(),
            'data_nascimento' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'cep' => $this->faker->postcode(),
            'endereco' => $this->faker->streetName(),
            'numero' => (string) $this->faker->buildingNumber(),
            'complemento' => $this->faker->randomElement([null, null, 'Apto 101', 'Apto 302', 'Casa 2', 'Bloco B', 'Fundos']),
            'bairro' => $this->faker->randomElement(['Centro', 'Jardim América', 'Vila Nova', 'São Cristóvão', 'Santa Felicidade', 'Boa Vista', 'Parque Industrial', 'Alto Alegre']),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr(),
            'observacoes' => $this->faker->optional(0.3)->sentence(),
        ];
    }
}
