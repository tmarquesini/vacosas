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

                        <table class="table table-striped">
                            <th>
                                <td>Nome</td>
                                <td>Organizador</td>
                                <td class="text-center">Valor</td>
                                <td class="text-center">Link</td>
                                <td class="text-center">Status</td>
                            </th>
                            @foreach($vacosas as $vacosa)
                            <tr>
                                <td><a href="#">{{ $vacosa->nome }}</a></td>
                                <td>{{ $vacosa->organizador->name }}</td>
                                <td class="text-center">R$ {{ $vacosa->valor }}</td>
                                <td class="text-center"><a href="{{ $vacosa->url }}"><i class="fa fa-link"></i></a></td>
                                <td class="text-center">{{ ucfirst($vacosa->status) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
