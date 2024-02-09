@extends('layouts.main')
@section('title', 'Grade de horários')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Grade de horários</h3>
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

        <div class="row">

            <form action="/grade_horarios_filtrar" method="get">
                @csrf

                <div class="row">

                    <div class="col-md-4">
                        <select class="form-control" name="sala" id="sala">
                            <option value="">selecione a sala</option>

                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}">{{ $sala->sala }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-control" name="dia" id="dia">
                            <option value="">Selecione um dia de aula</option>

                            @foreach ($dias as $dia)
                                <option value="{{ $dia->id }}">{{ $dia->dia1 }} - {{ $dia->dia2 }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-sm">Pesquisar</button>
                    </div>

                </div>

            </form>


        </div>

        <hr>

        <div class="card mt-4">


            <div class="row ms-1 p-2">

                @foreach ($turmas as $turma)
                    <div class="col-md-3 card rounded-4 p-0 me-2 shadow"
                        style="height: 150px; background: rgb(38, 165, 216)">
                        <a href="{{('/grade_horarios_alunos/'.$turma->id)}}" class="link-card">
                            <div class="card-body">
                                <h4 class="text-white" style="font-weight: 600">{{ Str::substr($turma->turma, 0, 50) }}</h4>
                                <h5 class="text-white" style="font-weight: 500">{{ $turma->sala->sala }}
                                    ({{ $turma->sala->vagas }})</h5>
                                <h6 class="text-white" style="font-weight: 500">{{ $turma->cadastroDias->dia1 }} -
                                    {{ $turma->cadastroDias->dia2 }}</h6>
                                <h6 class="text-white" style="font-weight: 500">{{ $turma->cadastroHorarios->entrada }} -
                                    {{ $turma->cadastroHorarios->saida }}</h6>
                                <h6 class="text-white" style="font-weight: 500"></h6>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

@endsection
