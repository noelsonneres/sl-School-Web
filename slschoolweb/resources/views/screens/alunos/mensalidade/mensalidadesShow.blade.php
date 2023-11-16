
@extends('layouts.main')
@section('title', 'Alunos cadastrados')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Alunos cadastrados</h3>
    </div>
    
    @if(isset($msg))
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="{{route('alunos.create')}}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Novo </a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>     

    </div>

    <hr>

        <h4>Aluno(a): {{$aluno->nome}}</h4>
        <h4>Matrícula: {{$matricula->id}}</h4>

    <hr>

    <div class="card pt-2 mt-4">


        <table class="table p-1">
            <thead>
                <tr>
                    <th scope="col">Mensalidades</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Dt. Pgto</th>
                    <th scope="col">Pago</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($mensalidades as $mensalidade)

                <tr>
                    <td>{{$mensalidade->id}} </td>
                    <td>R$ {{number_format($mensalidade->valor_parcela, '2', ',', '.')}} </td>
                    <td>{{date('d/m/Y', strtotime($mensalidade->vencimento))}} </td>
                    <td>@if ($mensalidade->data_pagamento <> null)
                        {{date('d/m/Y', strtotime($mensalidade->data_pagamento))}}
                    @endif </td>
                    <td>{{$mensalidade->pago}} </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="{{('/selecionar_pagameto/'.$mensalidade->id.'/'.$mensalidade->matriculas_id) }}" 
                                           title="Visualizar informações do alunos" class="btn btn-success btn-sm">
                                           <i class="bi bi-eye"></i>
                                    </a>
                                </div>

                                <div class="col-2">
                                    <a href="{{ route('mensalidades.edit', $mensalidade->id) }}" 
                                           title="Visualizar informações do alunos" 
                                            class="btn btn-info btn-sm">
                                           <i class="bi bi-printer-fill"></i>
                                    </a>
                                </div>                                

                            </div>

                    </td>
                </tr>

                @endforeach                
               
            </tbody>
        </table>

        <div class="row">
            <div>
                {{ $mensalidades->links('pagination::pagination') }}
            </div>
        </div>

    </div>

</div>

@endsection