@extends('layout.main')
@section('title', 'Sl School - Atualizar informações do aluno')
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
                            <li class="breadcrumb-item active">Informações do aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Visualizar ou atualizar as informações do aluno</h4>

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
                            <form action="{{ route('alunos.update', $aluno->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="row">

                                    <div class="col-md-8 mb-4">
                                        <label for="nome" class="form-label">Nome completo <span
                                                class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="nome" id="nome" maxlength="100"
                                               required value="{{$aluno->nome}}">
                                    </div>

                                    <div class="col md-4 mb-4">
                                        <label for="apelido" class="form-label">Apelido</label>
                                        <input type="text" class="form-control" name="apelido" id="apelido"
                                               maxlength="50" value="{{$aluno->apelido}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="dataNascimento" class="form-label">Data de nascimento</label>
                                        <input type="date" class="form-control" name="dataNascimento"
                                               id="dataNascimento" value="{{$aluno->data_nascimento}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="dataCadastro" class="form-label">Data de Cadastro</label>
                                        <input type="date" class="form-control" name="dataCadastro"
                                               id="dataCadastro" value="{{$aluno->data_cadastro}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <label class="text-danger" id="cpfValidationMessage"></label>
                                        <input type="text" class="form-control" name="cpf" id="cpf"
                                               oninput="formatarCPF(this)" value="{{$aluno->cpf}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="rg" class="form-label">RG</label>
                                        <input type="text" class="form-control" name="rg" id="rg"
                                               value="{{$aluno->rg}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="fobias" class="form-label">Fobias</label>
                                        <input type="text" class="form-control" name="fobias" id="fobias"
                                               maxlength="100" value="{{$aluno->fobias}}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="alergias" class="form-label">Alergias</label>
                                        <input type="text" class="form-control" name="alergias" id="alergias"
                                               maxlength="100" value="{{$aluno->alergias}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="pcd" class="form-label">PCD</label>
                                        <input type="text" class="form-control" name="pcd" id="pcd"
                                               maxlength="100" value="{{$aluno->pcd}}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="outrosAspectos" class="form-label">Outros aspectos</label>
                                        <input type="text" class="form-control" name="outrosAspectos"
                                               id="outrosAspectos" maxlength="100" value="{{$aluno->outros_aspectos}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" name="cep" id="cep"
                                               oninput="formatarCEP(this)" value="{{$aluno->cep}}">
                                    </div>

                                    <div class="col mb-9 mb-4">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="endereco"
                                               maxlength="100" value="{{$aluno->endereco}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro"
                                               maxlength="50" value="{{$aluno->bairro}}">
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" name="numero" id="numero"
                                               maxlength="10" value="{{$aluno->numero}}">
                                    </div>

                                    <div class="col md-4 mb-4">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento"
                                               maxlength="50" value="{{$aluno->complemento}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-9 mb-4">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" name="cidade" id="cidade"
                                               maxlength="100" value="{{$aluno->cidade}}">
                                    </div>

                                    <div class="col md-3 mb-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-control" name="estado" id="estado">

                                            <option value="{{$aluno->estado}}">{{$aluno->estado}}</option>

                                            @foreach ($listaEstados as $lista=>$sigla)
                                                <option value="{{$sigla}}">{{$sigla}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="telefone" id="telefone"
                                               oninput="formatarTelefone(this)" value="{{$aluno->telefone}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular"
                                               oninput="formatarCelular(this)" value="{{$aluno->celular}}">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">E-Mail</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               maxlength="100" value="{{$aluno->email}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="estadoCivil" class="form-label">Estado civil</label>
                                        <select class="form-control" name="estadoCivil" id="estadoCivil">
                                            <option value="{{$aluno->estado_civil}}">{{$aluno->estado_civil}}</option>
                                            <option value="solteriro">Solteiro(a)</option>
                                            <option value="casado">Casado(a)</option>
                                            <option value="divorciado">Divorciado(a)</option>
                                            <option value="viuvo">Viúvo(a)</option>
                                            <option value="unEstavel">União estável</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="profissao" class="form-label">Profissão</label>
                                        <input type="text" class="form-control" class="profissao" name="profissao"
                                               id="profissao" maxlength="50" value="{{$aluno->profissao}}">
                                    </div>

                                </div>

                                <div class="card border p-3">
                                    <h3>Filiação</h3>
                                    <hr>

                                    <div class="row">

                                        <div class="col-md-6 mb-4">
                                            <label for="nomeMae" class="form-label">Nome da mãe</label>
                                            <input type="text" class="form-control" name="nomeMae" id="nomeMae"
                                                   maxlength="100" value="{{$aluno->nome_mae}}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="rgMae" class="form-label">RG da mãe</label>
                                            <input type="text" class="form-control" name="rgMae" id="rgMae"
                                                   value="{{$aluno->rg_mae}}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="cpfMae" class="form-label">CPF da mãe</label>
                                            <input type="text" class="form-control" name="cpfMae" id="cpfMae"
                                                   oninput="formatarCPF(this)" value="{{$aluno->cpf_mae}}">
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mb-4">
                                            <label for="nomePai" class="form-label">Nome do pai</label>
                                            <input type="text" class="form-control" name="nomePai" id="nomePai"
                                                   maxlength="100" value="{{$aluno->nome_pai}}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="rgPai" class="form-label">RG do pai</label>
                                            <input type="text" class="form-control" name="rgPai" id="rgPai"
                                                   value="{{$aluno->rg_pai}}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="cpfPai" class="form-label">CPF do pai</label>
                                            <input type="text" class="form-control" name="cpfPai" id="cpfPai"
                                                   oninput="formatarCPF(this)" value="{{$aluno->cpf_pai}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="ativo" class="form-label">Ativo <span
                                                class="text-danger">*</span> </label>
                                        <select class="form-control" name="ativo" id="ativo" required>
                                            <option value="{{$aluno->ativo}}">{{$aluno->ativo}}</option>
                                            <option value="ativo">Ativo</option>
                                            <option value="bloquado">Bloqueado</option>
                                        </select>
                                    </div>

                                    <div class="col-md-9 mb-3">
                                        <label for="obs" class="form-label">Observação</label>
                                        <input type="text" class="form-control" name="obs" id="obs"
                                               value="{{$aluno->obs}}">
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="foto">Selecione uma foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto"
                                               onchange="exibirFotoSelecionada()">
                                    </div>
                                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px"
                                         src="/img/alunos/{{$aluno->foto}}">
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success">Salvar
                                        <i class="ri-save-3-fill"></i>
                                    </button>

                                    <a href="javascript:history.back()" class="btn btn-dark">Cancelar
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

                leitor.onload = function (e) {
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
        $(document).ready(function () {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function () {

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
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

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
