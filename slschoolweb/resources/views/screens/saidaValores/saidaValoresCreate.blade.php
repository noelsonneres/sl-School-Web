@extends('layouts.main')
@section('title', 'Nova saída de valores')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova saída de valores</h3>
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

            <form action="{{ route('saida_valores.store') }}" method="post">

                @csrf

                <div class="row">

                    <div class="mb-4">
                        <label for="motivo" class="form-label lblCaption">Motivo</label>
                        <input type="text" class="form-control" name="motivo" id="motivo" maxlength="50"
                               autofocus required value="{{old('sala')}}">
                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-4">
                            <label for="data" class="form-label lblCaption">Data</label>
                            <input type="date" class="form-control" name="data" id="data" required>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="hora" class="form-label lblCaption">Hora</label>
                            <input type="time" class="form-control" name="hora" id="hora" required>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="valor" class="form-label lblCaption">valor</label>
                            <input type="number" step="0.01" min="0.01" class="form-control" name="valor" id="valor" required>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
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
