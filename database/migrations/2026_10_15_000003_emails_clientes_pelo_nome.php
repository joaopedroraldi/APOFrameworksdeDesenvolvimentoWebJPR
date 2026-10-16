<?php

use App\Models\Cliente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// Migration que troca o e-mail de cada cliente por um e-mail feito a partir do nome dele.
// O domínio (o que vem depois do @) continua o mesmo.
// Exemplo: "Juliana Silva" com x@gmail.com vira juliana.silva@gmail.com
return new class extends Migration
{
    public function up(): void
    {
        // Pega só os clientes que têm e-mail.
        $clientes = DB::table('clientes')->whereNotNull('email')->orderBy('id')->get(['id', 'nome', 'email']);

        // Guarda os e-mails já usados, para não repetir.
        $usados = [];

        foreach ($clientes as $cliente) {
            // Domínio atual do cliente (ex: "gmail.com").
            $dominio = substr(strrchr($cliente->email, '@'), 1) ?: 'gmail.com';

            // Gera o e-mail novo. Se repetir, gera de novo (até 20 tentativas).
            $tentativas = 0;
            do {
                $email = Cliente::gerarEmail($cliente->nome, $dominio);
                $tentativas++;
            } while (isset($usados[$email]) && $tentativas < 20);

            // Se mesmo assim repetiu, coloca o número do cliente no final para ficar único.
            if (isset($usados[$email])) {
                $email = str_replace('@', $cliente->id.'@', $email);
            }

            $usados[$email] = true;

            DB::table('clientes')->where('id', $cliente->id)->update(['email' => $email]);
        }
    }

    // down(): não tem como voltar, porque o e-mail antigo não fica guardado.
    public function down(): void
    {
        //
    }
};
