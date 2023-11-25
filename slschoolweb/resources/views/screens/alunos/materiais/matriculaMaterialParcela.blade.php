@extends('layouts.main')
@section('title', 'Confirmar as informações da parcela')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Confirme as informações antes de gerar a parcela</h3>
        </div>

        <hr>

        <h4 class="m-2">Aluno(a): {{$material->alunos->nome}}</h4>
        <h5 class="m-2">Matricula: {{$material->matriculas_id}} </h5>

        <hr>

        <div class="card p-5">

            <form action="{{('/matricula_material_gerar_parcela') }}" method="post" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="matricula" id="matricula" value="{{$material->matriculas_id}}">
                <input type="hidden" name="aluno" id="aluno" value="{{$material->alunos_id}}">
                <input type="hidden" name="responsavel" id="responsavel" value="{{$responsavelID}}">

                <div class="row">
                    
                    <div class="col-md-3 mb-3">
                        <label for="valor" class="form-label lblCation">Valor (R$)</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control" 
                         name="valor" id="valor" required value="{{$material->valor_total}}" readonly>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="qtde" class="form-label lblCaption">Qtde. Parcelas</label>
                        <input type="number" step="1" min="1"  class="form-control" name="qtde" id="qtde" 
                            required value="1" onchange="calcular()" onblur="calcular()">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="valorParcela" class="form-label lblCaption">Valor parcela (R$)</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control" name="valorParcela" id="valorParcela"
                        value="{{$material->valor_total}}">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento" required>
                    </div>                    

                </div>  
                
                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="50"
                    value="Parcela referente a inclusão do material escolar">
                </div>

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

  <script>
    function calcular() {
        var valorInput = document.getElementById("valor");
        var qtdeInput = document.getElementById("qtde");

        var valor = parseFloat(valorInput.value);
        var qtde = parseFloat(qtdeInput.value);

        if (!isNaN(valor) && !isNaN(qtde)) {
            var resultadoDivisao = valor * qtde;
            document.getElementById("valorParcela").value = resultadoDivisao.toFixed(2);
        }
    }
</script>    

@endsection
