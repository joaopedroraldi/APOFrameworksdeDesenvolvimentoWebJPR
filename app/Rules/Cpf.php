<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

// Regra de validação que confere se o CPF é válido de verdade.
// Ela faz a mesma conta que a Receita Federal usa para gerar os 2 últimos dígitos.
class Cpf implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Precisa estar no formato 000.000.000-00.
        if (! preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', (string) $value)) {
            $fail('O CPF deve estar no formato 000.000.000-00.');

            return;
        }

        // Deixa só os números.
        $numeros = preg_replace('/\D/', '', $value);

        // CPF com todos os números iguais (ex: 111.111.111-11) não vale.
        if (preg_match('/^(\d)\1{10}$/', $numeros)) {
            $fail('O CPF informado é inválido.');

            return;
        }

        // Calcula os 2 dígitos finais e compara com os que foram digitados.
        for ($posicao = 9; $posicao < 11; $posicao++) {
            $soma = 0;
            for ($i = 0; $i < $posicao; $i++) {
                $soma += $numeros[$i] * (($posicao + 1) - $i);
            }
            $digito = ((10 * $soma) % 11) % 10;

            if ((int) $numeros[$posicao] !== $digito) {
                $fail('O CPF informado é inválido.');

                return;
            }
        }
    }
}
