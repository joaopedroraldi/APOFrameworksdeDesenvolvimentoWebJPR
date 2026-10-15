{{-- Lista de clientes usando o DataTables (busca, ordenação e páginas). --}}
@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
    <div class="caixa caixa-lista">
        {{-- A classe "tabela-datatable" faz o DataTables ligar sozinho (veja o public/js/app.js). --}}
        {{-- O data-titulo e o data-icone viram o título que aparece no meio, em cima da tabela. --}}
        <table class="table table-striped table-hover tabela-datatable" style="width: 100%;" data-titulo="Clientes" data-icone="fa-users">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Cidade/UF</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Uma linha para cada cliente. --}}
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->cpf }}</td>
                        <td>{{ $cliente->email ?: '-' }}</td>
                        <td>{{ $cliente->telefone ?: '-' }}</td>
                        <td>{{ $cliente->cidade ? $cliente->cidade.'/'.$cliente->uf : '-' }}</td>
                        <td class="text-right acoes">
                            {{-- Botões de ver, editar e excluir. --}}
                            @include('partials.botoes-acoes', ['rota' => 'clientes', 'registro' => $cliente])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
