@extends('layouts.main')
@section('title', 'Alunos por turmas')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Alunos por turma</h4>
        </div>


        @if (isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                        justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="cardv pt-2 mt-4">
            <form action="/alunos_por_turma_listar" method="get">
                @csrf
                <div class="row">
                    <label for="selecionar" class="form-label">Selecione a turma</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <select class="form-control" name="selecionar" id="selecionar">
                            @foreach ($listaTurmas as $lista)
                                <option value="{{ $lista->id }}">{{ $lista->turma }} - 
                                        ({{$lista->cadastroDias->dia1}} {{$lista->cadastroDias->dia2}}) -
                                        ({{$lista->cadastroHorarios->entrada}} {{$lista->cadastroHorarios->saida}})
                                </option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-lg">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <div class="card pt-2 mt-4">


            @foreach($turmaMatriculas as $matricula)
                <p>{{$matricula->matriculas_id}} {{$matricula->alunos->nome}}</p>
            @endforeach

        </div>



    </div>

@endsection
