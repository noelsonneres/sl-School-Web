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

            <div class="col border p-2 me-3">
                <form action="/rel_mensalidades_loc_data" method="get">
                    @csrf
        
                    <div class="row pe-3">
        
                        <div class="col-md-3 mb-3">
                            <label for="dtTipo" class="form-label">Tipo</label>
                            <select class="form-control" name="dtTipo" id="dtTipo">
                                <option value="vencimento">Vencimento</option>
                                <option value="data_pagamento">Pagamento</option>
                            </select>
                        </div>
        
                        <div class="col-md-4 mb-3">
                            <label for="dt1" class="form-label">Primeira data</label>
                            <input type="date" class="form-control" name="dt1" id="dt1">
                        </div>
        
                        <div class="col-md-4 mb-3">
                            <label for="dt2" class="form-label">Segunda data</label>
                            <input type="date" class="form-control" name="dt2" id="dt2">
                        </div>
        
                        <div class="col-md-1 mt-2 mb-3">
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
        
            <div class="col-5 border p-2">
                <form action="/rel_matricula_localizar" method="get">
                    @csrf
        
                    <div class="row">
        
                        <div class="col-md-4 mb-3">
                            <label for="opt" class="form-label">Critério de pesquisa</label>
                            <select class="form-control" name="opt" id="opt" aria-label="Critério de pesquisa">
                                <option value="id">Matrícula</option>
                                <option value="alunos_id">Cód. Aluno</option>
                            </select>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label for="find" class="form-label">Caixa de pesquisa</label>
                            <input type="text" class="form-control" name="find" id="find" placeholder="Digite o que deseja buscar" aria-label="Informação de busca">
                        </div>
        
                        <div class="col-md-2 mt-2">
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
        

        <hr>

        <div class="row border p-2">

            <form action="/rel_matricula_loc_status" method="get">
                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <label for="ativo" class="form-label">Selecionar pelo status da matrícula</label>
                        <select class="form-control" name="ativo" id="ativo">
                            <option value="ativa">Ativa</option>
                            <option value="bloqueado">Bloqueado</option>
                            <option value="trancada">Trancada</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="finalizada">Finalizada</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-2">
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

                {{-- date('d/m/Y', strtotime($mensalidade->data_inicio))  --}}

                <tbody>
                    @foreach ($mensalidades as $mensalidade)
                        <tr>

                            <td>{{ $mensalidade->id }} </td>
                            <td>{{ $mensalidade->matriculas->id }} </td>
                            <td>{{ $mensalidade->alunos->nome }} </td>
                            <td>R$ {{number_format($mensalidade->valor_parcela, '2', ',', '.')}}</td>

                            @if ($mensalidade->pago == 'nao' and $mensalidade->vencimento < now())
                                <td style="color: #e30f41; font-weight: bold">{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                            @else
                            <td style="color: #053d16; font-weight: bold">{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                            @endif

                            @if($mensalidade->data_pagamento != null)
                                <td>{{ date('d/m/Y', strtotime($mensalidade->data_pagamento))  }} </td>
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

                                        <div class="col-2">
                                            <a href="{{ ('/rel_mensalidades_impressao/'.$mensalidade->id) }}" class="btn btn-success btn-sm"
                                                title="Visualizar informações do aluno">
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

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{ $mensalidades->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
