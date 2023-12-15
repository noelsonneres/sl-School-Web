@extends('layouts.main')
@section('title', 'Alunos por turmas')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Alunos por turma</h4>
        </div>

        <div class="row">

            <div class="col-4">

                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                    Voltar</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

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

        <div class="card pt-2 mt-4 border">

            <table class="table p-1">
                <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                </tr>
                </thead>


                <tbody>
                @foreach ($matriculasTurmas as $turma)
                    <tr>

                        <td>{{ $turma->matriculas_id }} </td>
                        <td>{{ $turma->alunos->nome }} </td>
                        <td>{{ $turma->cadastroDias->dia1 }} - {{ $turma->cadastroDias->dia2 }} </td>
                        <td>{{ $turma->cadastroHorarios->entrada }} - {{ $turma->cadastroHorarios->saida }} </td>
                        <td>{{ $turma->salas->sala }}</td>

                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

{{--    Reposições    --}}
        <hr>
        <div class="card pt-2 mt-4 border">
            <h3 class="ms-5">Lista de reposições</h3>

            <table class="table p-1">
                <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                </tr>
                </thead>


{{--                Criar ps relacionamento para buscar as informações do aluno, dias, horários e sala--}}

                <tbody>
                @foreach ($reposicoes as $reposicao)
                    <tr>

                        <td>{{ $reposicao->matriculas_id }} </td>
                        <td>{{ $reposicao->alunos->nome }} </td>
                        <td>{{ $turma->cadastroDias->dia1 }} - {{ $turma->cadastroDias->dia2 }} </td>
                        <td>{{ $turma->cadastroHorarios->entrada }} - {{ $turma->cadastroHorarios->saida }} </td>
                        <td>{{ $turma->salas->sala }}</td>

                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

    </div>

@endsection
