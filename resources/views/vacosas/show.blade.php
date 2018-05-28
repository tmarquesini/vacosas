@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Vacosa
                        @if (Auth::user()->role == 'admin' || $vacosa->organizador->id == Auth::user()->id)
                            <span style="float: right">
                                <a href="#" data-toggle="modal" data-target="#mdModal"
                                   data-url="{{ route('vacosas.edit', $vacosa) }}">editar</a>
                                @if (Auth::user()->role == 'admin')
                                    | <a href="#" data-toggle="modal" data-target="#mdDeleteModal" class="text-danger">remover</a>
                                @endif
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p><strong>Organizador:</strong> {{ $vacosa->organizador->name }}</p>
                        <p><strong>Nome:</strong> {{ $vacosa->nome }}
                            <small>[<a href="{{ $vacosa->url }}" target="_blank">site</a>]</small>
                        </p>
                        <p><strong>Valor:</strong> R$ {{ $vacosa->valor }}</p>
                        <p><strong>Total arrecadado:</strong> R$ {{ $vacosa->totalArrecadado }}</p>
                        <p><strong>Faltando:</strong> R$ {{ $vacosa->valor - $vacosa->totalArrecadado }}</p>
                        <p><strong>Status:</strong> {!! \App\Helpers\Functions::status($vacosa->status) !!}</p>
                        <p><strong>Descrição:</strong> {{ $vacosa->descricao }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Contribuições
                        @if ((Auth::user()->role == 'admin' || $vacosa->organizador->id == Auth::user()->id) && $vacosa->status=="aberta")
                            <span style="float: right">
                                <a href="#" data-toggle="modal" data-target="#mdModal"
                                   data-url="{{ route('contribuicoes.create', $vacosa) }}">adicionar</a>
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($vacosa->contribuicoes as $contribuicao)
                                <li>{{ $contribuicao->participante->name }} -
                                    R$ {{ $contribuicao->valor }} @if ((Auth::user()->role == 'admin' || $vacosa->organizador->id == Auth::user()->id) && $vacosa->status=="aberta")
                                        <a href="#" data-toggle="modal" data-target="#mdModal"
                                           data-url="{{ route('contribuicoes.confirmDestroy', [$vacosa, $contribuicao]) }}"><i
                                                    class="fa fa-times text-danger"></i></a> @endif</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mdModal" tabindex="-1" role="dialog" aria-labelledby="mdModal">
        <div class="modal-dialog" id="mdContent" role="document"></div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="mdDeleteModal" tabindex="-1" role="dialog" aria-labelledby="mdDeleteModal">
        <div class="modal-dialog" id="mdContent" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Remover vacosa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Deseja realmente remover esta vacosa?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="removerVacosa()">Remover</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            /* carrega modal */
            $('#mdModal').on('show.bs.modal', function (event) {
                let element = $(event.relatedTarget);
                $(this).find(".modal-dialog").load(element.data('url'));
            });

            /* limpa modal */
            $('#mdModal').on('hide.bs.modal', function (event) {
                $(this).find(".modal-dialog").empty();
            });

        });

        function removerVacosa() {
            $.ajax({
                url: '{{ route('vacosas.destroy', $vacosa) }}',
                type: 'DELETE',
                data: '_token={{ csrf_token() }}'
            }).always(function () {
                window.location.replace('{{ route('vacosas.index') }}');
            });
        }
    </script>
@endsection
