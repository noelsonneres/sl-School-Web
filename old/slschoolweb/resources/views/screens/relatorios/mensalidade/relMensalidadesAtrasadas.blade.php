@extends('layouts.main')
@section('title', 'Relatório Mensalidades')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Relatório Mensalidades</h4>
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

            <div class="col-5 border">
                <form action="/rel_atrasadas_loc_data" method="get">

                    <div class="row">
                        <div class="col-md-5 mb-2 mt-2">
                            <label for="dt1" class="form-label">Início</label>
                            <input type="date" class="form-control" name="dt1" id="dt1" required>
                        </div>

                        <div class="col-md-5 mb-2 mt-2">
                            <label for="dt2" class="form-label">Término</label>
                            <input type="date" class="form-control" name="dt2" id="dt2" required>
                        </div>

                        <div class="col-md-2 mt-2 p-2">
                            <label for=""></label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <div class="col-md-6 border p-2 ms-1">
                <form action="/rel_atrasadas_loc_atrasadas" method="get">

                    <div class="row">

                        <div class="col-md-7 mb-2 mt-4">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label h4" for="flexCheckChecked">
                                Todas as mensalidades atrasadas
                            </label>
                        </div>

                        <div class="col-md-2">
                            <label for=""></label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>

        <div class="row">

            <form action="/rel_atrasadas_loc_matricula" method="get">

                <div class="row border mt-2">
                    <div class="col-md-3 mb-2 mt-2">
                        <label for="dt1" class="form-label">Início</label>
                        <input type="date" class="form-control" name="dt1" id="dt1" required>
                    </div>

                    <div class="col-md-3 mb-2 mt-2">
                        <label for="dt2" class="form-label">Término</label>
                        <input type="date" class="form-control" name="dt2" id="dt2" required>
                    </div>

                    <div class="col-md-4 mb-2 mt-2">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="number" class="form-control" name="matricula" id="matricula" required>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for=""></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                </div>

            </form>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Mensalidade</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">DT Pagamento</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($mensalidades as $mensalidade)
                        <tr>

                            <td>{{ $mensalidade->id }} </td>
                            <td>{{ $mensalidade->matriculas->id }} </td>
                            <td>{{ $mensalidade->alunos->nome }} </td>
                            <td>R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }}</td>

                            @if ($mensalidade->pago == 'nao' and $mensalidade->vencimento < now())
                                <td style="color: #e30f41; font-weight: bold">
                                    {{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                            @else
                                <td style="color: #053d16; font-weight: bold">
                                    {{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                            @endif

                            @if ($mensalidade->data_pagamento != null)
                                <td>{{ date('d/m/Y', strtotime($mensalidade->data_pagamento)) }} </td>
                            @else
                                <td></td>
                            @endif

                            @if ($mensalidade->pago == 'nao' and $mensalidade->vencimento < now())
                                <td style="color: #e30f41; font-weight: bold">{{ $mensalidade->pago }} </td>
                            @else
                                <td style="color: #053d16; font-weight: bold">{{ $mensalidade->pago }} </td>
                            @endif

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-3">
                                            <a href="{{ '/rel_mensalidades_impressao/' . $mensalidade->id }}"
                                                class="btn btn-primary btn-sm" title="Visualizar informações do aluno">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{  '/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id }}"
                                                class="btn btn-success btn-sm" title="Quitar mensalidade">
                                                <i class="bi bi-currency-dollar"></i>
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
                {{ $mensalidades->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
