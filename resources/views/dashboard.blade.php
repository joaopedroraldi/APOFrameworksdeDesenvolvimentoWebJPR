{{-- Dashboard: a página inicial com os indicadores do sistema. --}}
@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('conteudo')
    <div class="cabecalho-pagina">
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        {{-- auth()->user() é o usuário que está logado agora. --}}
        <span class="text-muted">Olá, {{ auth()->user()->name }}!</span>
    </div>

    <div class="row">
        {{-- Card com a quantidade de clientes. --}}
        <div class="col-sm-4">
            <div class="card-indicador card-clientes">
                <div class="card-indicador-icone"><i class="fa fa-users"></i></div>
                <div class="card-indicador-texto">
                    <span class="card-indicador-numero">{{ $totalClientes }}</span>
                    <span class="card-indicador-titulo">{{ $totalClientes === 1 ? 'Cliente cadastrado' : 'Clientes cadastrados' }}</span>
                </div>
                <a href="{{ route('clientes.index') }}" class="card-indicador-link">
                    Ver clientes <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card com a quantidade de livros. --}}
        <div class="col-sm-4">
            <div class="card-indicador card-livros">
                <div class="card-indicador-icone"><i class="fa fa-book"></i></div>
                <div class="card-indicador-texto">
                    <span class="card-indicador-numero">{{ $totalLivros }}</span>
                    <span class="card-indicador-titulo">{{ $totalLivros === 1 ? 'Livro cadastrado' : 'Livros cadastrados' }}</span>
                </div>
                <a href="{{ route('livros.index') }}" class="card-indicador-link">
                    Ver livros <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Card com a quantidade de usuários (quem pode entrar no sistema). --}}
        <div class="col-sm-4">
            <div class="card-indicador card-usuarios">
                <div class="card-indicador-icone"><i class="fa fa-user-circle"></i></div>
                <div class="card-indicador-texto">
                    <span class="card-indicador-numero">{{ $totalUsuarios }}</span>
                    <span class="card-indicador-titulo">{{ $totalUsuarios === 1 ? 'Usuário cadastrado' : 'Usuários cadastrados' }}</span>
                </div>
                <a href="{{ route('usuarios.index') }}" class="card-indicador-link">
                    Ver usuários <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Atalhos para cadastrar rápido. --}}
    <div class="caixa">
        <h4 class="titulo-secao"><i class="fa fa-bolt"></i> Atalhos</h4>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Novo cliente</a>
        <a href="{{ route('livros.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Novo livro</a>
    </div>
@endsection
