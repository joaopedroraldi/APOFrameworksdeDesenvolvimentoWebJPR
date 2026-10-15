<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;

// Controller do CRUD de clientes (criar, listar, editar e excluir).
class ClienteController extends Controller
{
    // LISTAR: manda todos os clientes para a tela.
    // Quem cuida da busca, da ordem e das páginas é o DataTables, lá no navegador.
    public function index()
    {
        $clientes = Cliente::orderBy('nome')->get();

        return view('clientes.index', compact('clientes'));
    }

    // CRIAR (tela): mostra o formulário vazio.
    public function create()
    {
        // Manda um cliente "em branco" para o formulário.
        return view('clientes.create', ['cliente' => new Cliente]);
    }

    // CRIAR (salvar): recebe o formulário e grava no banco.
    // O ClienteRequest já validou tudo antes de chegar aqui.
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')
            ->with('sucesso', 'Cliente cadastrado com sucesso!');
    }

    // VER: mostra todos os dados de um cliente.
    // O Laravel já busca o cliente pelo id da URL sozinho (isso se chama Route Model Binding).
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    // EDITAR (tela): mostra o formulário já preenchido.
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // EDITAR (salvar): grava as alterações no banco.
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')
            ->with('sucesso', 'Cliente atualizado com sucesso!');
    }

    // EXCLUIR: apaga o cliente do banco.
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('sucesso', 'Cliente excluído com sucesso!');
    }
}
