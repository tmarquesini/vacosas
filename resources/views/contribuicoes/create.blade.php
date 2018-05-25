<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Adicionar contribuição</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>

    <div class="modal-body">
        <form role="form" method="post" action="{{ route('contribuicoes.store', $vacosa) }}">
            @csrf

            <input type="hidden" name="vacosa" value="{{ $vacosa->id }}">

            <div class="form-group row">
                <label for="participante" class="col-md-4 col-form-label text-md-right">Participante</label>

                <div class="col-md-6">
                    <select name="participante" class="form-control">
                        <option selected disabled>Selecione um usuário</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="nome" class="col-md-4 col-form-label text-md-right">Valor</label>

                <div class="col-md-6">
                    <input id="nome" type="number" min="10" class="form-control" name="valor" value="10" required>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Adicionar
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

