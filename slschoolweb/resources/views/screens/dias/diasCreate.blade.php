{{--Dias de aulas disponiveis no sistema--}}

@extends('layouts.main')
@section('title', 'Dias disponíveis para aulas')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir novos dias de aulas</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="{{route('dias.store')}}" method="post">

            @csrf

            <div class="mb-3">
                <label for="dia1" class="form-label lblCaption">Digite o primeiro dia</label>
                <input type="text" class="form-control" name="dia1" id="dia1" placeholder="Digite o primeiro dia" autofocus required>
            </div>
            <div class="mb-3">
                <label for="dia2" class="form-label lblCaption">Segundo dia</label>
                <input type="text" class="form-control" name="dia2" id="dia2" placeholder="Digite o segundo dia">
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