@extends('layouts.main')
@section('title', 'Motivos de cancelamentos')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Motivos de cancelamentos</h4>
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

                <a href="{{ route('motivos_cancelamento.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/motivos_cancelamento_find" method="get">
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
                        <th scope="col">Forma de pagamento</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motivos as $motivo)
                        <tr>
                            <td>{{ $motivo->id }} </td>
                            <td>{{ $motivo->motivo }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ route('motivos_cancelamento.edit', $motivo->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">

                                            <form method="POST" class="delete-form"
                                                action="{{ route('motivos_cancelamento.destroy', $motivo->id) }}">
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
                    {{ $motivos->links('pagination::pagination') }}
                </div>
            </div>

        </div>

    </div>

@endsection
