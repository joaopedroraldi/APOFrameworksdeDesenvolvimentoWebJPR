<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // Monta um e-mail a partir do nome do cliente.
    // Exemplos: "João Pedro Raldi" vira joaopedroraldi@..., "Juliana Silva" vira juliana.silva@...
    // e "Jaison Hell" pode virar hell.jaison@...
    public static function gerarEmail(string $nome, string $dominio): string
    {
        // Tira os acentos, deixa tudo minúsculo e mantém só letras, números e espaços.
        $limpo = preg_replace('/[^a-z0-9 ]/', '', Str::lower(Str::ascii($nome)));

        // Palavras que não entram no e-mail:
        // as que ligam o nome (da, de, do...), os tratamentos (sr, dra...) e os finais (neto, filho...).
        $ignorar = [
            'da', 'de', 'do', 'dos', 'das', 'e',
            'sr', 'sra', 'srta', 'dr', 'dra', 'prof', 'profa',
            'neto', 'neta', 'filho', 'filha', 'junior', 'jr', 'sobrinho', 'sobrinha', 'segundo', 'terceiro',
            '',
        ];

        // Separa o nome em palavras e tira as da lista acima.
        $palavras = array_values(array_diff(preg_split('/\s+/', trim($limpo)), $ignorar));

        if ($palavras === []) {
            $palavras = ['cliente'];
        }

        $primeiro = $palavras[0];
        $ultimo = end($palavras);

        // Sorteia um dos 3 formatos.
        $usuario = match (random_int(1, 3)) {
            1 => implode('', $palavras),   // tudo junto: joaopedroraldi
            2 => $primeiro.'.'.$ultimo,    // nome.sobrenome: juliana.silva
            3 => $ultimo.'.'.$primeiro,    // sobrenome.nome: hell.jaison
        };

        // Às vezes (4 em cada 10) coloca um número de 65 a 99 no final, antes do @.
        if (random_int(1, 10) <= 4) {
            $usuario .= random_int(65, 99);
        }

        return $usuario.'@'.$dominio;
    }

    // Diz para o Laravel o tipo de cada campo.
    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date', // Vira uma data de verdade (dá para formatar como 31/12/2000).
        ];
    }
}
