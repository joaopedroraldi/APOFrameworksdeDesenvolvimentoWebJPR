{{-- Tela de editar cliente. Os campos ficam no arquivo _formulario.blade.php. --}}
@extends('layouts.app')

@section('titulo', 'Editar cliente')

@section('conteudo')
    <div class="caixa">
        <form method="POST" action="{{ route('clientes.update', $cliente) }}" novalidate>
            @csrf
            {{-- Formulários HTML só aceitam GET e POST. O @method avisa o Laravel que é um PUT (atualizar). --}}
            @method('PUT')

            @include('clientes._formulario')

            <hr>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> Salvar alterações
            </button>
            <a href="{{ route('clientes.index') }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
