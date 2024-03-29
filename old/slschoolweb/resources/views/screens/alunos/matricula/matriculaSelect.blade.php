@extends('layouts.main')
@section('title', 'Matrículas')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Matrículas</h4>
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

                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/matricula_localizar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="alunos_id">Código do aluno</option>
                                <option value="id">Matrícula</option>
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

            <div class="table-responsive">
                <table class="table p-1">
                    <thead>
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Aluno</th>
                            <th scope="col">Cód. Aluno</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Data início</th>
                            <th scope="col">Previsão de término</th>
                            <th scope="col">Ativa</th>
                            <th scope="col">Operações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($matriculas as $matricula)
                            <tr>
                                <td>{{ $matricula->id }} </td>
                                <td>{{ $matricula->alunos->nome }} </td>
                                <td>{{ $matricula->alunos->id }} </td>
                                <td>{{ Str::substr($matricula->cursos->curso, 0, 30) }} </td>
                                <td>{{ date('d/m/Y', strtotime($matricula->data_inicio)) }} </td>
                                <td>{{ date('d/m/Y', strtotime($matricula->data_termino)) }} </td>
                                <td>{{ $matricula->status }} </td>

                                <td>

                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ route('matricula.show', $matricula->id) }}"
                                                title="Visualizar informações do matricula" class="btn btn-primary btn-sm">
                                                <i class="bi bi-card-list"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('alunos.edit', $matricula->alunos_id) }}"
                                                title="Visualizar informações do aluno" class="btn btn-success btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ '/responsavel_adicionar/' . $matricula->alunos->id . '/' . $matricula->alunos->nome }}"
                                                title="Visualizar informações do responsável" class="btn btn-info btn-sm">
                                                <i class="bi bi-person-rolodex"></i>
                                            </a>
                                        </div>

                                        <div class="col-3">

                                            <form method="POST" class="delete-form"
                                                action="{{ route('matricula.destroy', $matricula->id) }}">
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

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{ $matriculas->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
