@extends('layouts.main')
@section('title', 'Incluir material')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir material</h3>
        </div>

        <hr>

        <h4 class="m-2">Aluno(a): {{$aluno->nome}}</h4>
        <h5 class="m-2">Matricula: {{$matricula->id}} </h5>

        <hr>

        <div class="card p-5">

            <form action="{{ route('matricula_materiais.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="matricula" id="matricula" value="{{$matricula->id}}">
                <input type="hidden" name="aluno" id="aluno" value="{{$aluno->id}}">

                <div class="mb-4">
                    <label for="material" class="form-label lblCaption">Material</label>
                    <select class="form-control" name="material" id="material" required>
                        <option value="">Selecione um material</option>

                        @foreach ($listaMaterias as $material)
                            <option value="{{ $material->id }}" data-valor-un={{ $material->valor_un }}
                                data-qtde={{ $material->qtde }}>{{ $material->material }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="row">

                    <div class="col-md-3 mb-4">
                        <label for="valorUN" class="form-label lblCaption">Valor por unidade</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control"
                             name="valorUN" id="valorUN" required>
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="qtde" class="form-label lblCaption">Quantidade</label>
                        <input type="number" step="1" min="0"  class="form-control" name="qtde"
                             id="qtde" onchange="calcular()" required>
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="total" class="form-label lblCaption">Total</label>
                        <input type="number" step="0.01" min="0.01"  class="form-control"
                             name="total" id="total" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
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
            var valorUNInput = document.getElementById("valorUN");
            var qtdeInput = document.getElementById("qtde");

            // Obter a opção selecionada no elemento select
            var materialSelect = document.getElementById("material");
            var qtdeDisponivel = $('option:selected', materialSelect).data('qtde');

            // console.log(qtdeDisponivel);

            var valorUN = parseFloat(valorUNInput.value);
            var qtde = parseFloat(qtdeInput.value);

            if(qtdeDisponivel < qtde){
                window.alert('A quantidade informada é maior do a disponível no estoque!');
                qtde = 0;
                valorUN = 0;
                document.getElementById("qtde").value = '0'; 
            }

            if (!isNaN(valorUN) && !isNaN(qtde)) {
                var resultadoDivisao = valorUN * qtde;
                document.getElementById("total").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#material').change(function() {
                var valor_un = $('option:selected', this).data('valor-un');
                var qtde = $('option:selected', this).data('qtde');

                if (qtde <= 0) {
                    window.alert('Não há unidade suficientes para a inclusão');
                    $('#valorUN').val(0);
                    $('#qtde').val(0);
                    $('#total').val(0);
                } else {
                    $('#valorUN').val(valor_un);
                    $('#qtde').val(1);
                    $('#total').val(valor_un);
                }

            });
        });
    </script>

@endsection
