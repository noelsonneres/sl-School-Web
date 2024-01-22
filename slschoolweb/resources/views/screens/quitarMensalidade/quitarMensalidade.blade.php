@extends('layouts.main')
@section('title', 'Localizar mensalidade')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Localizar mensalidade</h4>
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

            </div>

            <div class="col-8">

                <form action="/quitar_mensalidade_localizar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Mensalidade</option>
                                <option value="matriculas_id">Matrícula</option>
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
                        <th scope="col">Mensalidade</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Nome</th>
                        <th scope="col">valor</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($mensalidades as $mensalidade)
                        <tr>
                            <td>{{ $mensalidade->id }} </td>
                            <td>{{ $mensalidade->matriculas_id }} </td>
                            <td>{{ $mensalidade->alunos->nome }} </td>
                            <td>R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }} </td>
                            <td>{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                            <td>{{ $mensalidade->pago }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        @if ($mensalidade->pago === 'nao')
                                            <div class="col-2">
                                                <a href="{{ '/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id }}"
                                                    title="Informar quitação" class="btn btn-success btn-sm">
                                                    <i class="bi bi-currency-dollar"></i>
                                                </a>
                                            </div>
                                        @endif

                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{ $mensalidades->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
