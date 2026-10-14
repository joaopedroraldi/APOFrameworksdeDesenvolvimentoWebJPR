// Funções JavaScript usadas em todo o sistema.

$(function () {

    // Deixa o DataTables em português em todas as tabelas.
    if ($.fn.dataTable) {
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                emptyTable: 'Nenhum registro encontrado',
                info: 'Mostrando _START_ até _END_ de _TOTAL_ registros',
                infoEmpty: 'Mostrando 0 até 0 de 0 registros',
                infoFiltered: '(filtrado de _MAX_ registros)',
                lengthMenu: 'Mostrar _MENU_ por página',
                loadingRecords: 'Carregando...',
                processing: 'Processando...',
                search: 'Buscar:',
                zeroRecords: 'Nenhum registro encontrado',
                paginate: {
                    first: 'Primeira',
                    last: 'Última',
                    next: 'Próxima',
                    previous: 'Anterior'
                }
            }
        });
    }

    // Pergunta "tem certeza?" antes de excluir.
    // Funciona em qualquer formulário que tiver a classe "form-excluir".
    $(document).on('submit', '.form-excluir', function (evento) {
        // Segura o envio do formulário.
        evento.preventDefault();

        var formulario = this;

        Swal.fire({
            icon: 'warning',
            title: 'Tem certeza?',
            text: 'Depois de excluído, não dá para desfazer.',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#d9534f'
        }).then(function (resposta) {
            // Só envia se a pessoa clicou em "Sim".
            if (resposta.isConfirmed) {
                formulario.submit();
            }
        });
    });

});
