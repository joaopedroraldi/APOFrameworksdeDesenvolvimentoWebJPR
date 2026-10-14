{{-- Tela de login. --}}
@extends('layouts.app')

@section('titulo', 'Entrar')

@section('conteudo')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="caixa">
                <h2 class="text-center" style="margin-top: 0;"><i class="fa fa-sign-in"></i> Entrar</h2>
                <p class="text-center text-muted">Digite seu e-mail e senha para acessar o sistema.</p>

                {{-- O formulário manda os dados para a rota "login.entrar" (POST /login). --}}
                <form method="POST" action="{{ route('login.entrar') }}">
                    {{-- Token de segurança obrigatório em todo formulário do Laravel. --}}
                    @csrf

                    {{-- Campo de e-mail. O "has-error" deixa vermelho quando tem erro. --}}
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Campo de senha. --}}
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @error('password')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Caixinha de "lembrar de mim". --}}
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="lembrar" value="1"> Lembrar de mim
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-sign-in"></i> Entrar
                    </button>
                </form>

                <hr>
                <p class="text-center">
                    Ainda não tem conta? <a href="{{ route('cadastro') }}">Cadastre-se</a>
                </p>
            </div>
        </div>
    </div>
@endsection
