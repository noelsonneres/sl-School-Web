
@extends('layouts.main')
@section('title', 'Disciplinas do professor')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Disciplinas do professor</h3>
    </div>

    <hr>
        <h5>Professor(a): {{$professor->nome}}</h5>


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

            <a href="{{'/adicionar/'.$professor->id}}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Incluir disciplina</a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

        <div class="col-8 text-end">
            <a href="{{route('professores.index')}}" class="btn btn-danger">Voltar</a>
        </div>

    </div>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Cód. Disciplina</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discProf as $disc)

                <tr>
                    <td>{{$disc->disciplinas_id}} </td>
                    <td>{{$disc->disciplinas->disciplina}} </td>

                    <td>

                        <div>
                            <div class="row">

                                <div class="col-2">

                                    <form method="POST" class="delete-form" action="{{ route('professor_disciplina.destroy', $disc->id) }}">
                                        @csrf
                                        {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                        @method('DELETE')
                                        <button type="button" title="Excluir a disciplina do professor" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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
                {{ $discProf->links('pagination::pagination') }}
            </div>
        </div>

    </div>

</div>

@endsection