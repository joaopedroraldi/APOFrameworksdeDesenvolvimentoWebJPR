{{-- Tela que mostra todos os dados de um cliente. --}}
@extends('layouts.app')

@section('titulo', $cliente->nome)

@section('conteudo')
    <div class="caixa">
        {{-- "dl-horizontal" é uma lista do Bootstrap com o nome do campo do lado do valor. --}}
        {{-- O ?: '-' mostra um traço quando o campo está vazio. --}}
        <h4 class="titulo-secao"><i class="fa fa-id-card-o"></i> Dados pessoais</h4>
        <dl class="dl-horizontal">
            <dt>CPF</dt>
            <dd>{{ $cliente->cpf }}</dd>
            <dt>E-mail</dt>
            <dd>{{ $cliente->email ?: '-' }}</dd>
            <dt>Telefone</dt>
            <dd>{{ $cliente->telefone ?: '-' }}</dd>
            <dt>Nascimento</dt>
            <dd>{{ $cliente->data_nascimento ? $cliente->data_nascimento->format('d/m/Y').' ('.$cliente->data_nascimento->age.' anos)' : '-' }}</dd>
        </dl>

        <h4 class="titulo-secao"><i class="fa fa-map-marker"></i> Endereço</h4>
        <dl class="dl-horizontal">
            <dt>CEP</dt>
            <dd>{{ $cliente->cep ?: '-' }}</dd>
            <dt>Endereço</dt>
            <dd>{{ $cliente->endereco ? $cliente->endereco.', '.($cliente->numero ?: 's/n') : '-' }}</dd>
            <dt>Complemento</dt>
            <dd>{{ $cliente->complemento ?: '-' }}</dd>
            <dt>Bairro</dt>
            <dd>{{ $cliente->bairro ?: '-' }}</dd>
            <dt>Cidade/UF</dt>
            <dd>{{ $cliente->cidade ? $cliente->cidade.'/'.$cliente->uf : '-' }}</dd>
        </dl>

        <h4 class="titulo-secao"><i class="fa fa-sticky-note-o"></i> Outras informações</h4>
        <dl class="dl-horizontal">
            <dt>Observações</dt>
            {{-- O nl2br mantém as quebras de linha. O e() protege contra código malicioso. --}}
            <dd>{!! $cliente->observacoes ? nl2br(e($cliente->observacoes)) : '-' !!}</dd>
            <dt>Cadastrado em</dt>
            <dd>{{ $cliente->created_at->format('d/m/Y H:i') }}</dd>
            <dt>Alterado em</dt>
            <dd>{{ $cliente->updated_at->format('d/m/Y H:i') }}</dd>
        </dl>
    </div>
@endsection
