@extends('layouts.main')
@section('title', 'Relatótio Entrada de valores')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Relatótio Entrada de valores</h4>
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

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($entradas as $entrada)
                    <tr>

                        <td>{{ $entrada->id }} </td>
                        <td>{{date('d/m/Y', strtotime($entrada->data))}} </td>
                        <td>{{ $entrada->hora}} </td>
                        <td>{{ $entrada->motivo }} </td>
                        <td>{{ $entrada->valor }} </td>

                        <td>

                            <div>
                                <div class="row">

                                    <div class="col-2">
                                        <a href="{{ route('reposicoes.edit', $reposicao->id) }}"
                                           class="btn btn-success btn-sm"
                                           title="Editar informações da frequência">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>

                                    <div class="col-2">

                                        <form method="POST" class="delete-form"
                                              action="{{ route('reposicoes.destroy', $reposicao->id) }}">
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
                {{$entradas->links('pagination::pagination')}}
            </div>

        </div>


    </div>

@endsection
