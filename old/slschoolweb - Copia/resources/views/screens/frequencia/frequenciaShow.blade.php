@extends('layouts.main')
@section('title', 'Frequência do aluno')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Frequência do aluno</h4>
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

        <div class="row justify-content-between">

            <div class="col-4">

                <a href="{{ ('/frequencia_adicionar/'.$matricula->id) }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    Nova</a>

                <button onclick="(print())" class="btn btn-info mb-2">Imprimir</button>

                <a href="{{('/exibirInfoMatricula/'.$matricula->id)}}" class="btn btn-danger mb-2">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                    Voltar
                </a>
            </div>

            <div class="col-6">

                <form action="/frequencia_localizar" method="get">
                    @csrf

                    <input type="hidden" name="matricula" value="{{ $matricula->id }}">

                    <div class="row">

                        <div class="col-md-3">
                            <input type="date" class="form-control" name="inicio" id="inicio">
                        </div>

                        <div class="col-md-3">
                            <input type="date" class="form-control" name="fim" id="fim">
                        </div>

                        <div class="col-md-2 mt-2">
                            <button type="submit" class="btn btn-success">Pesquisar</button>
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
                    <th scope="col">Frequência</th>
                    <th scope="col">Data frequência</th>
                    <th scope="col">Hora frequência</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">situação</th>
                    <th scope="col">Opereação</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($frequencias as $frequencia)
                    <tr>
                        <td>{{ $frequencia->id }} </td>
                        <td>{{date('d/m/Y', strtotime($frequencia->data_presenca))}} </td>
                        <td>{{ $frequencia->hora_presenca}} </td>
                        <td>{{ $frequencia->disciplinas->disciplina}} </td>
                        <td>{{ $frequencia->situacao}} </td>
                        <td>

                            <div>
                                <div class="row">

                                    <div class="col-2">
                                        <a href="{{ route('frequencia.edit', $frequencia->id) }}"
                                           class="btn btn-success btn-sm"
                                           title="Editar informações da frequência">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>

                                    <div class="col-2">

                                        <form method="POST" class="delete-form"
                                              action="{{ route('frequencia.destroy', $frequencia->id) }}">
                                            @csrf
                                            {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete(this)">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(button) {
                                                if (confirm('Tem certeza de que deseja excluir este item?')) {
                                                    var form = button.closest('form');
                                                    form.submit();
                                                }
                                            }
                                        </script>

                                    </div>

                                </div>

                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{$frequencias->links('pagination::pagination')}}
            </div>

        </div>


    </div>

@endsection
