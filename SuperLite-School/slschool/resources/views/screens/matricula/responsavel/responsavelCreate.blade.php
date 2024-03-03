@extends('layout.main')
@section('title', 'Sl School - Novo Responsável')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Responsável</a></li>
                            <li class="breadcrumb-item active">Novo Responsável</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Cadastrar novo responsável</h4>

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
                            <form action="{{ route('responsavel.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <input type="hidden" name="aluno" value="{{$alunoID}}">

                                <div class="row">

                                    <div class="col-md-8 mb-4">
                                        <label for="nome" class="form-label">Nome completo <span
                                                class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="nome" id="nome" required
                                            maxlength="100" value="{{old('nome')}}">
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="apelido" class="form-label">Apelido</label>
                                        <input type="text" class="form-control" name="apelido" id="apelido"
                                            maxlength="50">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="dataNascimento" class="form-label">Data de nascimento</label>
                                        <input type="date" class="form-control" name="dataNascimento"
                                            id="dataNascimento">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="dataCadastro" class="form-label">Data de cadastro</label>
                                        <input type="date" class="form-control" name="dataCadastro" id="dataCadastro">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" name="cpf" id="cpf">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="rg" class="form-label">RG</label>
                                        <input type="text" class="form-control" name="rg" id="rg"
                                            maxlength="20">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" name="cep" id="cep">
                                    </div>

                                    <div class="col-md-9 mb-4">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="endereco"
                                            maxlength="100">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro"
                                            maxlength="50">
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" name="numero" id="numero"
                                            maxlength="10">
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento"
                                            maxlength="50">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col md-9 mb-4">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" name="cidade" id="cidade"
                                            maxlength="50">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="">Selecione um estado</option>

                                            @foreach ($listaEstado as $lista => $sigla)
                                                <option value="{{ $sigla }}">{{ $sigla }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="telefone" id="telefone">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="celular" class="form-label">celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="profissao" class="form-label">Profissão</label>
                                        <input type="text" class="form-control" name="profissao" id="profissao"
                                            maxlength="50">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="estadoCivil" class="form-label">Estado civil</label>
                                        <select class="form-control" name="estadoCivil" id="estadoCivil">
                                            <option value="">Selecione uma opção</option>
                                            <option value="solteriro">Solteiro(a)</option>
                                            <option value="casado">Casado(a)</option>
                                            <option value="divorciado">Divorciado(a)</option>
                                            <option value="viuvo">Viúvo(a)</option>
                                            <option value="unEstavel">União estável</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs"
                                        maxlength="255">
                                </div>

                                <div class="mb-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="foto">Selecione uma foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto"
                                            onchange="exibirFotoSelecionada()">
                                    </div>
                                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px">
                                </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.9/jquery.inputmask.min.js"></script>

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
