{{-- Lista de clientes, com busca e paginação. --}}
@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
    <div class="caixa">
        {{-- Campo de busca. Ele manda o texto pela URL (?busca=...). --}}
        <form method="GET" action="{{ route('clientes.index') }}" class="form-busca">
            <div class="input-group">
                <input type="text" name="busca" class="form-control" value="{{ $busca }}" placeholder="Buscar por nome, CPF, e-mail ou cidade">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    {{-- Botão para limpar a busca. Só aparece se tiver busca. --}}
                    @if ($busca !== '')
                        <a href="{{ route('clientes.index') }}" class="btn btn-default"><i class="fa fa-times"></i> Limpar</a>
                    @endif
                </span>
            </div>
        </form>

        {{-- Se não tem nenhum cliente, mostra um aviso no lugar da tabela. --}}
        @if ($clientes->isEmpty())
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Nenhum cliente encontrado.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th class="hidden-xs">Telefone</th>
                            <th class="hidden-xs">Cidade/UF</th>
                            <th class="text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Repete uma linha para cada cliente da página. --}}
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nome }}</td>
                                <td>{{ $cliente->cpf }}</td>
                                <td class="hidden-xs">{{ $cliente->telefone ?: '-' }}</td>
                                <td class="hidden-xs">
                                    {{ $cliente->cidade ? $cliente->cidade.'/'.$cliente->uf : '-' }}
                                </td>
                                <td class="text-right acoes">
                                    {{-- Botões de ver, editar e excluir. --}}
                                    @include('partials.botoes-acoes', ['rota' => 'clientes', 'registro' => $cliente])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Texto "Mostrando X a Y de Z" e os botões de página. --}}
            <div class="paginacao">
                <span class="text-muted">
                    Mostrando {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }} de {{ $clientes->total() }} clientes
                </span>
                {{ $clientes->links() }}
            </div>
        @endif
    </div>
@endsection
