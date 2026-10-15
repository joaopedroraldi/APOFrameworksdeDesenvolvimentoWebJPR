{{-- Tela de novo usuário. Os campos ficam no arquivo _formulario.blade.php. --}}
@extends('layouts.app')

@section('titulo', 'Novo usuário')

@section('conteudo')
    <div class="caixa">
        <form method="POST" action="{{ route('usuarios.store') }}" novalidate>
            @csrf

            @include('usuarios._formulario')

            <hr>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Salvar
            </button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
