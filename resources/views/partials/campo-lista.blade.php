{{-- Uma caixa de seleção (select) pronta: rótulo, opções e mensagem de erro. --}}
{{-- Recebe: $nome, $rotulo, $opcoes (lista de valores) e $valor (o valor escolhido). --}}
<div class="form-group {{ $errors->has($nome) ? 'has-error' : '' }}">
    <label for="{{ $nome }}">{{ $rotulo }}</label>
    <select id="{{ $nome }}" name="{{ $nome }}" class="form-control">
        <option value="">Selecione...</option>
        @foreach ($opcoes as $opcao)
            {{-- O @selected marca a opção que já estava escolhida. --}}
            <option value="{{ $opcao }}" @selected(old($nome, $valor) === $opcao)>{{ $opcao }}</option>
        @endforeach
    </select>
    @error($nome)
        <span class="help-block">{{ $message }}</span>
    @enderror
</div>
