{{-- Tela que mostra todos os dados de um livro. --}}
@extends('layouts.app')

@section('titulo', $livro->titulo)

@section('conteudo')
    <div class="row">
        {{-- Coluna da esquerda: os dados do livro. --}}
        <div class="col-md-8">
            <div class="caixa">
                <h4 class="titulo-secao"><i class="fa fa-book"></i> Identificação</h4>
                <dl class="dl-horizontal">
                    <dt>Autor</dt>
                    <dd>{{ $livro->autor }}</dd>
                    <dt>Editora</dt>
                    <dd>{{ $livro->editora ?: '-' }}</dd>
                    <dt>ISBN</dt>
                    <dd>{{ $livro->isbn }}</dd>
                </dl>

                <h4 class="titulo-secao"><i class="fa fa-info-circle"></i> Detalhes</h4>
                <dl class="dl-horizontal">
                    <dt>Gênero</dt>
                    <dd>{{ $livro->genero }}</dd>
                    <dt>Idioma</dt>
                    <dd>{{ $livro->idioma }}</dd>
                    <dt>Ano</dt>
                    <dd>{{ $livro->ano_publicacao ?: '-' }}</dd>
                    <dt>Edição</dt>
                    <dd>{{ $livro->edicao ? $livro->edicao.'ª edição' : '-' }}</dd>
                    <dt>Páginas</dt>
                    <dd>{{ $livro->numero_paginas ?: '-' }}</dd>
                </dl>

                <h4 class="titulo-secao"><i class="fa fa-align-left"></i> Sinopse</h4>
                {{-- O nl2br mantém as quebras de linha. O e() protege contra código malicioso. --}}
                <p>{!! $livro->sinopse ? nl2br(e($livro->sinopse)) : '<span class="text-muted">Sem sinopse.</span>' !!}</p>
            </div>
        </div>

        {{-- Coluna da direita: preço, estoque e situação em destaque. --}}
        <div class="col-md-4">
            <div class="caixa text-center">
                <p class="text-muted" style="margin: 0;">Preço</p>
                <p class="preco-destaque">{{ $livro->precoFormatado() }}</p>
                <p>
                    <span class="label label-primary">{{ $livro->formato }}</span>
                    @if ($livro->ativo)
                        <span class="label label-success">Ativo</span>
                    @else
                        <span class="label label-default">Inativo</span>
                    @endif
                </p>
                <hr>
                <p class="text-muted" style="margin: 0;">Estoque</p>
                @if ($livro->quantidade_estoque === 0)
                    <p class="estoque-destaque text-danger">Esgotado</p>
                @else
                    <p class="estoque-destaque">{{ $livro->quantidade_estoque }} {{ $livro->quantidade_estoque === 1 ? 'unidade' : 'unidades' }}</p>
                @endif
                <hr>
                <small class="text-muted">
                    Cadastrado em {{ $livro->created_at->format('d/m/Y H:i') }}<br>
                    Alterado em {{ $livro->updated_at->format('d/m/Y H:i') }}
                </small>
            </div>
        </div>
    </div>
@endsection
