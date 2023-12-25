@extends('layouts.main')
@section('title', 'Selecionar Alunos')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Selecione o aluno para impressão da carteirinha</h3>
        </div>

        @if(isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
                <h5>{{$msg}} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="row">

            <div class="col-8">

                <form action="/professores_pesquisar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Cód. Aluno</option>
                                <option value="nome">Matrícula</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="find" id="find" placeholder="Digite o que deseja buscar">
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
                    <th scope="col">Cód. Aluno</th>
                    <th scope="col">Matricula</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($matriculas as $matricula)

                    <tr>

                        <td>{{$matricula->alunos_id}} </td>
                        <td>{{$matricula->id}} </td>
                        <td>{{$matricula->alunos->nome}} </td>
                        <td>{{$matricula->cursos->curso}} </td>

                        @if($matricula->status == 'ativa')
                            <td style="color: #0c6135; font-weight: bold">{{$matricula->status}} </td>
                        @else
                            <td style="color: red; font-weight: bolder">{{$matricula->status}} </td>
                        @endif

                        <td>

                            <div>
                                <div class="row">
                                    @if($matricula->status == 'ativa')
                                        <div class="col-2">
                                            <a href="#" class="btn btn-success btn-sm" title="Selecionar o aluno para impressão">
                                                <i class="bi bi-check2-circle" style="font-size: 15px"></i>
                                            </a>
                                        </div>
                                    @endif


                                </div>

                            </div>

                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    {{ $matriculas->links('pagination::pagination') }}
                </div>
            </div>

        </div>

    </div>

@endsection
