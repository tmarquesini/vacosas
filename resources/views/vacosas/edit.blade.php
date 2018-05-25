<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Editar vacosa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">
        <form role="form" id="frmEdit">
            @csrf

            <div class="form-group row">
                <label for="organizador" class="col-md-4 col-form-label text-md-right">Organizador</label>

                <div class="col-md-6">
                    <input id="organizador" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-md-4 col-form-label text-md-right">Nome</label>

                <div class="col-md-6">
                    <input id="nome" type="text" class="form-control" name="nome" value="{{ $vacosa->nome }}" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="valor" class="col-md-4 col-form-label text-md-right">Valor</label>

                <div class="col-md-6">
                    <input id="valor" type="number" class="form-control" name="valor" value="{{ $vacosa->valor }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>

                <div class="col-md-6">
                    <input id="url" type="text" class="form-control" name="url" value="{{ $vacosa->url }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição</label>

                <div class="col-md-6">
                    <textarea name="descricao" id="descricao" cols="30" rows="3" class="form-control">{{ $vacosa->descricao }}</textarea>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script !src="">
    $('#frmEdit').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{ route('vacosas.update', $vacosa) }}',
            type: 'PUT',
            data: $(this).serialize()
        }).fail(function () {
            console.log("Erro ao tentar editar")
        }).always(function () {
            $('#mdModal').modal('toggle');
            window.location.reload();
        });
    });
</script>
