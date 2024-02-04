@extends('layouts.main')
@section('title', 'Bloqueios do alunos')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Lista de Bloqueios dos Alunos</h4>
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

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Cód. Aluno</th>
                        <th scope="col">Aluno</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($listas as $lista)
                        <tr>
                            <td>{{ $lista->alunos->id }} </td>
                            <td>{{ $lista->alunos->nome }} </td>
                            <td>{{ date('d/m/Y', strtotime($lista->data)) }} </td>

                            @if ($lista->status == 'bloqueado')
                                <td style="color: red; font-weight: 800">{{ $lista->status }} </td>
                            @else
                                <td style="color: green; font-weight: 800">{{ $lista->status }} </td>
                            @endif

                            <td>

                                <div>
                                    <div class="row">

                                        @if ($lista->status == 'bloqueado')
                                            <div class="col-2">
                                                <a href="{{ '/desbloquear_alunos_desbloquear/' . $lista->id }}"
                                                    class="btn btn-success btn-sm" title="Desbloquear aluno">
                                                    <i class="bi bi-clipboard-check-fill"></i>
                                                </a>
                                            </div>
                                        @endif

                                        <div class="col-2">
                                            <a href="{{ '/desbloquear_alunos_detalhes/' . $lista->id }}"
                                                class="btn btn-info btn-sm" title="Ver informações do bloqueio">
                                                <i class="bi bi-file-earmark-richtext"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{ $listas->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
