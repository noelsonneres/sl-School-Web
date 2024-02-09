{{--Dias de aulas disponiveis no sistema--}}

@extends('layouts.main')
@section('title', 'Visualizar dados do dia selecionado')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Dados do dia selecionado</h3>
    </div>

    <hr>
        <h5>Código: {{$dias->id}}</h5>
    <hr>

    <div class="card p-5">

        <form action="{{route('dias.update', $dias->id)}}" method="post">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="dia1" class="form-label lblCaption">Digite o primeiro dia</label>
                <input type="text" class="form-control" name="dia1" id="dia1"
                         placeholder="Digite o primeiro dia" maxlength="50" autofocus required
                         value="{{$dias->dia1}}" >
            </div>
            <div class="mb-3">
                <label for="dia2" class="form-label lblCaption">Segundo dia</label>
                <input type="text" class="form-control" name="dia2" id="dia2"
                     placeholder="Digite o segundo dia" maxlength="50" value="{{$dias->dia2}}">
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