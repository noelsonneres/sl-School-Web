@extends('layouts.main')
@section('title', 'Atualizar informações da disciplina')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar informações da disciplina do aluno</h3>
        </div>

        <hr>
        <h4 class="p-1">Aluno(a): {{$matricula->alunos->nome}}</h4>
        <h4 class="p-1">Matrícula: {{$matricula->id}}</h4>
        <hr>

        <div class="card p-5">

            <form action="{{ route('matricula_disciplina.update', $disciplina->id) }}" method="post"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card border">

                    <div class="mb-3 p-3">
                        <label for="disciplina" class="form-label lblCaption">Disciplina</label>
                        <input type="text" class="form-control" name="disciplina" id="disciplina"
                               placeholder="Digite um curso para o professor" readonly
                               value="{{ $disciplina->disciplinas->disciplina }}">
                    </div>

                </div>

                <div class="card border">

                    <h4 class="p-4">Informações sobre o andamento da disciplina</h4 class="p-4">

                    <div class="row mb-3 p-3">

                        <div class="col-md-4">
                            <label for="inicio" class="form-label lblCaption">Início</label>
                            <input type="date" class="form-control" name="inicio" id="inicio" required
                                   value="{{ $disciplina->inicio }}">
                        </div>

                        <div class="col-md-4">
                            <label for="termino" class="form-label lblCaption">Término</label>
                            <input type="date" class="form-control" name="termino" id="termino"
                                   value="{{ $disciplina->termino }}">
                        </div>

                        <div class="col-md-4">
                            <label for="concluido" class="form-label lblCaption">situacao</label>
                            <select class="form-control" name="concluido" id="concluido">
                                <option value="{{$disciplina->concluido}}">{{$disciplina->concluido}}</option>
                                <option value="Iniciado">Iniciado</option>
                                <option value="Em andamento">Em andamento</option>
                                <option value="Pausado">Pausado</option>
                                <option value="Cancelado">Cancelado</option>
                                <option value="Concluido">Concluido</option>
                                <option value="Não iniciado">Não iniciado</option>

                            </select>
                        </div>


                    </div>

                    <div class="mb-3  p-3">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255"
                               value="{{$disciplina->obs}}">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar
                    </button>

                    <a href="javascript:history.back()" class="btn btn-danger">
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
