{{-- Um campo de formulário pronto: rótulo, caixa de texto e mensagem de erro. --}}
{{-- Recebe: $nome, $rotulo, $valor e, se quiser, $tipo, $classe, $extra (atributos) e $ajuda. --}}
<div class="form-group {{ $errors->has($nome) ? 'has-error' : '' }}">
    <label for="{{ $nome }}">{{ $rotulo }}</label>
    <input type="{{ $tipo ?? 'text' }}" id="{{ $nome }}" name="{{ $nome }}"
           class="form-control {{ $classe ?? '' }}"
           value="{{ old($nome, $valor) }}" {!! $extra ?? '' !!}>
    @if (! empty($ajuda))
        <span class="help-block"><small>{{ $ajuda }}</small></span>
    @endif
    @error($nome)
        <span class="help-block">{{ $message }}</span>
    @enderror
</div>
