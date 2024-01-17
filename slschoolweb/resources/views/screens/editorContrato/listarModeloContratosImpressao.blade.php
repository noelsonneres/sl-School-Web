@extends('layouts.main')
@section('title', 'Selecione o contrato para impressão')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Selecione o contrato para impressão</h3>
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

                <a href="{{ route('contrato.create') }}" class="btn btn-primary" title="Criar novo curso">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo Contrato</a>

            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Operação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratos as $contrato)
                        <tr>
                            <td>{{ $contrato->id }} </td>
                            <td>{{ $contrato->descricao }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{'/contrato_iniciar/'.$matricula.'/'.$contrato->id}}"
                                                title="Editar informações do professor" class="btn btn-info btn-sm">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div>
                    {{ $contratos->links('pagination::pagination') }}
                </div>
            </div>

        </div>

    </div>

@endsection
