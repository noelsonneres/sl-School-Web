@extends('layout.main')
@section('title', 'Sl-School - Mensalidades do aluno')
@section('content')

    <!-- Start Content -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Matrículas</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Mensalidades</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Mensalidades do aluno</h4>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif
                    {{-- Fim da mensagem de sucesso ou erro --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="pt-3 ps-4">
                                <a href="{{'/mensalidades_adicionar/'. $matricula->id}}" class="btn btn-primary">Adicionar mensalidade</a>
                                <a href="{{'/mensalidades_impressao/'.$matricula->id}}" class="btn btn-secondary">Imprimir carnê</a>
                                <a href="{{ '/dashboard/' . $matricula->id }}" class="btn btn-danger">Voltar</a>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Aluno</th>
                                <th>Matrícula</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Pago</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($mensalidades as $mensalidade)
                                <tr>
                                    <td>{{ $mensalidade->id }}</td>
                                    <td>{{ $mensalidade->alunos->nome }}</td>
                                    <td>{{ $mensalidade->matriculas_id }}</td>
                                    <td>R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }}</td>
                                    <td>{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }}</td>
                                    <td>{{ $mensalidade->pago }}</td>

                                    <td>
                                        <div>
                                            <div class="row">

                                                @if ($mensalidade->pago == 'nao')
                                                    <div class="col-sm-2">
                                                        <a href="{{ route('mensalidades.edit', $mensalidade->id) }}"
                                                            class="btn btn-success btn-sm"
                                                            title="Editar as informações da mensalidade">
                                                            <i class="uil-edit-alt"></i>
                                                        </a>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <a href="{{ '/mensalidades_quitar/' . $mensalidade->id }}"
                                                            class="btn btn-primary btn-sm" title="Quitar mensalidade">
                                                            <i class="uil-check-circle"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                                @if ($mensalidade->pago == 'sim')
                                                    <div class="col-sm-2">
                                                        <a href="{{ route('turmas.edit', $mensalidade->id) }}"
                                                            class="btn btn-warning btn-sm" title="Estornar mensalidade">
                                                            <i class="uil-times-circle"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                                @if ($mensalidade->pago != 'sim')
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" title="Excluir mensalidade selecionada"
                                                            data-bs-target="#myModal{{ $mensalidade->id }}">
                                                            <i class="uil-trash-alt"></i>
                                                        </button>
                                                @endif

                                                {{-- Modal --}}
                                                <div class="modal fade" id="myModal{{ $mensalidade->id }}" tabindex="-1"
                                                    aria-labelledby="myModalLabel{{ $mensalidade->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="myModalLabel{{ $mensalidade->id }}">Deseja
                                                                    deletar o dia selecionado?</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form method="POST" enctype="multipart/form-data"
                                                                    action="{{ route('mensalidades.destroy', $mensalidade->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <h3>Tem certeza que deseja deletar a mensalidade
                                                                        selecionado? Se houver turmas com o dia
                                                                        atrelado, não será possível a exclusão</h3>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cancelar</button>
                                                                        <button type="submit" class="btn btn-danger">Sim,
                                                                            quero
                                                                            deletar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Fim Modal --}}
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
                        {{ $mensalidades->links('pagination::pagination') }}
                    </div>
                </div>

            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
