@extends('layouts.main')
@section('title', 'Disciplinas do aluno')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Disciplinas do aluno</h3>
        </div>

        @if (isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <div class="row">

            <div class="col-8">

                <a href="{{ '/matricula_disciplina_adicionar/' . $matricula->id }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    Adicionar Disciplina</a>

                <a href="{{ route('matricula.show', $matricula) }}"class="btn btn-info mb-2">
                    <i class="bi bi-plus-circle-fill"></i>
                    Matrícula </a>

                <button onclick="(print())" class="btn $teal-300 mb-2">Imprimir</button>

            </div>

        </div>

        <hr>
        <div class="m-4">
            <h4>Aluno(a): {{ $matricula->alunos->nome }}</h4>
            <h4>Matrícula: {{ $matricula->id }}</h4>
        </div>
        <hr>

        <div class="card pt-2 mt-4">


            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Disciplina</th>
                        <th scope="col">Início</th>
                        <th scope="col">Término</th>
                        <th scope="col">Concluido</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disciplinas as $disciplina)
                        <tr>
                            <td>{{ $disciplina->id }} </td>
                            <td>{{ Str::substr($disciplina->disciplinas->disciplina, 0, 30) }} </td>

                            <td>
                                @if ($disciplina->inicio)
                                    {{ date('d/m/Y', strtotime($disciplina->inicio)) }}
                            </td>
                    @endif

                    <td>
                        @if ($disciplina->termino)
                            {{ date('d/m/Y', strtotime($disciplina->termino)) }}
                    </td>
                    @endif

                    @if ($disciplina->concluido == 'Concluido')
                        <td style="color: #235e04; font-weight: bold">{{ $disciplina->concluido }} </td>
                    @else
                        <td>{{ $disciplina->concluido }} </td>
                    @endif

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">
                                    <a href="{{ route('matricula_disciplina.edit', $disciplina->id) }}"
                                        title="Atualizar informações sobre o andamento da disciplina"
                                        class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>

                                <div class="col-2">

                                    <form method="POST" class="delete-form"
                                        action="{{ route('matricula_disciplina.destroy', $disciplina->id) }}">
                                        @csrf
                                        {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" title="Remover disciplina"
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

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    {{ $disciplinas->links('pagination::pagination') }}
                </div>
            </div>

        </div>

    </div>

@endsection
