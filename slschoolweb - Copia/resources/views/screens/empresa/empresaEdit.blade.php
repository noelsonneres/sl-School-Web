
@extends('layouts.main')
@section('title', 'Editar informações da empresa')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Visualizar ou editar as informações da empresa</h3>
    </div>

    @if(isset($msg))
    <hr>
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="card p-5">

        <form action="{{route('empresa.update', $empresa->id)}}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label lblCaption">Nome fantasia</label>
                <input type="text" class="form-control" name="nome" id="nome" 
                    placeholder="Digite o nome fantasia da empresa" autofocus required maxlength="50"
                    value="{{$empresa->nome}}">
            </div>

            <div class="mb-3">
                <label for="razao_social" class="form-label lblCaption">Razão social</label>
                <input type="text" class="form-control" name="razao_social" id="razao_social" 
                    placeholder="Digite a razão social" maxlength="50" value="{{$empresa->razao_social}}">
            </div>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label for="dataAbertura" class="form-label lblCaption">Data de abertura</label>
                    <input type="date" class="form-control" name="dataAbertura" id="dataAbertura"
                    value="{{$empresa->data_aberturra}}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="cnpj" class="form-label lblCaption">CNPJ</label>
                    <input type="text" class="form-control" name="cnpj" id="cnpj"
                    value="{{$empresa->cnpj}}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="telefone" class="form-label lblCaption">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone"
                        value="{{$empresa->telefone}}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="celular" class="form-label lblCaption">Celular</label>
                    <input type="text" class="form-control" name="celular" id="celular"
                        value="{{$empresa->celular}}">
                </div>

            </div>

            <div class="mb-3">
                <label for="email" class="form-label lbl">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" maxlength="100"
                    value="{{$empresa->email}}">
            </div>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label for="cep" class="form-label lblCaption">CEP</label>
                    <input type="text" class="form-control" name="cep" id="cep"
                        value="{{$empresa->cep}}">
                </div>

                <div class="col-md-9 mb-3">
                    <label for="endereco" class="form-label lblCaption">Endereço</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" maxlength="100"
                        value="{{$empresa->endereco}}">
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="bairro" class="form-label lblCaption">Bairro</label>
                    <input type="text" class="form-control" name="bairro" id="bairro" maxlength="50"
                        value="{{$empresa->bairro}}">
                </div>

                <div class="col md-2 mb-3">
                    <label for="numero" class="form-label lblCaption">Número</label>
                    <input type="number" class="form-control" name="numero" id="numero"
                        value="{{$empresa->numero}}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="complemento" class="form-label lblCaption">complemento</label>
                    <input type="text" class="form-control" name="complemento" id="complemento" maxlength="50"
                        value="{{$empresa->complemento}}">
                </div>

            </div>

            <div class="row">

                <div class="col-md-9 mb-3">
                    <label for="cidade" class="form-label lblCaption">Cidade</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" maxlength="50"
                        value="{{$empresa->cidade}}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="estado" class="form-label lblCaption">Estado</label>
                    <input type="text" class="form-control" name="estado" id="estado"
                        value="{{$empresa->estado}}">
                </div>

            </div>

            <div class="mb-3">
                <label for="obs" class="form-label lblCaption">Observação</label>
                <input type="text" class="form-control" name="obs" id="obs" value="{{$empresa->obs}}">
            </div>

            <div class="mb-4">
                <div class="input-group mb-2">
                    <label class="input-group-text" for="logo">Selecione uma logo</label>
                    <input type="file" class="form-control" name="logo" id="logo" onchange="exibirFotoSelecionada()">
                </div>
                <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px" src="/img/logo/{{$empresa->foto}}">
            </div>

            <div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Salvar</button>

                <a href="/empresa" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>

    </div>
</div>



{{--Localiza a foto do professor--}}

<script>
    function exibirFotoSelecionada() {
        const input = document.getElementById("logo");
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<!-- Inclua o InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script>
    // Aplicar a máscara de telefone usando InputMask
    $(document).ready(function() {
        $('#telefone').inputmask('(99) 9 9999-9999');
        $('#celular').inputmask('(99) 9 9999-9999');
        $('#cep').inputmask('99999-999');
        $('#cnpj').inputmask('99.999.999/9999-99');
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