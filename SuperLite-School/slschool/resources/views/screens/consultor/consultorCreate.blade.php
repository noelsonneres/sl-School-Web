@extends('layout.main')
@section('title', 'Sl School - Novo consultor') 
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
                            <li class="breadcrumb-item active">Novo consultor</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Cadastrar Novo Consultor</h4>

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

                                <div class="col-md-9 mb-4">
                                    <label for="nome" class="form-label">Nome completo</label>
                                    <input type="text" class="form-control" name="nome" id="nome" required maxlength="100">
                                </div>

                                <div class="col-md-3 mb-4">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf">
                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="dataNascimento" class="form-label">Data de nascimento</label>
                                        <input type="date" class="form-control" name="dataNascimento" id="dataNascimento">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="dataCadastro" class="form-label">Data de cadastro</label>
                                        <input type="date" class="form-control" name="dataCadastro" id="dataCadastro">
                                    </div>   
                                    
                                    <div class="col-md-3 mb-4">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="telefone" id="telefone">
                                    </div>  
                                    
                                    <div class="col-md-3 mb-4">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular">
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
