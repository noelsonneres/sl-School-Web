@extends('layout.main')
@section('title', 'Sl School - Informações da matrícula')
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
                            <li class="breadcrumb-item active">Informações da matrícula</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Informações da matrícula</h4>

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
                            <form action="{{ route('matricula.update', $matricula->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="card border p-3">
                                    <h4>Informações do aluno</h4>
                                    <hr>
                                    <div class="row">

                                        <div class="col-md-2">
                                            <label for="codAluno" class="form-label">Código do aluno</label>
                                            <input type="text" class="form-control" name="codAluno" id="codAluno"
                                                value="{{ $matricula->alunos_id }}" readonly>
                                        </div>

                                        <div class="col-md-10">
                                            <label for="nome" class="form-label">Nome do aluno</label>
                                            <input type="text" class="form-control" name="nome" id="nome"
                                                value="{{ $matricula->alunos->nome }}" readonly>
                                        </div>

                                    </div>

                                </div>

                                {{-- Informações da matrícula --}}
                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="curso" class="form-label">Curso <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="curso" id="curso" required>
                                            <option value="{{$matricula->cursos_id}}">{{$matricula->cursos->curso}}</option>

                                            @foreach ($listaCursos as $lista)
                                                <option value="{{ $lista->id }}"
                                                    data-qtde-parcelas="{{ $lista->qtde_parcelas }}"
                                                    data-valor-avista="{{ $lista->valor_avista }}"
                                                    data-valor_com_desconto="{{ $lista->valor_com_desconto }}"
                                                    data-valor-parcelado="{{ $lista->valor_parcelado }}"
                                                    data-valor-por-parcela="{{ $lista->valor_por_parcela }}">
                                                    {{ $lista->curso }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="qtdeParcelas" class="form-label">Quantidade parcelas <span
                                                class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="qtdeParcelas" id="qtdeParcelas"
                                            step="1" min="1" onchange="calcular()" value="{{$matricula->qtde_parcelas}}" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorAVista" class="form-label">Valor a vista
                                            <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="valorAVista" id="valorAVista"
                                            step="0.01" min="0.01" required>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="valorComDesconto" class="form-label">Valor com desconto
                                            <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="valorComDesconto"
                                            id="valorComDesconto" step="0.01" min="0.01" required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorParcelado" class="form-label">Valor parcelado<span
                                                class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="valorParcelado"
                                            id="valorParcelado" step="0.01" min="0.01" onchange="calcular()"
                                            required>
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorPorParcela" class="form-label">Valor por parcela <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="valorPorParcela"
                                            id="valorPorParcela" step="0.01" min="0.01" required>
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
                                            id="valorMatricula" step="0.01" min="0.01" required>
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
                                        <input type="date" class="form-control" name="dataInicio" id="dataInicio"
                                            onchange="CalcularDatas()" required>
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
                                        <input type="number" class="form-control" name="qtdeDias" id="qtdeDias"
                                            step="1" min="1">
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <label for="horasSemana" class="form-label">Horas por semana</label>
                                        <input type="number" class="form-control" name="horasSemana" id="horasSemana"
                                            step="1" min="1">
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <label for="consultor" class="form-label">Consultor</label>
                                        <select class="form-control" name="consultor" id="consultor">
                                            <option value="">Selecione um consultor</option>
                                            @foreach ($listaconsultores as $lista)
                                                <option value="{{ $lista->id }}">{{ $lista->nome }}</option>
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

    <script>
        function calcular() {

            var qtdeParcelaInput = document.getElementById("qtdeParcelas");
            var valorParceladoInput = document.getElementById("valorParcelado");

            var qtdeParcela = parseFloat(qtdeParcelaInput.value);
            var valorParcelado = parseFloat(valorParceladoInput.value);

            if (!isNaN(qtdeParcela) && !isNaN(valorParcelado)) {
                var resultadoDivisao = valorParcelado / qtdeParcela;
                document.getElementById("valorPorParcela").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>

    <script>
        function CalcularDatas() {

            var dataInicioInput = document.getElementById("dataInicio");
            var duracaoMesesInput = document.getElementById("qtdeParcelas");
            var dataTerminoInput = document.getElementById("dataPrevisaoTermino");

            var dataInicio = new Date(dataInicioInput.value);
            var duracaoMeses = parseInt(duracaoMesesInput.value, 10);

            if (isNaN(dataInicio.getTime())) {
                alert("Data de início inválida");
                return;
            }

            if (isNaN(duracaoMeses) || duracaoMeses <= 0) {
                alert("A quantidade de meses deve ser um número positivo");
                return;
            }

            var dataTermino = new Date(dataInicio);

            dataTermino.setMonth(dataTermino.getMonth() + duracaoMeses);

            var ano = dataTermino.getFullYear();
            var mes = (dataTermino.getMonth() + 1).toString().padStart(2, '0');
            var dia = dataTermino.getDate().toString().padStart(2, '0');

            var dataTerminoFormatada = ano + '-' + mes + '-' + dia;

            dataTerminoInput.value = dataTerminoFormatada;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#curso').change(function() {
                var qtde_parcela = $('option:selected', this).data('qtde-parcelas');
                var valor_avista = $('option:selected', this).data('valor-avista');
                var valor_com_desconto = $('option:selected', this).data('valor_com_desconto');
                var valor_parcelado = $('option:selected', this).data('valor-parcelado');
                var valor_por_parcela = $('option:selected', this).data('valor-por-parcela');

                $('#qtdeParcelas').val(qtde_parcela);
                $('#valorAVista').val(valor_avista);
                $('#valorComDesconto').val(valor_com_desconto);
                $('#valorParcelado').val(valor_com_desconto);
                $('#valorPorParcela').val(valor_por_parcela);

            });
        });
    </script>

@endsection
