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
                        Usuário
                        @if (Auth::user()->role == 'admin')
                            <span style="float: right">
                                @if ($user->blocked)
                                    <a href="#" onclick="desbloquear()" class="text-success">desbloquear</a>
                                @else
                                    <a href="#" onclick="bloquear()" class="text-danger">bloquear</a>
                                @endif
                                 |
                                @if ($user->role == 'admin')
                                    <a href="#" onclick="definirComoUser()" class="text-primary">tornar usuário</a>
                                @else
                                    <a href="#" onclick="definirComoAdmin()" class="text-primary">tornar administrador</a>
                                @endif
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p><strong>Nome:</strong> {{ $user->name }}</p>
                        <p><strong>E-mail:</strong> {{ $user->email }}</p>
                        <p><strong>Telefone:</strong> {{ $user->phone }}</p>
                        <p><strong>Tipo:</strong> {{ ucfirst($user->type) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                        <p><strong>Última contribuição:</strong> {{ $user->dataDaUltimaContribuicao }}</p>
                        <p><strong>Número de contribuições:</strong> {{ $user->contribuicoes->count() }}</p>
                        <p><strong>Total contribuído:</strong> R$ {{ $user->totalContribuido }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Contribuições
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($user->contribuicoes as $contribuicao)
                                <li>{{ $contribuicao->vacosa->nome }} - R$ {{ $contribuicao->valor }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function bloquear() {
            $.ajax({
                url: '{{ route('users.block', $user) }}',
                type: 'PUT',
                data: '_token={{ csrf_token() }}'
            }).always(function () {
                window.location.replace('{{ route('users.show', $user) }}');
            });
        }
        function desbloquear() {
            $.ajax({
                url: '{{ route('users.unblock', $user) }}',
                type: 'PUT',
                data: '_token={{ csrf_token() }}'
            }).always(function () {
                window.location.replace('{{ route('users.show', $user) }}');
            });
        }
        function definirComoAdmin() {
            $.ajax({
                url: '{{ route('users.setAsAdmin', $user) }}',
                type: 'PUT',
                data: '_token={{ csrf_token() }}'
            }).always(function () {
                window.location.replace('{{ route('users.show', $user) }}');
            });
        }
        function definirComoUser() {
            $.ajax({
                url: '{{ route('users.setAsUser', $user) }}',
                type: 'PUT',
                data: '_token={{ csrf_token() }}'
            }).always(function () {
                window.location.replace('{{ route('users.show', $user) }}');
            });
        }
    </script>
@endsection
