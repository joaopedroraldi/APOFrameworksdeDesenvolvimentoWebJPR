<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Form Request: aqui ficam as regras do formulário de usuário.
class UsuarioRequest extends FormRequest
{
    // Quem pode usar este formulário. Como a rota já exige login, libera para todos.
    public function authorize(): bool
    {
        return true;
    }

    // As regras de cada campo.
    public function rules(): array
    {
        // Na edição, pega o usuário que está sendo editado (na criação fica vazio).
        $usuario = $this->route('usuario');

        return [
            'name' => ['required', 'string', 'max:255'],
            // O e-mail não pode repetir, mas na edição ignora o próprio usuário.
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario)],
            // Na criação a senha é obrigatória. Na edição pode deixar vazia para não trocar.
            'password' => [$usuario ? 'nullable' : 'required', 'string', 'min:8'],
        ];
    }

    // Nomes "bonitos" dos campos para as mensagens de erro.
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'e-mail',
            'password' => 'senha',
        ];
    }
}
