{{-- Página que aparece quando o formulário ficou aberto tempo demais (erro 419). --}}
@extends('layouts.app')

@section('titulo', 'Sessão expirada')

@section('conteudo')
    <div class="caixa text-center">
        <h1><i class="fa fa-clock-o"></i> Sessão expirada</h1>
        <p class="text-muted">A página ficou aberta por muito tempo. Volte e tente de novo.</p>
        <a href="{{ url('/') }}" class="btn btn-primary"><i class="fa fa-home"></i> Voltar para o início</a>
    </div>
@endsection
