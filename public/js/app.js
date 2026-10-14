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

    // Máscaras: vão colocando os pontos e traços enquanto a pessoa digita.
    if ($.fn.mask) {
        $('.mascara-cpf').mask('000.000.000-00');
        $('.mascara-cep').mask('00000-000');

        // Telefone: troca a máscara sozinha entre fixo (8 números) e celular (9 números).
        var mascaraTelefone = function (valor) {
            return valor.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        };
        $('.mascara-telefone').mask(mascaraTelefone, {
            onKeyPress: function (valor, e, campo, opcoes) {
                campo.mask(mascaraTelefone.apply({}, arguments), opcoes);
            }
        });
    }

    // Busca o endereço pelo CEP no site ViaCEP (gratuito) e preenche os campos.
    $('#cep').on('blur', function () {
        // Deixa só os números do CEP.
        var cep = $(this).val().replace(/\D/g, '');

        // CEP precisa ter 8 números.
        if (cep.length !== 8) {
            return;
        }

        $.getJSON('https://viacep.com.br/ws/' + cep + '/json/')
            .done(function (dados) {
                // Se o CEP não existe, o ViaCEP responde com "erro".
                if (dados.erro) {
                    Swal.fire({ icon: 'info', title: 'CEP não encontrado', text: 'Preencha o endereço manualmente.' });
                    return;
                }
                $('#endereco').val(dados.logradouro);
                $('#bairro').val(dados.bairro);
                $('#cidade').val(dados.localidade);
                $('#uf').val(dados.uf);
                // Leva o cursor para o campo "Número", que é o próximo a preencher.
                $('#numero').focus();
            });
    });

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
