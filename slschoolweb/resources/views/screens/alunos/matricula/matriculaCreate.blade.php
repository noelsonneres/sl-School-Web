
@extends('layouts.main')
@section('title', 'Nova matrícula')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Nova matrícula</h3>
    </div>

    <hr>
        <h4>Aluno(a): {{$aluno->nome}}</h4>
        <h5>Código: {{$aluno->id}}</h5>

        @if(isset($responsavel))
            <h4>Responsável: {{$responsavel->nome}}</h4>
        @endif

    <hr>

    <div class="card p-5">

        <form action="{{route('matricula.store')}}" method="post" enctype="multipart/form-data">

            @csrf


            <div class="row">

                <div class="col-md-9 mb-3">
                    <label for="aluno" class="form-label lblCaption">Curso</label>
                    <select class="form-control" name="curso" id="cruso">

                        <option value="">Selecione um curso para a matrícula</option>

                        @foreach ($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->curso}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="qtdeParcelas" class="form-label lblCaption">Quantidade parcelas</label>
                    <input type="number" class="form-control" id="qtdeParcelas" name="qtdeParcelas" 
                            maxlength="20" autocomplete="off">
                </div>    

            </div>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label for="valorAVista" class="form-label lblCaption">Valor a vista</label>
                    <input type="number" class="form-control" name="valorAVista" id="valorAVista">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="valorComDesconto" class="form-label lblCaption">Valor com desconto</label>
                    <input type="number" class="form-control" name="valorComDesconto" id="valorComDesconto">                    
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="valorParcelado" class="form-label lblCaption">Valor parcelado</label>
                    <input type="number" class="form-control" name="valorParcelado" id="valorParcelado">                      
                </div>

                <div class="col-md-3 mb-3">
                    <label for="valorPorParcela" class="form-label lblCaption">Valor por parcela</label>
                    <input type="number" class="form-control" name="valorPorParcela" id="valorPorParcela">                      
                </div>                

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                    <input type="date" class="form-control" name="vencimento" id="vencimento">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="valorMatricula" class="form-label lblCaption">Valor da matrícula</label>
                    <input type="number" class="form-control" name="valorMatricula" id="valorMatricula">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="vencimentoMatricula" class="form-label">Vencimento da matrícula</label>
                    <input type="date" class="form-control" name="vencimentoMatricula" id="vencimentoMatricula">
                </div>                

            </div>

            <div class="row">

                <div class="col-md-3 mb-4">
                    <label for="dataInicio" class="form-label lblCaption">Data de início</label>
                    <input type="date" class="form-control" name="dataInicio" id="dataInicio">
                </div>

                <div class="col-md-3 mb-4">
                    <label for="dataTermino" class="form-label lblCaption">Data de término</label>
                    <input type="date" class="form-control" name="dataTermino" id="dataTermino">                    
                </div>
                
                <div class="col-md-3 mb-4">
                    <label for="qtdeDias" class="form-label lblCaption">Dias por semana</label>
                    <input type="number" class="form-control" name="qtdeDias" id="qtdeDias">
                </div>
                
                <div class="col-md-3 mb-4">
                    <label for="qtdeHoras" class="form-label lblCaption">Horas por semana</label>
                    <input type="number" class="form-control" name="qtdeHoras" id="qtdeHoras">                    
                </div>                

            </div>

            <div class="row">

                <div class="col-md-9 mb-3">
                    <label for="consultor" class="form-label lblCaption">Consultor</label>
                    <select name="consultor" class="form-control" id="consultor" name="consultor">

                        <option value="">Selecione um consultor(Opcional)</option>

                        @foreach($consultores as $consultor)
                            <option value="{{$consultor->id}}">{{$consultor->nome}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="ativo" class="form-label lblCaption">Ativo</label>
                    <input type="text" class="form-control" name="ativo" id="ativo" readonly value="sim">
                </div>

            </div>

            <div class="mb-3">
                <label for="obs" class="form-label lblCaption">Observação</label>
                <input class="form-control" type="text" id="obs" name="obs" maxlength="255">
            </div>


            <div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Salvar</button>

                <a href="/home_aluno" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>

    </div>
</div>


{{-- Localiza a foto do professor --}}

<script>
    function exibirFotoSelecionada() {
        const input = document.getElementById("foto");
        const imagem = document.getElementById("imagemSelecionada");

        if (input.files && input.files[0]) {
            const leitor = new FileReader();

            leitor.onload = function(e) {
                imagem.src = e.target.result;
            };

            leitor.readAsDataURL(input.files[0]);
        }
    }
</script>



{{-- PROCESSO DE VALIDAÇÃO DO CAMPOS --}}
<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<!-- Inclua o InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script>
    // Aplicar a máscara de telefone usando InputMask
    $(document).ready(function() {
        $('#telefone').inputmask('(99) 9 9999-9999');
        $('#celular').inputmask('(99) 9 9999-9999');
        $('#cep').inputmask('99999-999');
        $('#cpf').inputmask('999.999.999-99');

        $('#cpfMae').inputmask('999.999.999-99');
        $('#cpfPai').inputmask('999.999.999-99');
    });
</script>

<!-- ViaCEP -->


<!-- Adicionando Javascript -->
<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
</script>


@endsection