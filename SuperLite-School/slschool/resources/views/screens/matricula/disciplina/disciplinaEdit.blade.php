@extends('layout.main')
@section('title', 'Sl School - Atualizar as informações da disciplina do aluno') 
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Atualizar informações da dsciplina do aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Visualizar ou atualizar as informações da disciplina do aluno</h4>

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
                            <form action="{{ route('matricula_disciplina.update', $disciplina->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="card p-3">

                                    <div class="row">

                                        <h5 class="mb-2">Informações do aluno</h5>
    
                                        <div class="col-md-2 mb-4">
                                            <label for="codAluno" class="form-label">Código do aluno</label>
                                            <input type="text" class="form-control" name="codAluno" id="codAluno"
                                                 value="{{$disciplina->alunos_id}}" readonly>
                                        </div>
    
                                        <div class="col-md-2 mb-4">
                                            <label for="matricula" class="form-label">Matrícula</label>
                                            <input type="text" class="form-control" name="matricula" id="matricula"
                                                value="{{$disciplina->matriculas_id}}" readonly>
                                        </div>

                                        <div class="col-md-8 mb-4">
                                            <label for="aluno" class="form-label">Nome do aluno</label>
                                            <input type="text" class="form-control" name="aluno" id="aluno"
                                                value="{{$disciplina->alunos->nome}}" readonly>
                                        </div>
    
                                    </div>        
                                    
                                    <hr>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="disciplina" class="form-label">Disciplina</label>
                                        <input type="text" class="form-control" name="disciplina"
                                             id="disciplina" value="{{$disciplina->disciplinas->disciplina}}"
                                                readonly>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="curso" class="form-label">Curso</label>
                                        <input type="text" class="form-control" name="curso" id="curso"
                                            value="{{$disciplina->curso->curso??""}}" readonly>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-4">
                                        <label for="inicio" class="form-label">Início</label>
                                        <input type="date" class="form-control" name="inicio" id="inicio"
                                            value="{{$disciplina->inicio}}" required>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="termino" class="form-label">Término</label>
                                        <input type="date" class="form-control" name="termino" id="termino" 
                                            value="{{$disciplina->termino}}">
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="concluido" class="form-label">Concluido?</label>
                                        <select class="form-control" name="concluido" id="concluido" required>
                                            <option value="{{$disciplina->concluido}}">{{$disciplina->concluido??""}}</option>
                                            <option value="iniciado">Iniciado</option>
                                            <option value="concluido">Concluido</option>
                                            <option value="cancelado">Canelado</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs"
                                         maxlength="255" value="{{$disciplina->obs}}">
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
