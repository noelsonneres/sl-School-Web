@extends('layout.main')
@section('title', 'Sl School - Bloquear Aluno')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Matrículas</a></li>
                            <li class="breadcrumb-item active">Bloquear Aluno</li>
                        </ol>
                    </div>

                    <h4 class="page-title">Bloquear Aluno</h4>
                    <h5 class="mb-3 ms-2">Aluno(a):{{ $bloqueado->alunos->nome }}</h5>

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
                            <form action="{{ route('bloqueados.update', $bloqueado->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="aluno" value="{{ $bloqueado->alunos_id }}">

                                <div class="row">

                                    <div class="mb-4">
                                        <label for="nome" class="form-label">Aluno</label>
                                        <input type="text" class="form-control" name="nome" id="nome"
                                            value="{{ $bloqueado->alunos->nome }}" readonly>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="data" class="form-label">Data</label>
                                        <input type="date" class="form-control" name="data" id="data"
                                            value="{{$bloqueado->data}}" required readonly>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="hora" class="form-label">Hora</label>
                                        <input type="time" class="form-control" name="hora" id="hora"
                                           value="{{$bloqueado->hora}}"  required readonly>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="motivo" class="form-label">Motivo</label>
                                        <input type="text" class="form-control" name="motivo" id="motivo"
                                           value="{{$bloqueado->motivo}}" required maxlength="50" readonly>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs"
                                        value="{{$bloqueado->obs}}" maxlength="255">
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Desbloquear
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

    {{-- Calcula o valor da parcela --}}
    <script>
        function calcular() {
            var qtdeParcelaInput = document.getElementById("qtdeParcelas");
            var ValorParceladoInput = document.getElementById("valorComDesconto");

            var qtdeParcela = parseFloat(qtdeParcelaInput.value);
            var ValorParcelado = parseFloat(ValorParceladoInput.value);

            if (!isNaN(qtdeParcela) && !isNaN(ValorParcelado)) {
                var resultadoDivisao = ValorParcelado / qtdeParcela;
                document.getElementById("valorPorParcela").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>

@endsection
