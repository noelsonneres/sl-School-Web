@extends('layouts.main')
@section('title', 'Turmas Disponíveis')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Turmas disponíveis</h4>
        </div>

        <div class="row p-2">

            <div class="col md-4">
                <h4>Aluno(a): {{ $matricula->alunos->nome }}</h4>
            </div>

            <div class="col-md-2">
                <h4>Matricula: {{ $matricula->id }}</h4>
            </div>

            <div class="col-md-6">
                <h4>Curso: {{ $matricula->cursos->curso }}</h4>
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

        <div class="row">

            <div class="col-4">

                <a href="{{ route('salas.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/sala_pesquisar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="sala">Sala</option>
                                <option value="descricao">Descrição</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="find" id="find"
                                   placeholder="Digite o que deseja buscar">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-sm">Pesquisar</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Turma</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>


                <tbody>
                @foreach ($turmas as $turma)
                    <tr>
                        <td>{{ $turma->id }} </td>
                        <td>{{$turma->turma}}  </td>
                        <td>{{$turma->cadastroDias->dia1}} - {{$turma->cadastroDias->dia2}}</td>
                        <td>{{$turma->cadastroHorarios->entrada}} - {{$turma->cadastroHorarios->saida}}</td>
                        <td>{{$turma->sala->sala}} - {{$turma->sala->vagas}}</td>

                        <td>
                            <div class="col-3">
                                <a href="{{ ('/reposicao_selecionar/'.$matricula->id.'/'.$turma->id) }}" class="btn btn-info btn-sm "
                                    title="Selecionar turma para reposição">
                                    <i class="bi bi-check-square-fill"></i>
                                </a>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>


            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{$turmas->links('pagination::pagination')}}
            </div>

        </div>


    </div>

@endsection
