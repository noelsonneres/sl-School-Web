@extends('layout.main')
@section('title', 'Sl School - Pronto para quitar')
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
                            <li class="breadcrumb-item active">Quitar mensalidade</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Confirmar informações de pagamento da mensalidades</h4>

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
                            <form action="{{ route('matricula_materiais.store') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

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

                                <div class="card mb-4 p-3">

                                    <div class="row">

                                        <div class="col-md-3 mb-4">
                                            <label for="juros" class="form-label">Juros
                                                ({{ $juros['taxaJuros'] }}%)</label>
                                            <input type="text" class="form-control" name="juros" id="juros"
                                                value="{{ $juros['valorJuros'] }}" readonly>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="multa" class="form-label">Multa</label>
                                            <input type="text" class="form-control" name="multa" id="multa"
                                                value="{{ $juros['multa'] }}" readonly>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="desconto" class="form-label">Desconto</label>
                                            <input type="number" class="form-control" step="0.01" min="0.01"
                                                name="desconto" id="desconto">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="acrescimo" class="form-label">Acréscimo</label>
                                            <input type="number" class="form-control" step="0.01" min="0.01"
                                                name="acrescimo" id="acrescimo">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 mb-4">
                                            <label for="totalPagar" class="form-label">Total a pagar</label>
                                            <input type="number" step="0.01" min="0.01" class="form-control"
                                                name="totalPagar" id="totalPagar"
                                                value="{{$mensalidade->valor_parcela + $juros['multa'] + $juros['valorJuros'] }}" required>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="dataPagamento" class="form-label">Data de pagamento</label>
                                            <input type="date" class="form-control" name="dataPagamento"
                                                id="dataPagamento" required>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label for="formasPagamentos" class="form-label">Forma de pagamento</label>
                                            <select style="color: red; font-weight: bold" class="form-control"
                                                name="formasPagamentos" id="formasPagamentos" required>
                                                <option value="">Selecione uma opção</option>

                                                @foreach ($formasPagamentos as $lista)
                                                    <option value="{{ $lista->id }}">{{ $lista->formas }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-4">
                                        <label for="responsavelPagamento" class="form-label">Responsável pelo
                                            pagamento</label>
                                        <input type="text" class="form-control" name="responsavelPagamento"
                                            id="responsavelPagamento" maxlength="100">
                                    </div>

                                    <div class="mb-4">
                                        <label for="obs" class="form-label">Observação</label>
                                        <input type="text" class="form-control" name="obs" id="obs"
                                            maxlength="250">
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
