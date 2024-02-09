@extends('layouts.main')
@section('title', 'Alterar informações do horário selecionado')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Alterar informações do horário selecionado</h3>
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

            <form action="{{ route('horarios.update', $horarios->id) }}" method="post">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="entrada" class="form-label lblCaption">Horário de entrada</label>
                    <input type="time" class="form-control" name="entrada" id="entrada" 
                        autofocus required value="{{$horarios->entrada}}">
                </div>
                <div class="mb-3">
                    <label for="saida" class="form-label lblCaption">Horário de saída</label>
                    <input type="time" class="form-control" name="saida" id="saida" required value="{{$horarios->saida}}">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/dias" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
