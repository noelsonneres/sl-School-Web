@extends('layouts.main')
@section('title', 'Frequência - Localizar matrícula')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Lançamento de frequência - Localizar matrícula</h3>
    </div>

    @if(isset($msg))
    <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="row ps-5">

        <div class="col-8">

            <form action="/frequencia_localiza_matricula" method="get">
                @csrf

            <div class="row">

                <div class="col-md-3">
                    <select class="form-control" name="opt" id="opt">
                        <option value="id">Matrícula</option>
                        <option value="alunos_id">Código do aluno</option>
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
                    <th scope="col">Matrícula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matriculas as $matricula)

                <tr>
                    <td>{{$matricula->id}} </td>
                    <td>{{$matricula->alunos->nome}} </td>
                    <td>{{$matricula->cursos->curso}} </td>
                    <td>{{$matricula->status}} </td>

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">
                                    <a href="{{ route('frequencia.show', $matricula->id) }}" class="btn btn-info btn-sm"
                                        title="Lançar frequência do aluno" >
                                        <i class="bi bi-check-circle-fill"></i>
                                    </a>
                                </div>

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
