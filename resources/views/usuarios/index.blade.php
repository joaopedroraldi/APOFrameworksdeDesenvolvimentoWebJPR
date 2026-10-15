{{-- Lista de usuários, com busca e paginação. --}}
@extends('layouts.app')

@section('titulo', 'Usuários')

@section('conteudo')
    <div class="caixa">
        {{-- Campo de busca. Ele manda o texto pela URL (?busca=...). --}}
        <form method="GET" action="{{ route('usuarios.index') }}" class="form-busca">
            <div class="input-group">
                <input type="text" name="busca" class="form-control" value="{{ $busca }}" placeholder="Buscar por nome ou e-mail">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                    @if ($busca !== '')
                        <a href="{{ route('usuarios.index') }}" class="btn btn-default"><i class="fa fa-times"></i> Limpar</a>
                    @endif
                </span>
            </div>
        </form>

        @if ($usuarios->isEmpty())
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Nenhum usuário encontrado.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th class="hidden-xs">Cadastrado em</th>
                            <th class="text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>
                                    {{ $usuario->name }}
                                    {{-- Marca qual é o usuário que está logado agora. --}}
                                    @if ($usuario->id === auth()->id())
                                        <span class="label label-info">Você</span>
                                    @endif
                                </td>
                                <td>{{ $usuario->email }}</td>
                                <td class="hidden-xs">{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td class="text-right acoes">
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-xs" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    {{-- O botão de excluir não aparece na linha do próprio usuário. --}}
                                    @if ($usuario->id !== auth()->id())
                                        <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="form-excluir">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" title="Excluir">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="paginacao">
                <span class="text-muted">
                    Mostrando {{ $usuarios->firstItem() }} a {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuários
                </span>
                {{ $usuarios->links() }}
            </div>
        @endif
    </div>
@endsection
