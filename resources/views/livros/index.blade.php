{{-- Lista de livros usando o DataTables (busca, ordenação e páginas). --}}
@extends('layouts.app')

@section('titulo', 'Livros')

@section('conteudo')
    {{-- Título com o botão de novo livro. --}}
    <div class="cabecalho-pagina">
        <h1><i class="fa fa-book"></i> Livros</h1>
        <a href="{{ route('livros.create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Novo livro
        </a>
    </div>

    <div class="caixa" style="height: 597.75px; overflow: hidden;">
        {{-- A tabela tem o id "tabela-livros". É por ele que o DataTables encontra a tabela. --}}
        <table id="tabela-livros" class="table table-striped table-hover" style="width: 100%;">
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
                            @include('partials.botoes-acoes', ['rota' => 'livros', 'registro' => $livro])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

{{-- O @push coloca este JavaScript no fim da página (no @stack('scripts') do layout). --}}
@push('scripts')
    <script>
        $(function () {
            // Liga o DataTables na tabela de livros.
            // Os textos em português já foram configurados no public/js/app.js.
            $('#tabela-livros').DataTable({
                pageLength: 10,                          // 10 livros por página.
                lengthMenu: [5, 10, 25, 50, 100],        // Opções de "Mostrar X por página".
                order: [[0, 'asc']],                     // Começa ordenando pelo título (coluna 0).
                columnDefs: [
                    { orderable: false, searchable: false, targets: -1 } // A coluna "Ações" (a última) não ordena nem busca.
                ],
                autoWidth: false                         // Deixa o Bootstrap cuidar da largura das colunas.
            });
        });
    </script>
@endpush
