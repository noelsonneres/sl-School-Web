@extends('layouts.main')
@section('title', 'Caixa')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Iniciar ou encerrar um caixa</h3>
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

                <a href="{{ '/controle_caixa_novo_caixa' }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo caixa</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/dia_pesquisar" method="get">
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

            <div class="table-responsive">
                <table class="table p-1">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DT Abertura</th>
                            <th scope="col">HR Abertura</th>
                            <th scope="col">Saldo anterior</th>
                            <th scope="col">Saldo saldo informado</th>
                            <th scope="col">DT Encerramento</th>
                            <th scope="col">HR Enceramento</th>
                            <th scope="col">Saldo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Operação</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($caixas as $caixa)
                            <tr>
                                <td>{{ $caixa->id }} </td>
                                <td>{{ date('d/m/Y', strtotime($caixa->data_abertura)) }} </td>
                                <td>{{ $caixa->hora_abertura }} </td>
                                <td>R$ {{ number_format($caixa->saldo_anterior, 2, ',', '.') }} </td>
                                <td>R$ {{ number_format($caixa->informado, 2, ',', '.') }} </td>

                                @if ($caixa->data_encerramento != null)
                                    <td>{{ date('d/m/Y', strtotime($caixa->data_encerramento)) }} </td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $caixa->hora_encerramento }} </td>
                                <td>R$ {{ number_format($caixa->saldo_encerramento, 2, ',', '.') }} </td>

                                @if ($caixa->status == 'encerrado')
                                    <td style="color: red">{{ $caixa->status }} </td>
                                @elseif($caixa->status == 'aberto')
                                    <td style="color:forestgreen; font-weight: bold">{{ $caixa->status }} </td>
                                @endif

                                @if ($caixa->status == 'aberto')
                                    <td>
                                        <div class="col-md-5">
                                            <a href="{{ route('controle_caixa.edit', $caixa->id) }}"
                                                class="btn btn-danger btn-sm" title="Encerrar caixa">
                                                Encerrar
                                            </a>
                                        </div>
                                    </td>
                                @endif


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    {{ $caixas->links('pagination::pagination') }}
                </div>
            </div>

        </div>

    </div>

@endsection
