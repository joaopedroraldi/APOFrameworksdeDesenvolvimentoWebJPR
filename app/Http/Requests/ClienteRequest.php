<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Form Request: aqui ficam as regras do formulário de cliente.
// O Laravel confere tudo isso ANTES de chegar no controller.
class ClienteRequest extends FormRequest
{
    // Quem pode usar este formulário. Como a rota já exige login, libera para todos.
    public function authorize(): bool
    {
        return true;
    }

    // As regras de cada campo.
    public function rules(): array
    {
        // Na edição, pega o cliente que está sendo editado (na criação fica vazio).
        $cliente = $this->route('cliente');

        return [
            'nome' => ['required', 'string', 'max:255'],
            // O CPF não pode repetir, mas na edição ignora o próprio cliente.
            'cpf' => ['required', new Cpf, Rule::unique('clientes', 'cpf')->ignore($cliente)],
            'email' => ['nullable', 'email', 'max:255'],
            'telefone' => ['nullable', 'regex:/^\(\d{2}\) \d{4,5}-\d{4}$/'],
            'data_nascimento' => ['nullable', 'date', 'before:today'],
            'cep' => ['nullable', 'regex:/^\d{5}-\d{3}$/'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:10'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:100'],
            'cidade' => ['nullable', 'string', 'max:100'],
            'uf' => ['nullable', Rule::in(Cliente::ESTADOS)],
            'observacoes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    // Mensagens personalizadas para alguns casos.
    public function messages(): array
    {
        return [
            'telefone.regex' => 'O telefone deve estar no formato (00) 00000-0000.',
            'cep.regex' => 'O CEP deve estar no formato 00000-000.',
            'data_nascimento.before' => 'A data de nascimento deve ser antes de hoje.',
        ];
    }

    // Nomes "bonitos" dos campos para as mensagens de erro.
    public function attributes(): array
    {
        return [
            'nome' => 'nome',
            'cpf' => 'CPF',
            'email' => 'e-mail',
            'telefone' => 'telefone',
            'data_nascimento' => 'data de nascimento',
            'cep' => 'CEP',
            'endereco' => 'endereço',
            'numero' => 'número',
            'uf' => 'UF',
            'observacoes' => 'observações',
        ];
    }
}
