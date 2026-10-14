{{-- Página inicial. Usa o layout principal (layouts/app.blade.php). --}}
{{-- Mais para frente ela vira o dashboard com os indicadores. --}}
@extends('layouts.app')

@section('titulo', 'Início')

@section('conteudo')
    <div class="jumbotron">
        <h1><i class="fa fa-book"></i> {{ config('app.name') }}</h1>
        {{-- auth()->user() é o usuário que está logado agora. --}}
        <p>Olá, {{ auth()->user()->name }}! Use o menu acima para acessar os cadastros.</p>
    </div>
@endsection
