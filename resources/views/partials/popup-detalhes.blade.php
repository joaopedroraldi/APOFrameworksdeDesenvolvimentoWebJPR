{{-- Popup (modal do Bootstrap) que mostra os dados de um registro. --}}
{{-- Existe um só na página. O public/js/app.js troca o título e os dados antes de abrir. --}}
<div class="modal fade" id="popup-detalhes" tabindex="-1" role="dialog" aria-labelledby="popup-detalhes-titulo">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="popup-detalhes-titulo"></h4>
            </div>
            <div class="modal-body">
                {{-- Aqui entram os dados (rótulo do lado do valor). --}}
                <dl class="dl-horizontal popup-detalhes-lista"></dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
