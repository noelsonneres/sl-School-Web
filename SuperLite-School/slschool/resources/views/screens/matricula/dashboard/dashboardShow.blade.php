@extends('layout.main')
@section('title', 'Sl-School - Salas de aulas')
@section('content')

    <link rel="stylesheet" href="">

    <!-- Start Content -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadastro base</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Salas de aulas</h4>

                    <div class="row mb-3 ps-3">
                        <div class="col-md-3">
                            <h5>Aluno: {{ $matricula->alunos->nome }}</h5>
                        </div>
                        <div class="col-md-2">
                            <h5>Matrícula: {{ $matricula->id }}</h5>
                        </div>
                        <div class="col-md-3">
                            <h5>Responsável: {{ $matricula->responsaveis->nome }}</h5>
                        </div>
                        <div class="col-md-2">
                            <h5>Curso: {{ $matricula->cursos->curso }}</h5>
                        </div>
                        <div class="col-md-2">
                            @if ($matricula->ativo == 'sim')
                                <h5 style="color: green">Situação: {{ $matricula->ativo }}</h5>
                            @else
                                <h5 style="color: royalblue">Situação: {{ $matricula->ativo }}</h5>
                            @endif

                        </div>
                    </div>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif
                    {{-- Fim da mensagem de sucesso ou erro --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="pt-3 ps-4">
                                <a href="{{ route('salasAulas.create') }}" class="btn btn-primary">Nova matrícula</a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="container mb-3">

                        {{-- Menu 1 --}}
                        <div class="row p-3">

                            <div class="col-sm-2">
                                <a href="{{ route('matricula.edit', $matricula->id) }}" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Matricula</h3>
                                            <i class="uil-book-reader" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="{{route('matricula_turmas.show', $matricula->id)}}" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Turmas</h3>
                                            <i class="uil-meeting-board" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="{{route('matricula_disciplina.show', $matricula->id)}}" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Disciplinas</h3>
                                            <i class="uil-notebooks" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Materiais</h3>
                                            <i class="uil-books" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Mensalidades</h3>
                                            <i class=" uil-usd-circle" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Contrato</h3>
                                            <i class="uil-file-edit-alt" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                        {{-- Fim Menu 1 --}}

                        <hr>

                        {{-- Menu 2 --}}

                        <div class="row">

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Info. Aluno</h3>
                                            <i class="uil-user" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Responsável</h3>
                                            <i class="uil-user-square" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                        {{-- Fim Menu 2 --}}
                        <hr>
                        {{-- Menu 3 --}}

                        <div class="row">

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Frequência</h3>
                                            <i class="uil-check-square" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Reposição</h3>
                                            <i class="uil-file-plus-alt" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                        {{-- Fim Menu 3 --}}

                        <hr>

                        {{-- Menu 4 --}}

                        <div class="row">

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Cancelar</h3>
                                            <i class="uil-times-square" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Trancar</h3>
                                            <i class=" uil-pause-circle" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Finalizar</h3>
                                            <i class=" uil-check-square" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Reativar</h3>
                                            <i class="uil-upload" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>

                        {{-- Fim Menu 4 --}}


                    </div>


                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
