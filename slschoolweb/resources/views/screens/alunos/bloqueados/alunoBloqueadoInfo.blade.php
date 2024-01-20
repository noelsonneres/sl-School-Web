@extends('layouts.main')
@section('title', 'Informações do bloqueio')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Informações do bloqueio</h3>
        </div>

        <div class=" row ps-2">
            <div class="col-md-6">
                <h4>Aluno(a): {{ $matricula->alunos->nome }}</h4>
            </div>
            <div class="col-md-3">
                <h5>Matrícula: {{ $matricula->id }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Código do aluno: {{ $matricula->alunos->id }}</h5>
            </div>
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

            <form action="#" method="post">

                @csrf

                <input type="hidden" name="matricula" value="{{ $matricula->id }}">
                <input type="hidden" name="codigoAluno" value="{{$matricula->alunos->id}}">

                <div class="row mb-4">

                    <div class="col-md-2">
                        <label for="data" class="form-label lblCaption">Data</label>
                        <input type="date" class="form-control" name="data" id="name" required  
                            value="{{$bloqueado->data}}">
                    </div>

                    <div class="col-md-2">
                        <label for="hora" class="form-label lblCaption">Horário</label>
                        <input type="time" class="form-control" name="hora" id="hora" required 
                            value="{{$bloqueado->hora}}">
                    </div>

                    <div class="col-md-8">
                        <label for="motivo" class="form-label lblCaption">Motivo</label>
                        <input type="text" class="form-control" name="motivo" id="motivo" required 
                            maxlength="50" value="{{$bloqueado->motivo}}">
                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs"
                        value="{{$bloqueado->obs}}">
                </div>


                <div>
                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
