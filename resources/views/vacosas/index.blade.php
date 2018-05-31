@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Vacosas @if(Route::is("vacosas.fechadas")) fechadas @else abertas @endif

                        <span style="float: right">
                            @if(Route::is("vacosas.fechadas"))
                                <a href="{{ route('vacosas.index') }}">Ver vacosas abertas</a>
                            @else
                                <a href="{{ route('vacosas.fechadas') }}" class="text-danger">Ver vacosas fechadas</a>
                            @endif
                            </span></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>Nome</td>
                                    <td class="text-center">Organizador</td>
                                    <td class="text-center">Valor</td>
                                    <td class="text-center">Total arrecadado</td>
                                    <td class="text-center">Link</td>
                                    <td class="text-center">Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($vacosas as $vacosa)
                                    <tr>
                                        <td style="vertical-align: middle"><a
                                                    href="{{ route('vacosas.show', $vacosa->uuid) }}">{{ $vacosa->nome }}</a>
                                        </td>
                                        <td style="vertical-align: middle"
                                            class="text-center">{{ $vacosa->organizador->name }}</td>
                                        <td style="vertical-align: middle" class="text-center">
                                            R$ {{ $vacosa->valor }}</td>
                                        <td style="vertical-align: middle" class="text-center">
                                            R$ {{ $vacosa->totalArrecadado }}
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                     style="width: {{\App\Helpers\Functions::percent($vacosa->totalArrecadado,$vacosa->valor)}}%;"
                                                     aria-valuenow="{{\App\Helpers\Functions::percent($vacosa->totalArrecadado,$vacosa->valor)}}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">{{\App\Helpers\Functions::percent($vacosa->totalArrecadado,$vacosa->valor)}}
                                                    %
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle" class="text-center"><a
                                                    href="{{ $vacosa->url }}" target="_blank"><i class="fa fa-link"></i></a>
                                        </td>
                                        <td style="vertical-align: middle"
                                            class="text-center">{!! \App\Helpers\Functions::status($vacosa->status) !!}</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
