<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Illuminate\Http\Request;

// Controller da área de usuários (quem pode entrar no sistema).
class UsuarioController extends Controller
{
    // LISTAR: mostra os usuários, com busca e paginação.
    public function index(Request $request)
    {
        // Texto digitado no campo de busca (se tiver).
        $busca = trim((string) $request->query('busca', ''));

        $usuarios = User::query()
            // Se digitou algo, procura no nome ou no e-mail.
            ->when($busca !== '', function ($consulta) use ($busca) {
                $consulta->where(function ($q) use ($busca) {
                    $q->where('name', 'like', "%{$busca}%")
                        ->orWhere('email', 'like', "%{$busca}%");
                });
            })
            ->orderBy('name')       // Ordem alfabética.
            ->paginate(10)          // 10 usuários por página.
            ->withQueryString();    // Mantém a busca ao trocar de página.

        return view('usuarios.index', compact('usuarios', 'busca'));
    }

    // CRIAR (tela): mostra o formulário vazio.
    public function create()
    {
        return view('usuarios.create', ['usuario' => new User]);
    }

    // CRIAR (salvar): grava o novo usuário. A senha é criptografada sozinha pelo model User.
    public function store(UsuarioRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário cadastrado com sucesso!');
    }

    // EDITAR (tela): mostra o formulário já preenchido (menos a senha).
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    // EDITAR (salvar): grava as alterações.
    public function update(UsuarioRequest $request, User $usuario)
    {
        $dados = $request->validated();

        // Se a senha ficou vazia, tira ela dos dados para não apagar a senha atual.
        if (empty($dados['password'])) {
            unset($dados['password']);
        }

        $usuario->update($dados);

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário atualizado com sucesso!');
    }

    // EXCLUIR: apaga o usuário.
    public function destroy(User $usuario)
    {
        // Não deixa a pessoa excluir a própria conta (senão ela perde o acesso na hora).
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                ->with('erro', 'Você não pode excluir a sua própria conta.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário excluído com sucesso!');
    }
}
