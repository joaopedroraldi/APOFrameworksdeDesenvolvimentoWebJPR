<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model do Cliente. É por ele que o Laravel lê e grava na tabela "clientes".
class Cliente extends Model
{
    // Permite criar clientes falsos para teste (ClienteFactory).
    use HasFactory;

    // Nome da tabela no banco.
    protected $table = 'clientes';

    // Campos que podem ser preenchidos de uma vez pelo formulário.
    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
        'data_nascimento',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'observacoes',
    ];

    // Lista dos estados para o campo UF do formulário.
    public const ESTADOS = [
        'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA',
        'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO',
    ];

    // Diz para o Laravel o tipo de cada campo.
    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date', // Vira uma data de verdade (dá para formatar como 31/12/2000).
        ];
    }
}
