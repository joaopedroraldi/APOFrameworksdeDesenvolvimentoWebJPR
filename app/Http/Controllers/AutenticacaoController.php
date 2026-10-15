<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controller que cuida do cadastro, login e logout dos usuários.
class AutenticacaoController extends Controller
{
    // Mostra a tela de login.
    public function formularioLogin()
    {
        return view('auth.login');
    }

    // Recebe o e-mail e a senha digitados e tenta fazer o login.
    public function entrar(Request $request)
    {
        // Confere se os campos foram preenchidos certo.
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Tenta logar. O "lembrar" deixa a pessoa logada mesmo fechando o navegador.
        if (! Auth::attempt($dados, $request->boolean('lembrar'))) {
            // Deu errado: volta para o login com a mensagem de erro e o e-mail já preenchido.
            return back()
                ->withErrors(['email' => __('auth.failed')])
                ->onlyInput('email');
        }

        // Deu certo: cria uma sessão nova, por segurança.
        $request->session()->regenerate();

        // Manda para a página que a pessoa queria abrir (ou para o início).
        return redirect()->intended('/');
    }

    // Mostra a tela de cadastro de usuário.
    public function formularioCadastro()
    {
        return view('auth.cadastro');
    }

    // Recebe os dados do formulário e cria o usuário.
    public function cadastrar(Request $request)
    {
        // Confere os campos.
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            // Pergunta de segurança: sem o RA certo, não dá para criar a conta.
            'ra' => ['required', function ($campo, $valor, $falhar) {
                // A resposta precisa ser EXATAMENTE o RA (só tira os espaços do começo e do fim).
                // Qualquer letra ou número a mais, ou a menos, é recusado.
                if (trim((string) $valor) !== (string) config('app.ra_cadastro')) {
                    $falhar('RA incorreto. Sem ele não é possível criar a conta.');
                }
            }],
        ], [
            'ra.required' => 'Responda qual é o RA do João Pedro Raldi.',
        ]);

        // O RA só serve para conferir, não é salvo no usuário.
        unset($dados['ra']);

        // Salva o usuário no banco. A senha é criptografada sozinha pelo model User.
        $usuario = User::create($dados);

        // Já deixa a pessoa logada depois de se cadastrar.
        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect('/')->with('sucesso', 'Cadastro feito com sucesso! Bem-vindo(a), '.$usuario->name.'!');
    }

    // Faz o logout (sair do sistema).
    public function sair(Request $request)
    {
        // Desloga o usuário.
        Auth::logout();

        // Apaga a sessão antiga e cria um token novo, por segurança.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Volta para a tela de login, sem mostrar mensagem.
        return redirect()->route('login');
    }
}
