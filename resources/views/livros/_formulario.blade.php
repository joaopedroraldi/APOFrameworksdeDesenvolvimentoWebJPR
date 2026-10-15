{{-- Campos do formulário de livro. --}}
{{-- Este arquivo é usado tanto na tela de criar quanto na de editar. --}}
<h4 class="titulo-secao"><i class="fa fa-book"></i> Identificação</h4>
<div class="row">
    <div class="col-sm-6">
        @include('partials.campo', ['nome' => 'titulo', 'rotulo' => 'Título *', 'valor' => $livro->titulo, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-6">
        @include('partials.campo', ['nome' => 'subtitulo', 'rotulo' => 'Subtítulo', 'valor' => $livro->subtitulo, 'extra' => 'maxlength=255'])
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
        @include('partials.campo', ['nome' => 'autor', 'rotulo' => 'Autor *', 'valor' => $livro->autor, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-4">
        @include('partials.campo', ['nome' => 'editora', 'rotulo' => 'Editora', 'valor' => $livro->editora, 'extra' => 'maxlength=255'])
    </div>
    <div class="col-sm-3">
        @include('partials.campo', ['nome' => 'isbn', 'rotulo' => 'ISBN *', 'valor' => $livro->isbn, 'extra' => 'maxlength=17 placeholder=9788535914849'])
    </div>
</div>

<h4 class="titulo-secao"><i class="fa fa-info-circle"></i> Detalhes</h4>
<div class="row">
    <div class="col-sm-3">
        @include('partials.campo-lista', ['nome' => 'genero', 'rotulo' => 'Gênero *', 'opcoes' => \App\Models\Livro::GENEROS, 'valor' => $livro->genero])
    </div>
    <div class="col-sm-3">
        @include('partials.campo-lista', ['nome' => 'idioma', 'rotulo' => 'Idioma *', 'opcoes' => \App\Models\Livro::IDIOMAS, 'valor' => $livro->idioma])
    </div>
    <div class="col-sm-2">
        @include('partials.campo', ['nome' => 'ano_publicacao', 'rotulo' => 'Ano', 'tipo' => 'number', 'valor' => $livro->ano_publicacao, 'extra' => 'min=1000 max='.date('Y')])
    </div>
    <div class="col-sm-2">
        @include('partials.campo', ['nome' => 'edicao', 'rotulo' => 'Edição', 'tipo' => 'number', 'valor' => $livro->edicao, 'extra' => 'min=1'])
    </div>
    <div class="col-sm-2">
        @include('partials.campo', ['nome' => 'numero_paginas', 'rotulo' => 'Páginas', 'tipo' => 'number', 'valor' => $livro->numero_paginas, 'extra' => 'min=1'])
    </div>
</div>

<h4 class="titulo-secao"><i class="fa fa-shopping-cart"></i> Venda</h4>
<div class="row">
    <div class="col-sm-3">
        @include('partials.campo-lista', ['nome' => 'formato', 'rotulo' => 'Formato *', 'opcoes' => \App\Models\Livro::FORMATOS, 'valor' => $livro->formato])
    </div>
    <div class="col-sm-3">
        {{-- Preço com "R$" na frente, usando o input-group do Bootstrap. --}}
        <div class="form-group {{ $errors->has('preco') ? 'has-error' : '' }}">
            <label for="preco">Preço *</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="number" id="preco" name="preco" class="form-control" step="0.01" min="0" value="{{ old('preco', $livro->preco) }}">
            </div>
            @error('preco')
                <span class="help-block">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-3">
        @include('partials.campo', ['nome' => 'quantidade_estoque', 'rotulo' => 'Estoque *', 'tipo' => 'number', 'valor' => $livro->quantidade_estoque, 'extra' => 'min=0'])
    </div>
    <div class="col-sm-3">
        {{-- Caixinha de "ativo". O hidden manda 0 quando ela está desmarcada. --}}
        <div class="form-group">
            <label>Situação</label>
            <div class="checkbox" style="margin-top: 5px;">
                <label>
                    <input type="hidden" name="ativo" value="0">
                    <input type="checkbox" name="ativo" value="1" @checked(old('ativo', $livro->ativo))> Ativo (à venda)
                </label>
            </div>
        </div>
    </div>
</div>

<h4 class="titulo-secao"><i class="fa fa-align-left"></i> Sinopse</h4>
<div class="form-group {{ $errors->has('sinopse') ? 'has-error' : '' }}">
    <label for="sinopse" class="sr-only">Sinopse</label>
    <textarea id="sinopse" name="sinopse" class="form-control" rows="4" maxlength="5000" placeholder="Um resumo da história">{{ old('sinopse', $livro->sinopse) }}</textarea>
    @error('sinopse')
        <span class="help-block">{{ $message }}</span>
    @enderror
</div>

<p class="text-muted"><small>* Campos obrigatórios</small></p>
