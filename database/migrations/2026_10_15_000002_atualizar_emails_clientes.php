<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// Migration que troca o final (domínio) do e-mail dos clientes.
// A parte antes do @ continua igual. Só muda o que vem depois.
// Exemplo: joao.silva@example.com vira joao.silva@gmail.com
return new class extends Migration
{
    // Domínios usados. Os clientes vão recebendo um de cada vez, em rodízio.
    private array $dominios = ['gmail.com', 'hotmail.com', 'terra.com.br'];

    public function up(): void
    {
        // Pega só os clientes que têm e-mail.
        $clientes = DB::table('clientes')->whereNotNull('email')->orderBy('id')->get(['id', 'email']);

        foreach ($clientes as $posicao => $cliente) {
            // Parte antes do @ (ex: "joao.silva").
            $usuario = strstr($cliente->email, '@', true) ?: $cliente->email;

            // Escolhe o domínio pelo rodízio: 1º gmail, 2º hotmail, 3º terra, 4º gmail...
            $dominio = $this->dominios[$posicao % count($this->dominios)];

            DB::table('clientes')->where('id', $cliente->id)->update([
                'email' => $usuario.'@'.$dominio,
            ]);
        }
    }

    // down(): não tem como voltar, porque o domínio antigo de cada cliente não fica guardado.
    public function down(): void
    {
        //
    }
};
