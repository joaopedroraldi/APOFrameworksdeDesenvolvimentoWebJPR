{{-- Botões de ver, editar e excluir, usados nas listas. --}}
{{-- Recebe: $rota (ex: "clientes"), $registro (o cliente ou livro da linha) e $titulo (título do popup). --}}

{{-- Botão "ver": abre um popup com os dados, sem sair da página. --}}
{{-- Os dados vão escritos no próprio botão (data-detalhes), e o public/js/app.js monta o popup. --}}
<button type="button" class="btn btn-info btn-xs btn-ver" title="Ver"
        data-titulo="{{ $titulo }}"
        data-detalhes="{{ json_encode($registro->detalhes()) }}">
    <i class="fa fa-eye"></i>
</button>

<a href="{{ route($rota.'.edit', $registro) }}" class="btn btn-warning btn-xs" title="Editar">
    <i class="fa fa-pencil"></i>
</a>

{{-- Excluir é um formulário DELETE. A classe "form-excluir" faz aparecer o "Tem certeza?". --}}
<form method="POST" action="{{ route($rota.'.destroy', $registro) }}" class="form-excluir">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-xs" title="Excluir">
        <i class="fa fa-trash"></i>
    </button>
</form>
