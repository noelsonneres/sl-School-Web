@extends('layouts.main')
@section('title', 'Nova conta a pagar')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir uma nova conta</h3>
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

            <form action="{{ route('salas.store') }}" method="post">

                @csrf

                <div class="row">

                    <div class="col-md-8 mb-6">
                        <label for="conta" class="form-label lblCaption">Conta</label>
                        <input type="text" class="form-control" name="conta" id="conta" maxlength="50"
                               autofocus required value="{{old('sala')}}">
                    </div>
                    <div class="col-md-4 mb-6">
                        <label for="tipo" class="form-label lblCaption">Plano de contas</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="">Selecione o plano de contas</option>

                            @foreach($planoContas as $plano)
                                <option value="{{$plano->id}}">{{$plano->plano}}</option>
                            @endforeach

                        </select>
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/config_mensalidades" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
