@extends('layouts.main')
@section('title', 'Lista de mensalidades')
@section('content')

    <style>
        .pago {
            color: green;
        }

        .a-vencer {
            color: blue;
        }

        .vencido {
            color: red;
        }
    </style>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Mensalidades</h3>
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

            <div class="col-6">

                <a href="{{('/mensalidades_adicionar/'.$matricula->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Incluir mensalidade </a>

                <a href="{{'/mensalidades_impressao/'.$matricula->id }}"class="btn btn-info">
                    <i class="bi bi-printer-fill"></i>
                    Carnê de pagamento</a>  

                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

        </div>

        <hr>

        <h4>Aluno(a): {{ $aluno->nome }}</h4>
        <h4>Matrícula: {{ $matricula->id }}</h4>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1 table-striped">
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
                        <tr class="pago">
                            @if ($mensalidade->pago == 'sim')
                                <td style="color: #34d74a; font-weight: bold">{{ $mensalidade->id }} </td>
                                <td style="color: #34d74a; font-weight: bold">R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }} </td>
                                <td style="color: #34d74a; font-weight: bold">{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                                <td style="color: #34d74a; font-weight: bold">
                                    @if ($mensalidade->data_pagamento != null)
                                        {{ date('d/m/Y', strtotime($mensalidade->data_pagamento)) }}
                                    @endif
                                </td>
                                <td style="color: #34d74a; font-weight: bold">{{ $mensalidade->pago }} </td>

                                @elseif ($mensalidade->pago == 'nao' and $mensalidade->vencimento < now())
                                <td style="color: #e30f41; font-weight: bold">{{ $mensalidade->id }} </td>
                                <td style="color: #e30f41; font-weight: bold">R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }} </td>
                                <td style="color: #e30f41; font-weight: bold">{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }} </td>
                                <td style="color: #e30f41; font-weight: bold">
                                    @if ($mensalidade->data_pagamento != null)
                                        {{ date('d/m/Y', strtotime($mensalidade->data_pagamento)) }}
                                    @endif
                                </td>
                                <td style="color: #e30f41; font-weight: bold">{{ $mensalidade->pago }} </td>

                            @else
                                <td style="color: font-weight: bold">{{ $mensalidade->id }} </td>
                                <td style="color: font-weight: bold">R$ {{number_format($mensalidade->valor_parcela, '2', ',', '.')}} </td>
                                <td style="color: font-weight: bold">{{date('d/m/Y', strtotime($mensalidade->vencimento))}} </td>
                                <td style="color: font-weight: bold">@if ($mensalidade->data_pagamento <> null)
                                    {{date('d/m/Y', strtotime($mensalidade->data_pagamento))}}
                                @endif </td>
                                <td>{{$mensalidade->pago}} </td> 

                            @endif

                            <td>

                                <div class="row">

                                    <div class="col-2">
                                        <a href="{{ '/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id }}"
                                            title="Informar quitação" class="btn btn-success btn-sm">
                                            <i class="bi bi-currency-dollar"></i>
                                        </a>
                                    </div>

                                    <div class="col-2">
                                        <a href="{{route('mensalidades.edit', $mensalidade->id)}}"
                                            title="Editar mensalidade" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </div>

                                    <div class="col-2">

                                        <form method="POST" class="delete-form" action="{{ route('mensalidades.destroy', $mensalidade->id) }}">
                                            @csrf
                                            {{-- o método HTTP para exclusão deve ser o DELETE --}}
                                            @method('DELETE')
                                            <button type="button" title="Excluir professor" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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
