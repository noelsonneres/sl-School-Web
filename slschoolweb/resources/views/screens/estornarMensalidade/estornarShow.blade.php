@extends('layouts.main')
@section('title', 'Estornar mensalidades')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Estornar Mensalidades</h4>
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
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/estornar_mensalidade_localizar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Mensalidade</option>
                                <option value="matriculas_id">Matricula</option>
                                <option value="alunos_id">Cód. Aluno</option>
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

            <table class="table p-1 table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Matricula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">valor</th>
                    <th scope="col">venc</th>
                    <th scope="col">DT. Pgto</th>
                    <th scope="col">Vlr. Pago</th>
                    <th scope="col">Operações</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($mensalidades as $mensalidade)
                    <tr>

                        <td>{{ $mensalidade->id }} </td>
                        <td>{{ $mensalidade->matriculas_id }} </td>
                        <td>{{ $mensalidade->alunos->nome }} </td>
                        <td>R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.' )}} </td>
                        <td>{{ date('d/m/Y', strtotime($mensalidade->vencimento ))}} </td>
                        <td> @if($mensalidade->data_pagamento != null)
                                {{date('d/m/Y', strtotime( $mensalidade->data_pagamento ))}} </td>
                            @endif
                        <td>R$ {{ number_format($mensalidade->valor_pago, '2', ',', '.') }} </td>

                        <td>

                            <div>
                                <div class="row">

                                    <div class="col-2">
                                        <a href="{{ url('/estornar_mensalidade_estornar/'.$mensalidade->id) }}"
                                           class="btn btn-danger btn-sm estornar-link">
                                            <i class="bi bi-arrow-clockwise" style="font-size: 15px"></i>
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
                {{$mensalidades->links('pagination::pagination')}}
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".estornar-link").click(function(e){
                e.preventDefault();

                var confirmacao = confirm("Tem certeza de que deseja estornar a mensalidade?");

                if(confirmacao){
                    window.location.href = $(this).attr("href");
                }
            });
        });
    </script>

@endsection
