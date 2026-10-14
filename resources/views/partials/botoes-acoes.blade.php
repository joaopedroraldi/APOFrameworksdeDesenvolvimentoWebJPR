{{-- Botões de ver, editar e excluir, usados nas listas. --}}
{{-- Recebe: $rota (ex: "clientes") e $registro (o cliente ou livro da linha). --}}

<a href="{{ route($rota.'.show', $registro) }}" class="btn btn-info btn-xs" title="Ver">
    <i class="fa fa-eye"></i>
</a>

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
