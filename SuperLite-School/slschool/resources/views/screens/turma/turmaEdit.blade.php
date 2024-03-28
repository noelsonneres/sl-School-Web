@extends('layout.main')
@section('title', 'Sl School - Atualizar informações da turma')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadatro base</a></li>
                            <li class="breadcrumb-item active">Info. Turmas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Visualizar ou atualizar informações da turma</h4>

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
                            <form action="{{ route('turmas.update', $turma->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="turma" class="form-label">Turma <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="turma" id="turma" required
                                           maxlength="50" value="{{$turma->turma}}">
                                </div>

                                <div class="mb-4">
                                    <label for="descricao" class="form-label">Descrição </label>
                                    <input type="text" class="form-control" name="descricao" id="descricao" required
                                           maxlength="100" value="{{$turma->descricao}}">
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="dias" class="form-label">Dias de aulas
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="dias" id="dias" required>
                                            <option value="{{$turma->dias_aulas->id}}">{{$turma->dias_aulas->dia}}</option>

                                            @foreach ($listaDias as $lista)
                                                <option value="{{ $lista->id }}">{{ $lista->dia }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="horario" class="form-label">Horários de aulas
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="horario" id="horario" required>
                                            <option value="{{$turma->horarios_aulas->id}}">
                                                {{ $turma->horarios_aulas->entrada }} - {{ $turma->horarios_aulas->saida }}
                                            </option>

                                            @foreach ($listaHorarios as $lista)
                                                <option value="{{ $lista->id }}">{{ $lista->entrada }} -
                                                    {{ $lista->saida }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="sala" class="form-label">Sala
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="sala" id="sala" required>
                                            <option value="{{$turma->salas_aulas->id}}">{{$turma->salas_aulas->sala}}</option>

                                            @foreach ($listaSala as $sala)
                                                <option value="{{$sala->id}}">{{$sala->sala}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="professor" class="form-label">Professor</label>
                                        <select class="form-control" name="professor" id="professor">

                                            @if(@isset($turma->professores->id))
                                              <option value="{{$turma->professores->id}}">{{$turma->professores->nome }}</option>
                                            @else
                                                <option value="">Selecione um professor</option>
                                            @endif
                                            

                                            @foreach ($listaProfessores as $lista)
                                                <option value="{{$lista->id}}">{{$lista->nome}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="turno" class="form-label">Turno
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="turno" id="turno" required>
                                            <option value="{{$turma->turno}}">{{$turma->turno}}</option>
                                            <option value="matutino">Matutino</option>
                                            <option value="vespertino">Vespertino</option>
                                            <option value="noturno">Noturno</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="ativa" class="form-label">Ativa
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="ativa" id="ativa" required>
                                            <option value="{{$turma->ativa}}">{{$turma->ativa}}</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs"
                                           maxlength="255" value="{{$turma->obs}}">
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
