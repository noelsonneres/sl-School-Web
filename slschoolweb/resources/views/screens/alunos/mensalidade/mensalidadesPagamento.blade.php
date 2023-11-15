@extends('layouts.main')
@section('title', 'Quitar mensalidade')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Informa quitação de mensalidade</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="{{ route('cursos.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="card p5">

                    <h4 class="p-3">Informações do aluno</h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label lblCaption">Nome do aluno</label>
                            <input type="text" class="form-control" name="nome" id="nome" readonly
                                value="{{ $aluno->nome }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="codigo" class="form-label lblCaption">Código do aluno</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" readonly
                                value="{{ $aluno->id }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="matricula" class="form-label lblCaption">Matrícula</label>
                            <input type="text" class="form-control" name="matricula" id="matricula" readonly
                                value="{{ $matricula->id }}">
                        </div>

                    </div>

                </div>

                <div class="card-p5">

                    <h4 class="p-3">Informações da mensalidade</h4>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="menalidade" class="form-label lblCaption">Mensalidade</label>
                            <input type="text" class="form-control" name="menalidade" id="menalidade" readonly
                                value="{{ $mensalidade->id }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                            <input type="text" class="form-control" id="vencimento" name="vencimento" readonly
                                value="{{ $mensalidade->vencimento }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="valor" class="form-label lblCaption">Valor da parcela</label>
                            <input type="text" class="form-control" id="valor" name="valor" readonly
                                value="R$ {{ number_format($mensalidade->valor_parcela, '2', ',', '.') }}">
                        </div>

                    </div>

                </div>

                <div class="card-p5">

                    <h4 class="p-3">Informações para pagamento</h4>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="juros" class="form-label lblCaption">Juros ({{ $juros['taxaJuros'] }}%)</label>
                            <input type="text" class="form-control" id="juros" name="juros" readonly
                                value="R$ {{ number_format($juros['valorJuros'], '2', ',', '.') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="multa" class="form-label lblCaption">Multa</label>
                            <input type="text" class="form-control" id="multa" name="multa" readonly
                                value="R$ {{ number_format($juros['multa'], '2', ',', '.') }}">
                        </div>


                    </div>
                </div>
                {{-- 
            <div class="mb-3">
                <label for="curso" class="form-label lblCaption">Curso</label>
                <input type="text" class="form-control" name="curso" id="curso"
                     placeholder="Digite um curso para o professor" maxlength="100" autofocus required>
            </div> --}}




                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/professores" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function calcular() {
            var qtdeParcelaInput = document.getElementById("qtdeParcelas");
            var ValorParceladoInput = document.getElementById("valorParcelado");

            var qtdeParcela = parseFloat(qtdeParcelaInput.value);
            var ValorParcelado = parseFloat(ValorParceladoInput.value);

            if (!isNaN(qtdeParcela) && !isNaN(ValorParcelado)) {
                var resultadoDivisao = ValorParcelado / qtdeParcela;
                document.getElementById("valorPorParcela").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>

@endsection
