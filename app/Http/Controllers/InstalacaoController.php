<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Throwable;

// Controller que roda as migrations pelo navegador.
// Existe porque na hospedagem não temos terminal para digitar "php artisan migrate".
class InstalacaoController extends Controller
{
    // Abre quando acessamos /instalar?token=SENHA
    public function migrar(Request $request)
    {
        // Pega a senha da instalação que está no .env.
        $senhaCerta = (string) config('app.install_token');

        // Pega a senha que veio na URL.
        $senhaDigitada = (string) $request->query('token', '');

        // Se a senha estiver errada, finge que a página não existe.
        if ($senhaCerta === '' || ! hash_equals($senhaCerta, $senhaDigitada)) {
            abort(404);
        }

        try {
            // Roda as migrations, ou seja, cria as tabelas no banco.
            // O --force é obrigatório porque o sistema está no servidor de verdade.
            Artisan::call('migrate', ['--force' => true]);
            $resultado = Artisan::output();

            // Mostra a lista de migrations e se cada uma já foi rodada.
            Artisan::call('migrate:status');
            $resultado .= "\n".Artisan::output();
        } catch (Throwable $erro) {
            // Se der erro (ex: senha do banco errada), mostra a mensagem na tela.
            $resultado = 'ERRO: '.$erro->getMessage();
        }

        // Devolve o resultado como texto simples.
        return response($resultado)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
