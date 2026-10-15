{{-- Lista de livros usando o DataTables (busca, ordenação e páginas). --}}
@extends('layouts.app')

@section('titulo', 'Livros')

@section('conteudo')
    <div class="caixa caixa-lista">
        {{-- A classe "tabela-datatable" faz o DataTables ligar sozinho (veja o public/js/app.js). --}}
        {{-- O data-titulo e o data-icone viram o título que aparece no meio, em cima da tabela. --}}
        <table class="table table-striped table-hover tabela-datatable" style="width: 100%;" data-titulo="Livros" data-icone="fa-book">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Formato</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Situação</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Uma linha para cada livro. --}}
                @foreach ($livros as $livro)
                    <tr>
                        <td>
                            <strong>{{ $livro->titulo }}</strong>
                            @if ($livro->subtitulo)
                                <br><small class="text-muted">{{ $livro->subtitulo }}</small>
                            @endif
                        </td>
                        <td>{{ $livro->autor }}</td>
                        <td>{{ $livro->genero }}</td>
                        <td>{{ $livro->formato }}</td>
                        {{-- O data-order guarda o número puro, para o DataTables ordenar o preço certo. --}}
                        <td data-order="{{ $livro->preco }}">{{ $livro->precoFormatado() }}</td>
                        <td>
                            {{-- Estoque zerado aparece em vermelho. --}}
                            @if ($livro->quantidade_estoque === 0)
                                <span class="label label-danger">Esgotado</span>
                            @else
                                {{ $livro->quantidade_estoque }}
                            @endif
                        </td>
                        <td>
                            @if ($livro->ativo)
                                <span class="label label-success">Ativo</span>
                            @else
                                <span class="label label-default">Inativo</span>
                            @endif
                        </td>
                        <td class="text-right acoes">
                            @include('partials.botoes-acoes', ['rota' => 'livros', 'registro' => $livro, 'titulo' => $livro->titulo])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

