<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;

// Controller do CRUD de livros (criar, listar, editar e excluir).
class LivroController extends Controller
{
    // LISTAR: manda todos os livros para a tela.
    // Quem cuida da busca, da ordem e das páginas é o DataTables, lá no navegador.
    public function index()
    {
        $livros = Livro::orderBy('titulo')->get();

        return view('livros.index', compact('livros'));
    }

    // CRIAR (tela): mostra o formulário vazio.
    public function create()
    {
        // Livro "em branco" já com alguns valores padrão marcados.
        $livro = new Livro([
            'idioma' => 'Português',
            'formato' => 'Capa comum',
            'quantidade_estoque' => 0,
            'ativo' => true,
        ]);

        return view('livros.create', compact('livro'));
    }

    // CRIAR (salvar): recebe o formulário e grava no banco.
    // O LivroRequest já validou tudo antes de chegar aqui.
    public function store(LivroRequest $request)
    {
        Livro::create($request->validated());

        return redirect()->route('livros.index')
            ->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    // EDITAR (tela): mostra o formulário já preenchido.
    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    // EDITAR (salvar): grava as alterações no banco.
    public function update(LivroRequest $request, Livro $livro)
    {
        $livro->update($request->validated());

        return redirect()->route('livros.index')
            ->with('sucesso', 'Livro atualizado com sucesso!');
    }

    // EXCLUIR: apaga o livro do banco.
    public function destroy(Livro $livro)
    {
        $livro->delete();

        return redirect()->route('livros.index')
            ->with('sucesso', 'Livro excluído com sucesso!');
    }
}
