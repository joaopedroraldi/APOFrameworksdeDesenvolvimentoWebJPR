{{-- Mostra uma janelinha do SweetAlert2 quando o controller manda um recado. --}}
{{-- Erros de formulário não aparecem aqui: eles já são mostrados embaixo de cada campo. --}}
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
