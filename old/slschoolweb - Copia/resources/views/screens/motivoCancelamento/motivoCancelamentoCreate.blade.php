@extends('layouts.main')
@section('title', 'Incluir motivo para o cancelamento')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir novo motivo para o cancelamento</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr>

        <div class="card p-5">

            <form action="{{ route('motivos_cancelamento.store') }}" method="post">

                @csrf


                <div class="mb-4">
                    <label for="motivo" class="form-label lblCaption">Motivos para o cancelamento ou desistência</label>
                    <input type="text" class="form-control" name="motivo" id="motivo" maxlength="50" autofocus
                        required value="{{ old('motivo') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/meios_pagamentos" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
