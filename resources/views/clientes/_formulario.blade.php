{{-- Campos do formulário de cliente. --}}
{{-- Este arquivo é usado tanto na tela de criar quanto na de editar. --}}
{{-- O old('campo', $cliente->campo) mostra o que foi digitado (se deu erro) ou o valor salvo. --}}

<h4 class="titulo-secao"><i class="fa fa-id-card-o"></i> Dados pessoais</h4>
<div class="row">
    <div class="col-sm-8">
        @include('partials.campo', ['nome' => 'nome', 'rotulo' => 'Nome completo *', 'valor' => $cliente->nome, 'extra' => 'required maxlength=255'])
    </div>
    <div class="col-sm-4">
        @include('partials.campo', ['nome' => 'cpf', 'rotulo' => 'CPF *', 'valor' => $cliente->cpf, 'classe' => 'mascara-cpf', 'extra' => 'required placeholder=000.000.000-00'])
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
        @include('partials.campo', ['nome' => 'email', 'rotulo' => 'E-mail', 'tipo' => 'email', 'valor' => $cliente->email, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-4">
        @include('partials.campo', ['nome' => 'telefone', 'rotulo' => 'Telefone', 'valor' => $cliente->telefone, 'classe' => 'mascara-telefone', 'extra' => 'placeholder="(00) 00000-0000"'])
    </div>
    <div class="col-sm-3">
        {{-- O campo de data precisa do valor no formato ano-mês-dia. --}}
        @include('partials.campo', ['nome' => 'data_nascimento', 'rotulo' => 'Data de nascimento', 'tipo' => 'date', 'valor' => $cliente->data_nascimento?->format('Y-m-d')])
    </div>
</div>

<h4 class="titulo-secao"><i class="fa fa-map-marker"></i> Endereço</h4>
<div class="row">
    <div class="col-sm-3">
        @include('partials.campo', ['nome' => 'cep', 'rotulo' => 'CEP', 'valor' => $cliente->cep, 'classe' => 'mascara-cep', 'extra' => 'placeholder=00000-000', 'ajuda' => 'Digite o CEP para preencher o endereço sozinho.'])
    </div>
    <div class="col-sm-7">
        @include('partials.campo', ['nome' => 'endereco', 'rotulo' => 'Endereço', 'valor' => $cliente->endereco, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-2">
        @include('partials.campo', ['nome' => 'numero', 'rotulo' => 'Número', 'valor' => $cliente->numero, 'extra' => 'maxlength=10'])
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        @include('partials.campo', ['nome' => 'complemento', 'rotulo' => 'Complemento', 'valor' => $cliente->complemento, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-3">
        @include('partials.campo', ['nome' => 'bairro', 'rotulo' => 'Bairro', 'valor' => $cliente->bairro, 'extra' => 'maxlength=100'])
    </div>
    <div class="col-sm-3">
        @include('partials.campo', ['nome' => 'cidade', 'rotulo' => 'Cidade', 'valor' => $cliente->cidade, 'extra' => 'maxlength=100'])
    </div>
    <div class="col-sm-2">
        {{-- Caixa de seleção com os 27 estados (a lista fica no model Cliente). --}}
        <div class="form-group {{ $errors->has('uf') ? 'has-error' : '' }}">
            <label for="uf">UF</label>
            <select id="uf" name="uf" class="form-control">
                <option value="">--</option>
                @foreach (\App\Models\Cliente::ESTADOS as $estado)
                    <option value="{{ $estado }}" @selected(old('uf', $cliente->uf) === $estado)>{{ $estado }}</option>
                @endforeach
            </select>
            @error('uf')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<h4 class="titulo-secao"><i class="fa fa-sticky-note-o"></i> Outras informações</h4>
<div class="form-group {{ $errors->has('observacoes') ? 'has-error' : '' }}">
    <label for="observacoes">Observações</label>
    <textarea id="observacoes" name="observacoes" class="form-control" rows="3" maxlength="2000">{{ old('observacoes', $cliente->observacoes) }}</textarea>
    @error('observacoes')
        <span class="help-block">{{ $message }}</span>
    @enderror
</div>

<p class="text-muted"><small>* Campos obrigatórios</small></p>
