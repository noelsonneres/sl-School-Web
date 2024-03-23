@extends('layout.main')
@section('title', 'Sl School - Atualizar mensalidade')
@section('content')

    <script src="/assets/js/masks.js"></script>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mensalidades</a></li>
                            <li class="breadcrumb-item active">Atualizar informações das mensalidades</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Atualizar informações das mensalidades</h4>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif

                    @if (isset($msgErro))
                        <div class="alert alert-danger alert-dismissible fade show msg d-flex 
                            justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msgErro }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('erro'))
                        <div class="alert alert-danger alert-dismissible fade show msg d-flex 
                    justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h6 style="color: red">{{ session('erro') }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- Fim do bloco de mensagens e erros --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Prencha os campos abaixo</h4>
                        <p class="text-muted font-14">
                            Os campos com "<span class="text-danger">*</span>" são obrigátorios
                        </p>

                        <hr>

                        <div class="card border p-2">
                            <form action="{{ ('/mensalidades_atualizar/'.$mensalidade->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="matricula" value="{{ $mensalidade->id }}">
                                <input type="hidden" name="aluno" value="{{ $mensalidade->alunos_id }}">
                                <input type="hidden" name="responsavel" value="{{ $mensalidade->responsavel_alunos_id }}">

                                {{-- Info Aluno --}}
                                <div class="card mb-4 p-3">

                                    <h5 class="mb-3">Informações da mensalidade</h5>

                                    <div class="row">

                                        <div class="col-md-2 mb-4">
                                            <label for="codAluno" class="form-label">Código do aluno</label>
                                            <input type="text" class="form-control" id="codAluno"
                                                value="{{ $mensalidade->alunos_id }}" required>
                                        </div>

                                        <div class="col-md-2 mb-4">
                                            <label for="matricula" class="form-label">Matrícula</label>
                                            <input type="text" class="form-control" id="matricula"
                                                value="{{ $mensalidade->matriculas->id }}" readonly>
                                        </div>

                                        <div class="col-md-8 mb-4">
                                            <label for="nome" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome"
                                                value="{{ $mensalidade->alunos->nome }}">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 mb-4">
                                            <label for="mensalidade" class="form-label">Mensalidade</label>
                                            <input type="text" class="form-control" name="mensalidade" id="mensalidade"
                                                value="{{ $mensalidade->id }}" readonly>
                                        </div>

                                        <div class="col md-3 mb-4">
                                            <label for="valorParcela" class="form-label">Valor da parcela</label>
                                            <input type="text" class="form-control" name="valorParcela" id="valorParcela"
                                                value="{{ $mensalidade->valor_parcela }}" readonly>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="numeroParcela" class="form-label">Número da parcela</label>
                                            <input type="text" class="form-control" name="numeroParcela"
                                                id="numeroParcela" value="{{ $mensalidade->numero_mensalidade }}"
                                                readonly>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="vencimento" class="form-label">Vencimento</label>
                                            <input type="text" class="form-control" name="vencimento" id="vencimento"
                                                value="{{ date('d/m/Y', strtotime($mensalidade->vencimento)) }}" readonly>
                                        </div>

                                    </div>

                                </div>
                                {{-- Fim Info Aluno --}}

                                {{-- Informações quitação --}}

                                <div class="row">

                                    <h5 class="mb-3">Valores atualizados</h5>

                                    <div class="col-md-6 mb-4">
                                        <label for="valor" class="form-label">Valor da parcela</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01" class="form-control"
                                            name="valor" id="valor" value="{{ $mensalidade->valor_parcela }}"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="vencimento" class="form-label">Vencimento</label>
                                        <input type="date" class="form-control" name="vencimento" id="vencimento"
                                            value="{{$mensalidade->vencimento}}" required>
                                    </div>

                                </div>

                                {{-- Fim Informações quitação --}}

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success">Salvar
                                        <i class="ri-save-3-fill"></i>
                                    </button>
                                    <a href="javascript:history.back()" class="btn btn-danger">Cancelar
                                        <i class=" ri-close-circle-fill"></i>
                                    </a>
                                </div>

                            </form>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
