{{-- Campos do formulário de usuário (usado no criar e no editar). --}}
<div class="row">
    <div class="col-sm-6">
        @include('partials.campo', ['nome' => 'name', 'rotulo' => 'Nome *', 'valor' => $usuario->name, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-6">
        @include('partials.campo', ['nome' => 'email', 'rotulo' => 'E-mail *', 'tipo' => 'email', 'valor' => $usuario->email, 'extra' => 'maxlength=255'])
    </div>
</div>

<h4 class="titulo-secao"><i class="fa fa-lock"></i> Senha</h4>

{{-- Na edição, avisa que a senha só muda se for preenchida. --}}
{{-- O $usuario->exists diz se o usuário já está salvo no banco (ou seja, se é edição). --}}
@if ($usuario->exists)
    <p class="text-muted"><i class="fa fa-info-circle"></i> Deixe em branco para manter a senha atual.</p>
@endif

<div class="row">
    <div class="col-sm-6">
        {{-- Campo de senha. O valor nunca vem preenchido, por segurança. --}}
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">Senha {{ $usuario->exists ? '' : '*' }}</label>
            <input type="password" id="password" name="password" class="form-control" autocomplete="new-password">
            <span class="help-block"><small>Mínimo de 8 caracteres.</small></span>
            @error('password')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        {{-- O nome precisa ser "password_confirmation" para o Laravel conferir. --}}
        <div class="form-group">
            <label for="password_confirmation">Repita a senha {{ $usuario->exists ? '' : '*' }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>
    </div>
</div>

<p class="text-muted"><small>* Campos obrigatórios</small></p>
