@extends('layouts.main')
@section('title', 'Incluindo novo meio de pagamento')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluindo novo meios de pagamento</h3>
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

            <form action="{{ route('meios_pagamentos.store') }}" method="post">

                @csrf


                <div class="col-md-8 mb-3">
                    <label for="meios" class="form-label lblCaption">Meios de pagamentos</label>
                    <input type="text" class="form-control" name="meios" id="meios" maxlength="50" autofocus
                        required value="{{ old('meios') }}">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
