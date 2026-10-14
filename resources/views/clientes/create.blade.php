{{-- Tela de novo cliente. Os campos ficam no arquivo _formulario.blade.php. --}}
@extends('layouts.app')

@section('titulo', 'Novo cliente')

@section('conteudo')
    <div class="cabecalho-pagina">
        <h1><i class="fa fa-plus"></i> Novo cliente</h1>
        <a href="{{ route('clientes.index') }}" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="caixa">
        <form method="POST" action="{{ route('clientes.store') }}" novalidate>
            @csrf

            @include('clientes._formulario')

            <hr>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Salvar
            </button>
            <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
