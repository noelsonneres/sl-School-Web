@extends('layout.main')
@section('title', 'Sl School - Novo Aluno') 
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
                            <li class="breadcrumb-item active">Novo Aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Cadastrar novo aluno</h4>

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
                            <form action="{{ route('diasAula.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    <div class="col-md-8 mb-4">
                                        <label for="nome" class="form-label">Nome completo  <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="nome" id="nome" maxlength="100" required>
                                    </div>                   
                                    
                                    <div class="col md-4 mb-4">
                                        <label for="apelido" class="form-label">Apelido</label>
                                        <input type="text" class="form-control" name="apelido" id="apelido" maxlength="50">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="dataNascimento" class="form-label">Data de nascimento</label>
                                        <input type="date" class="form-control" name="dataNascimento" id="dataNascimento">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="dataCadastro" class="form-label">Data de Cadastro</label>
                                        <input type="date" class="form-control" name="dataCadastro" id="dataCadastro">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" name="cpf" id="cpf">
                                    </div>             
                                    
                                    <div class="col-md-3 mb-4">
                                        <label for="rg" class="form-label">RG</label>
                                        <input type="text" class="form-control" name="rg" id="rg">
                                    </div>                                  

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="fobias" class="form-label">Fobias</label>
                                        <input type="text" class="form-control" name="fobias" id="fobias" maxlength="100">
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <label for="alergias" class="form-label">Alergias</label>
                                        <input type="text" class="form-control" name="alergias" id="alergias" maxlength="100">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="pcd" class="form-label">PCD</label>
                                        <input type="text" class="form-control" name="pcd" id="pcd" maxlength="100">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="outrosAspectos" class="form-label">Outros aspectos</label>
                                        <input type="text" class="form-control" name="outrosAspectos" id="outrosAspectos" maxlength="100">
                                    </div>                                    

                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" name="cep" id="cep">
                                    </div>

                                    <div class="col mb-9 mb-4">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="endereco" maxlength="100">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro" maxlength="50">
                                    </div>

                                    <div class="col-md-2 mb-4">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" name="numero" id="numero" maxlength="10">
                                    </div>

                                    <div class="col md-4 mb-4">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento" maxlength="50">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-9 mb-4">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento" maxlength="100">
                                    </div>

                                    <div class="col md-3 mb-4">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="">Selecione um estados</option>

                                            @foreach ($listaEstados as $lista=>$sigla)
                                                <option value="{{$sigla}}">{{$sigla}}</option>
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
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">E-Mail</label>
                                        <input type="text" class="form-control" name="email" id="email" maxlength="100">
                                    </div>

                                </div>

                                <div class="row">

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

                                    <div class="col-md-6 mb-4">
                                        <label for="profissao" class="form-label">Profissão</label>
                                        <input type="text" class="form-control" class="profissao" name="profissao" id="profissao" maxlength="50">
                                    </div>

                                </div>

                                <div class="card border p-3">
                                   <h3>Filiação</h3> 
                                   <hr>
                                   <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="nomeMae" class="form-label">Nome da mãe</label>
                                            <input type="text" class="form-control" name="nomeMae" id="nomeMae" maxlength="100">
                                        </div>
                                   </div>
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

@endsection
