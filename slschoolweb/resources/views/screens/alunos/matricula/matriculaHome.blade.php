@extends('layouts.main')
@section('title', 'Informações da matrícula')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Informações da matrícula</h3>
        </div>

        @if (isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="row">

            <div class="col-md-7 ms-3">
                <h4>Aluno(a): {{ $aluno->nome }}</h4>
                <h4>Matrícula: {{ $matricula->id }}</h4>
                <h5>Código: {{ $aluno->id }}</h5>
            </div>

            <div class="col-md-4">

                <a href="{{ '/matricula_adicionar/' . $aluno->id }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Nova Matrícula </a>

            </div>

        </div>

        <hr>

        <div class="container">

            <div class="row">

                <div class="col-sm-2">
                    <a href="{{ route('matricula.edit', $matricula->id) }}" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 156, 14); font-weight: 500;">Matricula</h2>
                                <i class="bi bi-person-vcard" style="font-size: 70px; color: rgb(14, 156, 14);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="{{ '/turmas_matricula_lista/' . $matricula->alunos_id . '/' . $matricula->id }}" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 59, 156); font-weight: 500;">Turmas</h2>
                                <i class="bi bi-person-video3" style="font-size: 70px; color: rgb(14, 59, 156);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="{{ route('mensalidades.show', $matricula->id) }}" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color:color: rgb(86, 6, 74); font-weight: 500;">Mensalidades</h2>
                                <i class="bi bi-currency-dollar" style="font-size: 70px; color: rgb(86, 6, 74);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="{{ route('matricula_materiais.show', $matricula->id) }}" class="link-card">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 style="color: rgb(246, 83, 97); font-weight: 500;">Materiais</h2>
                            <i class="bi bi-journal-check" style="font-size: 70px; color: rgb(246, 83, 97);"></i>
                        </div>
                    </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 style="color: rgb(204, 127, 44); font-weight: 500;">Disciplinas</h2>
                            <i class="bi bi-journals" style="font-size: 70px; color: rgb(204, 127, 44);"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 class="text-primary" style="font-weight: 500;">Contrato</h2>
                            <i class="bi bi-file-text text-primary" style="font-size: 70px;"></i>
                        </div>
                    </div>
                </div>

            </div>

            <hr>

            <div class="row">

                <div class="col-sm-2">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                        <div class="card-body text-center">
                            <h2 class="text-primary" style="font-weight: 500;">Responsável</h2>
                            <i class="bi bi-person-rolodex text-primary" style="font-size: 70px;"></i>
                        </div>
                    </div>
                </div>                

                <div class="col-sm-2">
                    <a href="http://" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 156, 14); font-weight: 500;">Frequência</h2>
                                <i class="bi bi-person-vcard" style="font-size: 70px; color: rgb(14, 156, 14);"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="http://" class="link-card">
                        <div class="card" style="display: flex; justify-content: center; align-items: center;">
                            <div class="card-body text-center">
                                <h2 style="color: rgb(14, 59, 156); font-weight: 500;">Resposição</h2>
                                <i class="bi bi-person-video3" style="font-size: 70px; color: rgb(14, 59, 156);"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>


    </div>

@endsection
