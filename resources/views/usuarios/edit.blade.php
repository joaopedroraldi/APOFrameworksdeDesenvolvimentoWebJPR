{{-- Tela de editar usuário. Os campos ficam no arquivo _formulario.blade.php. --}}
@extends('layouts.app')

@section('titulo', 'Editar usuário')

@section('conteudo')
    <div class="cabecalho-pagina">
        <h1><i class="fa fa-pencil"></i> Editar usuário</h1>
        <a href="{{ route('usuarios.index') }}" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="caixa">
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}" novalidate>
            @csrf
            {{-- Formulários HTML só aceitam GET e POST. O @method avisa o Laravel que é um PUT (atualizar). --}}
            @method('PUT')

            @include('usuarios._formulario')

            <hr>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Salvar alterações
            </button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
