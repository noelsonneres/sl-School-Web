{{-- CRIAR OS RESTANTES DO CAMPOS
    CRIAR OS CAMPOS HIDDEN PARA ARMAZENAR OS VALORES DA EMPRESAS_ID E EMPRESSA_CNPJ 
        E O CÓDIGO E NOME DO USUÁRIO LOGADO --}}

@extends('layout.main')
@section('title', 'Super Lite School')
@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadastros</a></li>
                            <li class="breadcrumb-item active">Cadastro de usuários</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Cadatro de Usuários</h4>
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
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label for="nome" class="form-label">Nome complento <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nome" id="nome" required
                                            max="100">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="nomeUsuario" class="form-label">Nome de usuário <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nomeUsuario" id="nomeUsuario"
                                            required max="100">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="senha" class="form-label">Senha <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="senha" id="senha"
                                                required minlength="6" autocomplete="off">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="confirmarSenha" class="form-label">Confirmar senha<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="confirmarSenha"
                                                id="confirmarSenha" required minlength="6" autocomplete="off">
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
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label for="ativo" class="form-label">Ativo? <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="ativo" id="ativo" required>
                                            <option value="">Selecione uma opção</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="dtAdmissao" class="form-label">Data de admissão</label>
                                        <input type="date" class="form-control" name="dtAdmissao" id="dtAdmissao">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="dtDesligamento" class="form-label">Data de desligamento</label>
                                        <input type="date" class="form-control" name="dtDesligamento"
                                            id="dtDesligamento">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-4">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" name="cpf" id="cpf"
                                            maxlength="14">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="dtNascimento" class="form-label">Data de jnascimento</label>
                                        <input type="date" class="form-control" name="dtNascimento"
                                            id="dtNascimento">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="apelido" class="form-label">Apelido</label>
                                        <input type="text" class="form-control" name="apelido" id="apelido"
                                            maxlength="20">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="telefone" id="telefone">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-3">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" name="cep" id="cep"
                                            maxlength="12">
                                    </div>

                                    <div class="col-md-9">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="endereco"
                                            maxlength="100">
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <div class="col-md-6">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="bairro" id="bairro"
                                            maxlength="50">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" name="complemento" id="complemento"
                                            maxlength="50">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" name="numero" id="numero" maxlength="20">
                                    </div>                                    

                                </div>


                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success">Salvar
                                        <i class="uil-trash-alt"></i>
                                    </button>
                                    <a href="" class="btn btn-danger">Cancelar
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

@endsection
