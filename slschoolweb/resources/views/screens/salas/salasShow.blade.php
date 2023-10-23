@extends('layouts.main')
@section('title', 'Lista de salas disponíveis')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Lista de salas disponíveis</h4>
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

                <a href="{{ route('salas.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/dia_pesquisar" method="get">
                    @csrf
                    <input type="text" name="find" id="find" placeholder="Digite o que deseja buscar">
                    <button type="submit" class="btn btn-success btn-sm">Pesquisar
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">


            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Vagas</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salas as $sala)
                        <tr>
                            <td>{{ $horario->id }} </td>
                            <td>{{ $horario->sala }} </td>
                            <td>{{ $horario->vagas }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ route('salas.edit', $sala->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">

                                            <form method="POST" class="delete-form"
                                                action="{{ route('salas.destroy', $sala->id) }}">
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

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    {{ $salas->links('pagination::pagination') }}
                </div>
            </div>

        </div>

    </div>

@endsection
