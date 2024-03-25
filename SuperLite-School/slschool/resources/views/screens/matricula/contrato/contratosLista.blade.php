@extends('layout.main')
@section('title', 'Sl-School - Contratos disponíveis')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contratos disponíveis</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Contratos disponíveis</h4>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h5>Nome: {{$matricula->alunos->nome}}</h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h5>Matrícula: {{$matricula->id}}</h5>
                        </div>
                    </div>

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
                    <hr>
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100 ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descrição</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato->id }}</td>
                                    <td>{{ $contrato->descricao }}</td>
                                    <td>
                                        <div>
                                            <div class="row">

                                                <div class="col-2">
                                                    <a href="{{('/contrato_gerar/'.$matricula->id.'/'.$contrato->id)}}"
                                                        class="btn btn-primary btn-sm"
                                                        title="Gerar contrato">
                                                        <i class="uil-file-bookmark-alt"></i>
                                                    </a>
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
                            {{ $contratos->links('pagination::pagination') }}
                        </div>
                    </div>

                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
