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

    // Liga o DataTables em todas as tabelas que tiverem a classe "tabela-datatable".
    // Assim as listas de livros, clientes e usuários funcionam do mesmo jeito.
    if ($.fn.dataTable) {
        $('.tabela-datatable').DataTable({
            pageLength: 10,                          // 10 registros por página.
            lengthMenu: [5, 10, 25, 50, 100],        // Opções de "Mostrar X por página".
            order: [[0, 'asc']],                     // Começa ordenando pela primeira coluna.
            columnDefs: [
                { orderable: false, searchable: false, targets: -1 } // A coluna "Ações" (a última) não ordena nem busca.
            ],
            autoWidth: false,                        // Deixa o Bootstrap cuidar da largura das colunas.

            // Arrumação dos pedaços do DataTables na tela (cada letra é um pedaço):
            // l = "Mostrar X por página", f = busca, t = tabela, i = "Mostrando X até Y", p = páginas.
            // A tabela fica dentro da "tabela-rolagem", que rola para os lados quando não cabe na tela.
            // Na linha de cima ficam: "Mostrar X" (esquerda), o título (meio) e a busca (direita).
            dom: "<'row'<'col-sm-4'l><'col-sm-4 titulo-datatable'><'col-sm-4'f>>" +
                 "<'row'<'col-sm-12 tabela-rolagem'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            // Roda quando o DataTables termina de carregar.
            initComplete: function () {
                var tabela = $(this);

                // Pega o título e o ícone escritos na tabela (data-titulo e data-icone).
                var titulo = tabela.data('titulo') || '';
                var icone = tabela.data('icone') || '';

                // Monta o título e coloca no espaço do meio.
                var h1 = $('<h1>');
                if (icone) {
                    h1.append($('<i>').addClass('fa ' + icone)).append(' ');
                }
                h1.append(document.createTextNode(titulo));

                $(this.api().table().container()).find('.titulo-datatable').append(h1);
            }
        });
    }

    // Botão "ver": monta o popup com os dados escritos no botão e abre.
    // Usa $(document).on porque o DataTables cria as linhas de novo ao trocar de página.
    $(document).on('click', '.btn-ver', function () {
        var botao = $(this);
        var lista = $('#popup-detalhes .popup-detalhes-lista').empty();

        // Título do popup (ex: nome do cliente).
        $('#popup-detalhes-titulo').text(botao.data('titulo'));

        // Cada item é [rótulo, valor]. O .text() protege contra código malicioso.
        $.each(botao.data('detalhes'), function (i, item) {
            lista.append($('<dt>').text(item[0]));
            lista.append($('<dd>').text(item[1]));
        });

        $('#popup-detalhes').modal('show');
    });

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
