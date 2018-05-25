@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Vacosas</div>

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

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Nome</td>
                                    <td class="text-center">Organizador</td>
                                    <td class="text-center">Valor</td>
                                    <td class="text-center">Total arrecadado</td>
                                    <td class="text-center">Link</td>
                                    <td class="text-center">Status</td>
                                </th>
                            </thead>
                            <tbody>
                            @foreach ($vacosas as $vacosa)
                            <tr>
                                <td><a href="{{ route('vacosas.show', $vacosa) }}">{{ $vacosa->nome }}</a></td>
                                <td class="text-center">{{ $vacosa->organizador->name }}</td>
                                <td class="text-center">R$ {{ $vacosa->valor }}</td>
                                <td class="text-center">R$ {{ $vacosa->totalArrecadado }}</td>
                                <td class="text-center"><a href="{{ $vacosa->url }}" target="_blank"><i class="fa fa-link"></i></td>
                                <td class="text-center">{{ ucfirst($vacosa->status) }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
