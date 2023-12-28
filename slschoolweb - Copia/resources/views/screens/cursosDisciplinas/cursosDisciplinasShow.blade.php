
@extends('layouts.main')
@section('title', 'Lista de disciplinas do curso')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Lista das Disciplinas</h3>
    </div>
    <hr>
        <h4>Curso: {{$curso}}</h4>
        <h5>Cód. Curso: {{$cursoId}}</h5>


    @if(isset($msg))
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="{{'/ad_curso_disciplinas/'.$cursoId}}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Nova disciplina</a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Carga horária</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($disciplinas as $disciplina)

                <tr>
                    <td>{{$disciplina->disciplinas->id}} </td>
                    <td>{{$disciplina->disciplinas->disciplina}} </td>
                    <td>{{$disciplina->disciplinas->duracao_meses}} </td>
                    <td>{{$disciplina->disciplinas->carga_horaria}} </td>

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">

                                    <form method="POST" class="delete-form" action="{{'/deletar_curso_disciplina/'. $disciplina->id }}">
                                        @csrf
                                        {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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