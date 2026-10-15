{{-- Tela de novo livro. Os campos ficam no arquivo _formulario.blade.php. --}}
@extends('layouts.app')

@section('titulo', 'Novo livro')

@section('conteudo')
    <div class="cabecalho-pagina">
        <h1><i class="fa fa-plus"></i> Novo livro</h1>
        <a href="{{ route('livros.index') }}" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="caixa">
        <form method="POST" action="{{ route('livros.store') }}" novalidate>
            @csrf

            @include('livros._formulario')

            <hr>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Salvar
            </button>
            <a href="{{ route('livros.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
