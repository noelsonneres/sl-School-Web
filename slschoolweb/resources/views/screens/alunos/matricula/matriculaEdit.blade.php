@extends('layouts.main')
@section('title', 'Visualizar ou Editar Matrícula')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Visualizar ou Editar Matrícula</h3>
        </div>

        <hr>
        <div class="row">

            <div class="col-md-8">
                <h4>Aluno(a): {{ $aluno->nome }}</h4>
                <h4>Matrícula: {{ $matricula->id }}</h4>
                <h5>Código: {{ $aluno->id }}</h5>

                @if (isset($responsavel))
                    <h4>Responsável: {{ $responsavel->nome }}</h4>
                @endif
            </div>

            <div class="col-md-4">

                <a href="{{ '/matricula_adicionar/' . $aluno->id }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Nova Matrícula </a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

        </div>

        <hr>

        <div class="card p-5">

            <form action="{{ route('matricula.update', $matricula->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input type="hidden" name="aluno" id="aluno" value="{{ $aluno->id }}">

                @if (isset($responsavel))
                    <input type="hidden" name="responsavel" id="responsavel" value="{{ $responsavel->id }}">
                @endif

                <div class="row">

                    <div class="col-md-9 mb-3">
                        <label for="curso" class="form-label lblCaption">Curso</label>
                        <select class="form-control" name="curso" id="curso">

                            <option value="{{ $matricula->cursos->id }}">{{ $matricula->cursos->curso }}</option>

                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" data-qtde-parcelas="{{ $curso->qtde_parcelas }}"
                                    data-valor-avista="{{ $curso->valor_avista }}"
                                    data-valor_com_desconto="{{ $curso->valor_com_desconto }}"
                                    data-valor-parcelado="{{ $curso->valor_parcelado }}"
                                    data-valor-por-parcela="{{ $curso->valor_por_parcela }}">
                                    {{ $curso->curso }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-2 mb-4">
                        <label for="qtdeParcelas" class="form-label lblCaption">Qtde parcelas</label>
                        <input type="number" onchange="calcular()" class="form-control" name="qtdeParcelas"
                            id="qtdeParcelas" value="{{ $matricula->qtde_parcela }}">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="valorAVista" class="form-label lblCaption">Valor a vista</label>
                        <input type="number" class="form-control" step="0.01" min="0.01" name="valorAVista"
                            id="valorAVista" value="{{ $matricula->valor_a_vista }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="valorComDesconto" class="form-label lblCaption">Valor com desconto</label>
                        <input type="number" class="form-control" step="0.01" min="0.01" name="valorComDesconto"
                            id="valorComDesconto" value="{{ $matricula->valor_com_desconto }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="valorParcelado" class="form-label lblCaption">Valor parcelado</label>
                        <input type="number" class="form-control" step="0.01" min="0.01" onchange="calcular()"
                            name="valorParcelado" id="valorParcelado" value="{{ $matricula->valor_parcelado }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="valorPorParcela" class="form-label lblCaption">Valor por parcela</label>
                        <input type="number" class="form-control" step="0.01" min="0.01" name="valorPorParcela"
                            id="valorPorParcela" oninput="calcular()" value="{{ $matricula->valor_por_parcela }}">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento"
                            value="{{ $matricula->vencimento }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="valorMatricula" class="form-label lblCaption">Valor da matrícula</label>
                        <input type="number" class="form-control" step="0.01" min="0.01" name="valorMatricula"
                            id="valorMatricula" value="{{ $matricula->valor_matricula }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="vencimentoMatricula" class="form-label">Vencimento da matrícula</label>
                        <input type="date" class="form-control" name="vencimentoMatricula" id="vencimentoMatricula"
                            value="{{ $matricula->vencimento_matricula }}">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-4">
                        <label for="dataInicio" class="form-label lblCaption">Data de início</label>
                        <input type="date" onchange="CalcularDatas()" class="form-control" name="dataInicio"
                            id="dataInicio" value="{{ $matricula->data_inicio }}">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="dataTermino" class="form-label lblCaption">Data de término</label>
                        <input type="date" class="form-control" name="dataTermino" id="dataTermino"
                            value="{{ $matricula->data_termino }}">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="qtdeDias" class="form-label lblCaption">Dias por semana</label>
                        <input type="number" class="form-control" name="qtdeDias" id="qtdeDias"
                            value="{{ $matricula->qtde_dias }}">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="qtdeHoras" class="form-label lblCaption">Horas por semana</label>
                        <input type="number" class="form-control" name="qtdeHoras" id="qtdeHoras"
                            value="{{ $matricula->horas_semana }}">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-9 mb-3">
                        <label for="consultor" class="form-label lblCaption">Consultor</label>
                        <select name="consultor" class="form-control" id="consultor" name="consultor">

                            @isset($cons)
                                <option value="{{ $cons->id }}">{{ $cons->nome }}</option>
                            @endisset

                            @foreach ($consultores as $consultor)
                                <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="ativo" class="form-label lblCaption">Ativo</label>
                        <input style="color: #1976D2; font-weight: 800" type="text" class="form-control"
                            name="ativo" id="ativo" readonly value="{{ $matricula->status }}">
                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input class="form-control" type="text" id="obs" name="obs" maxlength="255"
                        value="{{ $matricula->obs }}">
                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="{{ '/matricula_home/' . $aluno->id }}" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>


    {{-- Scripts --}}

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
            var dataTerminoInput = document.getElementById("dataTermino");

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
