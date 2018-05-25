
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Remover contribuição</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Deseja realmente remover a contribuição de {{ $contribuicao->participante->name }} no valor de R$ {{ $contribuicao->valor }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="removerContribuicao()">Remover</button>
            </div>
        </div>

<script type="text/javascript">
    function removerContribuicao() {
        $.ajax({
            url: '{{ route('contribuicoes.destroy', $contribuicao) }}',
            type: 'DELETE',
            data: '_token={{ csrf_token() }}'
        }).always(function () {
            window.location.replace('{{ route('vacosas.show', $vacosa) }}');
        });
    }
</script>