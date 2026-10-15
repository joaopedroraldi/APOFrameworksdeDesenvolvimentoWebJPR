{{-- Mostra uma janelinha do SweetAlert2 quando o controller manda um recado. --}}
{{-- O @json transforma o texto do PHP em texto seguro para o JavaScript. --}}

{{-- Recado de sucesso (ex: "Livro cadastrado!"). --}}
@if (session('sucesso'))
    <script>
        Swal.fire({ icon: 'success', title: 'Pronto!', text: @json(session('sucesso')), timer: 2500, showConfirmButton: false });
    </script>
@endif

{{-- Recado de erro (ex: "Não foi possível excluir."). --}}
@if (session('erro'))
    <script>
        Swal.fire({ icon: 'error', title: 'Ops!', text: @json(session('erro')) });
    </script>
@endif

{{-- Erros de formulário (campo obrigatório vazio, por exemplo). --}}
{{-- Na tela de cadastro não aparece, porque lá o erro já é mostrado embaixo de cada campo. --}}
@if ($errors->any() && ! request()->routeIs('cadastro'))
    <script>
        Swal.fire({ icon: 'warning', title: 'Confira o formulário', text: 'Alguns campos precisam ser corrigidos.' });
    </script>
@endif
