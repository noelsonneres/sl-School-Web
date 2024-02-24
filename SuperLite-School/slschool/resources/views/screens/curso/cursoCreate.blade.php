@extends('layout.main')
@section('title', 'Sl School - Novo Curso')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadatro base</a></li>
                            <li class="breadcrumb-item active">Novo Curso</li>
                        </ol>
                    </div>

                    <h4 class="page-title">Cadastrar novo curso</h4>

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
                            <form action="{{ route('disciplinas.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="mb-4">
                                    <label for="curso" class="form-label">Curso <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="curso" id="curso" required
                                        maxlength="50">
                                </div>

                                <div class="mb-4">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao"
                                        maxlength="100">
                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="valorAVista" class="form-label"> Valor a vista</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorAVista" id="valorAVista">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorComDesconto" class="form-label">Valor com desconto</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorAVista" id="valorAVista">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="qtdeParcelas" class="form-label">Qtde. Parcelas <span
                                                class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="qtdeParcelas" id="qtdeParcelas"
                                            required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorPorParcela" class="form-label">Valor por parcela</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorPorParcela" id="valorPorParcela">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-4">
                                        <label for="duracao" class="form-label">Duração <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="duracao" id="duracao" required>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="cargaHoraria" class="form-label">Carga horária <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="cargaHoraria" id="cargaHoraria" required>
                                    </div>

                                    <div class="col md-4 mb-4">
                                        <label for="ativo" class="form-label">Ativo <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="ativo" id="ativo" required>
                                            <option value="">Selecione uma opcão</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                    </div>                                    

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs" max="255">
                                </div>

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
