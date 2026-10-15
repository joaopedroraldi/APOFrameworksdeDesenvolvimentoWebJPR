<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable;

// Controller que roda as migrations pelo navegador.
// Existe porque na hospedagem não temos terminal para digitar "php artisan migrate".
class InstalacaoController extends Controller
{
    // Abre quando acessamos /instalar?token=SENHA
    // Para cadastrar os dados de exemplo junto: /instalar?token=SENHA&exemplos=1
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
            $codigo = Artisan::call('migrate', ['--force' => true]);
            $resultado = Artisan::output();

            // REGRA: toda migration se apaga do servidor depois de rodar com sucesso.
            // O código 0 quer dizer que o "migrate" terminou sem erro.
            if ($codigo === 0) {
                $resultado .= "\n".$this->apagarMigrationsJaRodadas();
            }

            // Se a URL tiver "&exemplos=1", cadastra também os livros e clientes de exemplo.
            // Os seeders só cadastram se a tabela estiver vazia, então não repete dados.
            if ($request->boolean('exemplos')) {
                Artisan::call('db:seed', ['--force' => true]);
                $resultado .= "\n".Artisan::output();
            }
        } catch (Throwable $erro) {
            // Se der erro (ex: senha do banco errada), mostra a mensagem na tela.
            // Como deu erro, nenhum arquivo de migration é apagado.
            $resultado = 'ERRO: '.$erro->getMessage();
        }

        // Devolve o resultado como texto simples.
        return response($resultado)->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    // Apaga do servidor os arquivos de migration que já foram rodados no banco.
    // As cópias no computador e no GitHub continuam existindo.
    private function apagarMigrationsJaRodadas(): string
    {
        // A tabela "migrations" guarda o nome de todas as migrations que já rodaram.
        $jaRodaram = DB::table('migrations')->pluck('migration')->all();

        $apagadas = [];

        // Passa por cada arquivo da pasta database/migrations.
        foreach (File::glob(database_path('migrations/*.php')) as $arquivo) {
            // Nome do arquivo sem o ".php" (é assim que ele fica salvo na tabela).
            $nome = pathinfo($arquivo, PATHINFO_FILENAME);

            // Se já rodou, apaga o arquivo.
            if (in_array($nome, $jaRodaram, true) && File::delete($arquivo)) {
                $apagadas[] = '  '.basename($arquivo);
            }
        }

        if ($apagadas === []) {
            return 'Nenhum arquivo de migration para apagar.';
        }

        return "Arquivos de migration apagados do servidor:\n".implode("\n", $apagadas);
    }
}
