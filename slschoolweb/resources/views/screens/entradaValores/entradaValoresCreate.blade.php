@extends('layouts.main')
@section('title', 'Nova entrada de valores')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova entrada de valores</h3>
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

            <form action="{{ route('entrada_valores.store') }}" method="post">

                @csrf

                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label for="motivo" class="form-label lblCaption">Motivo</label>
                        <input type="text" class="form-control" name="motivo" id="motivo" maxlength="50"
                               autofocus required value="{{old('sala')}}">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="data" class="form-label lblCaption">Data</label>
                        <input type="date" class="form-control" name="data" id="data" required>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="hora" class="form-label lblCaption">Hora</label>
                        <input type="time" class="form-control" name="hora" id="hora" required>
                    </div>


                    <div class="mb-4">
                        <label for="descricao" class="form-label lblCaption">Descrição</label>
                        <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar
                    </button>

                    <a href="/config_mensalidades" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
