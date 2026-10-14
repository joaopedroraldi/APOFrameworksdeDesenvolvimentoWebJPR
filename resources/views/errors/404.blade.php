{{-- Página que aparece quando o endereço não existe (erro 404). --}}
@extends('layouts.app')

@section('titulo', 'Página não encontrada')

@section('conteudo')
    <div class="caixa text-center">
        <h1><i class="fa fa-search"></i> Página não encontrada</h1>
        <p class="text-muted">O endereço que você tentou abrir não existe ou o registro foi excluído.</p>
        <a href="{{ url('/') }}" class="btn btn-primary"><i class="fa fa-home"></i> Voltar para o início</a>
    </div>
@endsection
