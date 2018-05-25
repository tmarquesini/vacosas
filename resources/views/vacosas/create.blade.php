@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Iniciar uma vacosa</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('vacosas.store') }}">
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
                                    <input id="nome" type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}" required autofocus>

                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="valor" class="col-md-4 col-form-label text-md-right">Valor</label>

                                <div class="col-md-6">
                                    <input id="valor" type="number" class="form-control{{ $errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ old('valor') }}" required>

                                    @if ($errors->has('valor'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('valor') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contribuicao" class="col-md-4 col-form-label text-md-right">Contribuição</label>

                                <div class="col-md-6">
                                    <input id="contribuicao" type="number" min="20" class="form-control{{ $errors->has('contribuicao') ? ' is-invalid' : '' }}" name="contribuicao" value="{{ old('contribuicao') ? old('contribuicao') : 20 }}" required>

                                    @if ($errors->has('contribuicao'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contribuicao') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" value="{{ old('url') }}" required>

                                    @if ($errors->has('url'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">Descrição</label>

                                <div class="col-md-6">
                                    <textarea name="descricao" id="descricao" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Iniciar vacosa
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
