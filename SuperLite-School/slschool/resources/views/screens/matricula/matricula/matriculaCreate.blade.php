@extends('layout.main')
@section('title', 'Sl School - Nova matrícula')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">matriculas</a></li>
                            <li class="breadcrumb-item active">Nova matrícula</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Nova matrícula</h4>
                    {{-- <h5 class="ms-2 mb-3">Aluno(a): {{$aluno->nome}}</h5> --}}

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
                            <form action="{{ route('matricula.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <input type="hidden" name="aluno" value="{{$aluno->id}}">
                                <input type="hidden" name="responsavel" value="{{$responsavelID}}">

                                <div class="card border p-3">

                                    <div class="row">

                                        <div class="col-md-2">
                                            <label for="codAluno" class="form-label">Código do aluno</label>
                                            <input type="text" class="form-control" name="codAluno" id="codAluno"
                                                value="{{ $aluno->id }}" required>
                                        </div>

                                        <div class="col-md-10">
                                            <label for="nome" class="form-label">Nome do aluno</label>
                                            <input type="text" class="form-control" name="nome" id="nome"
                                                value="{{ $aluno->nome }}" readonly>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="curso" class="form-label">Curso <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="curso" id="curso" required>
                                            <option value="">Selecione um curso</option>
                                            @foreach ($listaCursos as $lista)
                                                <option value="{{ $lista->id }}">{{ $lista->curso }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="qtdeParcelas" class="form-label">Quantidade parcelas <span
                                                class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="qtdeParcelas" id="qtdeParcelas"
                                            required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorAVista" class="form-label">Valor a vista
                                            <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="valorAVista" id="valorAVista"
                                            required>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="valorDesconto" class="form-label">Valor com desconto
                                            <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="valorDesconto" id="valorDesconto"
                                            required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorParcelado" class="form-label">Valor parcelado<span
                                                class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="valorParcelado"
                                            id="valorParcelado" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorPorPacela" class="form-label">Valor por parcela <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="valorPorPacela"
                                            id="valorPorPacela" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="vencimento" class="form-label">Vencimento</label><span
                                            class="text-danger">*</span>
                                        <input type="date" class="form-control" name="vencimento" id="vencimento"
                                            required>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="valorMatricula" class="form-label">Valor da matrícula <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="valorMatricula"
                                            id="valorMatricula" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="vencimetoMatricula" class="form-label">Vencimento da matrícula<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="vencimetoMatricula"
                                            id="vencimetoMatricula" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="dataInicio" class="form-label">Data de inicio<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="dataInicio"
                                            id="dataInicio" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="dataPrevisaoTermino" class="form-label">Previsão de término<span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="dataPrevisaoTermino"
                                            id="dataPrevisaoTermino" required>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-2 mb-4">
                                        <label for="qtdeDias" class="form-label">Quantidade de dias</label>
                                        <input type="number" class="form-control" name="qtdeDias" id="qtdeDias">
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <label for="horasSemana" class="form-label">Horas por semana</label>
                                        <input type="number" class="form-control" name="horasSemana" id="horasSemana">
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <label for="consultor" class="form-label">Consultor</label>
                                        <select class="form-control" name="consultor" id="consultor">
                                            <option value="">Selecione um consultor</option>
                                            @foreach ($listaconsultores as $lista)
                                                <option value="{{$lista->id}}">{{$lista->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs">
                                </div>


                                {{-- Botões de ação --}}

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
