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

                <form action="/sala_pesquisar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="sala">Sala</option>
                                <option value="descricao">Descrição</option>
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
                            <td>{{ $sala->id }} </td>
                            <td>{{ $sala->sala }} </td>
                            <td>{{ $sala->vagas }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-success btn-sm">
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
 
            <div class="container-fluid pl-5 d-flex justify-content-center">
            {{$salas->links('pagination::pagination')}}
            </div>

        </div>



    </div>

@endsection
