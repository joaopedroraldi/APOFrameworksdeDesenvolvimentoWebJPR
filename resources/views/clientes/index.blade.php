{{-- Lista de clientes usando o DataTables (busca, ordenação e páginas). --}}
@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
    <div class="caixa caixa-lista">
        {{-- A classe "tabela-datatable" faz o DataTables ligar sozinho (veja o public/js/app.js). --}}
        {{-- O data-titulo e o data-icone viram o título que aparece no meio, em cima da tabela. --}}
        <table class="table table-striped table-hover tabela-datatable" style="width: 100%;" data-titulo="Clientes" data-icone="fa-users">
            {{-- O "hidden-xs" esconde a coluna no celular e o "hidden-sm" no tablet. Os dados continuam no popup de "ver". --}}
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th class="hidden-xs">E-mail</th>
                    <th class="hidden-xs hidden-sm">Telefone</th>
                    <th class="hidden-xs">Cidade/UF</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Uma linha para cada cliente. --}}
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td class="sem-quebra">{{ $cliente->cpf }}</td>
                        <td class="hidden-xs">{{ $cliente->email ?: '-' }}</td>
                        <td class="hidden-xs hidden-sm">{{ $cliente->telefone ?: '-' }}</td>
                        <td class="hidden-xs">{{ $cliente->cidade ? $cliente->cidade.'/'.$cliente->uf : '-' }}</td>
                        <td class="text-right acoes">
                            {{-- Botões de ver, editar e excluir. --}}
                            @include('partials.botoes-acoes', ['rota' => 'clientes', 'registro' => $cliente, 'titulo' => $cliente->nome])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
