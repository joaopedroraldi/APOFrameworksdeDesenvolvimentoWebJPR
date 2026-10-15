{{-- Tela de cadastro de usuário. --}}
@extends('layouts.app')

@section('titulo', 'Cadastro')

@section('conteudo')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="caixa">
                <h2 class="text-center" style="margin-top: 0;"><i class="fa fa-user-plus"></i> Criar conta</h2>
                <p class="text-center text-muted">Preencha os dados para criar seu acesso.</p>

                {{-- O formulário manda os dados para a rota "cadastro.salvar" (POST /cadastro). --}}
                <form method="POST" action="{{ route('cadastro.salvar') }}">
                    @csrf

                    {{-- Nome. O old() devolve o que a pessoa digitou se der erro. --}}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" maxlength="255" required autofocus>
                        @error('name')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- E-mail. --}}
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" maxlength="255" required>
                        @error('email')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Senha. --}}
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" class="form-control" minlength="8" required>
                        <span class="help-block">Mínimo de 8 caracteres.</span>
                        @error('password')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pergunta de segurança. Sem o RA certo, a conta não é criada. --}}
                    <div class="form-group {{ $errors->has('ra') ? 'has-error' : '' }}">
                        <label for="ra">Qual é o RA do João Pedro Raldi?</label>
                        <input type="text" id="ra" name="ra" class="form-control" inputmode="numeric" autocomplete="off" required>
                        @error('ra')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fa fa-check"></i> Cadastrar
                    </button>
                </form>

                <hr>
                <p class="text-center">
                    Já tem conta? <a href="{{ route('login') }}">Entrar</a>
                </p>
            </div>
        </div>
    </div>
@endsection
