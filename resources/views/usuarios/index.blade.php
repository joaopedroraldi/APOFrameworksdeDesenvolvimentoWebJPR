{{-- Lista de usuários usando o DataTables (busca, ordenação e páginas). --}}
@extends('layouts.app')

@section('titulo', 'Usuários')

@section('conteudo')
    <div class="caixa caixa-lista">
        {{-- A classe "tabela-datatable" faz o DataTables ligar sozinho (veja o public/js/app.js). --}}
        {{-- O data-titulo e o data-icone viram o título que aparece no meio, em cima da tabela. --}}
        <table class="table table-striped table-hover tabela-datatable" style="width: 100%;" data-titulo="Usuários" data-icone="fa-user-circle">
            {{-- O "hidden-xs" esconde a coluna no celular. --}}
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th class="hidden-xs">Cadastrado em</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Uma linha para cada usuário. --}}
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
                        {{-- O data-order guarda a data no formato ano-mês-dia, para o DataTables ordenar certo. --}}
                        <td class="hidden-xs" data-order="{{ $usuario->created_at->format('Y-m-d H:i:s') }}">{{ $usuario->created_at->format('d/m/Y') }}</td>
                        <td class="text-right acoes">
                            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-xs" title="Editar">
                                <i class="fa fa-pencil"></i>
                            </a>

                            {{-- Na linha do próprio usuário, o botão de excluir aparece apagado e sem função. --}}
                            @if ($usuario->id !== auth()->id())
                                <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" class="form-excluir">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="Excluir">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                {{-- O "disabled" do Bootstrap deixa o botão meio transparente e sem clique. --}}
                                <button type="button" class="btn btn-danger btn-xs" title="Você não pode excluir a sua própria conta" disabled>
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
