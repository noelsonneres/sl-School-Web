@extends('layouts.main')
@section('title', 'Mensalidades por Período')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Mensalidades por Período</h4>
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

            <form action="/rel_mensalidades_periodo_localizar" method="get" id="searchForm">

                <dsiv class="row border ps-3 pb-2">

                    <div class="col-md-4 mt-2 p-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="sim">Pago</option>
                            <option value="nao">Não pagas</option>
                            <option value="cancelado">Canceladas</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for="dt1" class="form-label">Início</label>
                        <input type="date" class="form-control" name="dt1" id="dt1" required>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for="dt2" class="form-label">Término</label>
                        <input type="date" class="form-control" name="dt2" id="dt2" required>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for="filtro" class="form-label">Filtrar por</label>
                        <select class="form-control" name="filtro" id="filtro" required>
                            <option value="vencimento">Data de vencimento</option>
                            <option value="data_pagamento">Data de pagamento</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-3 p-2">
                        <label for=""></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                </dsiv>

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

                                        @if ($mensalidade->pago === 'nao')
                                            <div class="col-2">
                                                <a href="{{ '/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id }}"
                                                    class="btn btn-success btn-sm" title="Quitar mensalidade">
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

    <script>
        // Restaurar valores dos campos ao carregar a página
        window.onload = function() {
            restoreFormValues();
        };

        // Armazenar valores dos campos no armazenamento local ao enviar o formulário
        document.getElementById('searchForm').addEventListener('submit', function() {
            storeFormValues();
        });

        // Função para armazenar valores dos campos no armazenamento local
        function storeFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                localStorage.setItem(element.name, element.value);
            });
        }

        // Função para restaurar valores dos campos do armazenamento local
        function restoreFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                if (localStorage.getItem(element.name)) {
                    element.value = localStorage.getItem(element.name);
                }
            });
        }
    </script>

@endsection
