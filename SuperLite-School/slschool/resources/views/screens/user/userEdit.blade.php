@extends('layout.main')
@section('title', 'Sl School - Atualizar informações do usuário')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Adminstrativo</a></li>
                            <li class="breadcrumb-item active">Atualizar informações do usuário</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Visualizar ou atualizar informações do usuário</h4>

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

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

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
                            <form action="{{ route('users.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="empresas_id" value="{{ $usuario->empresas_id }}">
                                <input type="hidden" name="empresas_cnpj" value="{{ $usuario->empresas_cnpj }}">

                                <div class="row mb-3">

                                    <div class="col-md-4 mb-2">
                                        <label for="nome" class="form-label">Nome complento <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nome" id="nome" required
                                            max="100" value="{{ $usuario->name }}">
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="nomeUsuario" class="form-label">Nome de usuário <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nomeUsuario" id="nomeUsuario"
                                            required max="20" value="{{ $usuario->user_name }}">
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <label for="senha" class="form-label">Senha <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="senha" id="senha"
                                                minlength="6" autocomplete="off">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <label for="confirmarSenha" class="form-label">Confirmar senha<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="confirmarSenha"
                                                id="confirmarSenha" minlength="6" autocomplete="off">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div>
                                        <label for="email" class="form-label">E-mail <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" maxlength="100"
                                            value="{{ $usuario->email }}">
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-4 mb-2">
                                        <label for="ativo" class="form-label">Ativo? <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="ativo" id="ativo" required>
                                            @if ($usuario->ativo === '1')
                                                <option value="1">Sim</option>
                                            @else
                                                <option value="0">Não</option>
                                            @endif
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="dtAdmissao" class="form-label">Data de admissão</label>
                                        <input type="date" class="form-control" name="dtAdmissao" id="dtAdmissao"
                                            value="{{ $usuario->data_adminssao }}">
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="dtDesligamento" class="form-label">Data de desligamento</label>
                                        <input type="date" class="form-control" name="dtDesligamento"
                                            id="dtDesligamento" value="{{ $usuario->data_desligamento }}">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-4 mb-2">
                                        <label for="cpf" class="form-label">CPF</label>&ensp;&ensp;
                                        <label class="text-danger" id="cpfValidationMessage"></label>
                                        <input type="text" class="form-control" name="cpf" id="cpf"
                                            maxlength="14" onchange="formatarCPF(this)" value="{{ $usuario->cpf }}">
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="dtNascimento" class="form-label">Data de nascimento</label>
                                        <input type="date" class="form-control" name="dtNascimento" id="dtNascimento"
                                            value="{{ $usuario->data_nascimento }}">
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="apelido" class="form-label">Apelido</label>
                                        <input type="text" class="form-control" name="apelido" id="apelido"
                                            maxlength="20" value="{{ $usuario->apelido }}">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6 mb-2">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="telefone" id="telefone"
                                            oninput="formatarTelefone(this)" value="{{ $usuario->telefone }}">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular"
                                            oninput="formatarCelular(this)" value="{{ $usuario->celular }}">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-3 mb-2">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" name="cep" id="cep"
                                            maxlength="12" oninput="formatarCEP(this)" value="{{ $usuario->cep }}">
                                    </div>

                                    <div class="col-md-9 mb-2">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="endereco"
                                            maxlength="100" value="{{ $usuario->endereco }}">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6 mb-2">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro"
                                            maxlength="50" value="{{ $usuario->bairro }}">
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento"
                                            maxlength="50" value="{{ $usuario->complemento }}">
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" name="numero" id="numero"
                                            maxlength="20" value="{{ $usuario->numero }}">
                                    </div>

                                </div>

                                <div class="row mb-2">

                                    <div class="col-md-9 mb-2">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" name="cidade" id="cidade"
                                            maxlength="50" value="{{ $usuario->cidade }}">
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label for="estado" class="form-label">UF</label>
                                        <select class="form-control" name="estado" id="estado">

                                            <option value="{{ $usuario->uf }}">{{ $usuario->uf }}</option>

                                            @foreach ($estados as $estado => $sigla)
                                                <option value="{{ $sigla }}">{{ $sigla }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div>
                                        <label for="obs" class="form-label">Observação</label>
                                        <input type="text" class="form-control" name="obs" id="obs"
                                            maxlength="255" value="{{$usuario->obs}}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="foto">Selecione uma foto</label>
                                        <input type="file" class="form-control" name="foto" id="foto"
                                            onchange="exibirFotoSelecionada()">
                                    </div>
                                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px" 
                                        src="/img/usuarios/{{$usuario->foto}}">
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success">Salvar
                                        <i class="uil-trash-alt"></i>
                                    </button>
                                    <a href="javascript:history.back()" class="btn btn-danger">Cancelar
                                        <i class="uil-trash-alt"></i>
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
