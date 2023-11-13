
@extends('layouts.main')
@section('title', 'Turmas do aluno')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Turmas do aluno</h3>
    </div>

    @if(isset($msg))
    <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

        <h4>Aluno(a): {{$aluno->nome}}</h4>
        <h4>Matrícula: {{$matricula}}</h4>
        <h5>Responsável: {{$responsavel->nome}}</h5>

    <hr>

    <div class="row">

        <div class="col-4">
            <a href="{{('/turmas_matriculas_inserir/'.$matricula)}}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Adicionar turma </a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>
        </div>

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Turma</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($turmas as $turma)

                <tr>
                    <td>{{$turma->turmas->turma}} </td>
                    <td>{{$turma->turmas->dias->dia1}} - {{$turma->turmas->dias->dia2}} </td>
                    <td>{{$turma->turmas->horarios->entrada}} - {{$turma->turmas->horarios->saida}} </td>

                    <td>

                            <div class="row">
                                <div class="col-3">

                                    <form method="POST" class="delete-form"
                                        action="{{('/turmas_matriculas_remover/'.$matricula.'/'.$turma->id) }}">
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

        <div class="row">
            <div>
                {{ $turmas->links('pagination::pagination') }}
            </div>
        </div>

    </div>

</div>

@endsection
