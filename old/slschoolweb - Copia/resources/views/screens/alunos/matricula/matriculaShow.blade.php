
@extends('layouts.main')
@section('title', 'Matrículas do aluno')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Matrículas do aluno</h3>
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
        <h5>Cód. Aluno(a): {{$aluno->id}} </h5>
        <h5>Responsável: {{$responsavel->nome}}</h5>

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="{{'/matricula_adicionar/'.$aluno->id}}"class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Nova Matrícula </a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>     

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Data início</th>
                    <th scope="col">Data término</th>
                    <th scope="col">Ativa</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($matriculas as $matricula)

                <tr>
                    <td>{{$matricula->id}} </td>
                    <td>{{ Str::substr($matricula->cursos->curso, 0, 30)}} </td>
                    <td>{{date('d/m/Y', strtotime($matricula->data_inicio))}} </td>
                    <td>{{date('d/m/Y', strtotime($matricula->data_termino))}} </td>
                    <td>{{$matricula->status}} </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="{{ route('matricula.show', $matricula->id) }}" 
                                           title="Visualizar informações do matricula" class="btn btn-primary btn-sm">
                                           <i class="bi bi-card-list"></i>
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

        <div class="row">
            <div>
                {{ $matriculas->links('pagination::pagination') }}
            </div>
        </div>

    </div>

</div>

@endsection