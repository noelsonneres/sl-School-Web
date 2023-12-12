@extends('layouts.main')
@section('title', 'Nova Reposição')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova Reposição</h3>
        </div>

        <hr>

        <div class="row ms-4">

            <div class="col md-4">
                <h4>Aluno(a): {{ $matricula->alunos->nome }}</h4>
            </div>

            <div class="col-md-2">
                <h4>Matricula: {{ $matricula->id }}</h4>
            </div>

            <div class="col-md-6">
                <h4>Curso: {{ $matricula->cursos->curso }}</h4>
            </div>

        </div>

        <hr>

        <div class="row ms-4">
            <div class="col-4">
                <button onclick="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                    Voltar
                </button>

            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr>

        <div class="card p-5">

            <form action="{{ route('frequencia.store') }}" method="post">

                @csrf

                <input type="hidden" name="aluno" value="{{$matricula->alunos->id}}">
                <input type="hidden" name="matricula" value="{{$matricula->id}}">

                {{--      Campos do formulário    --}}

                <div class="row mb-4">

                    <div class="col-md-8">
                        <label for="turma" class="form-label lblCaption">Turma </label>
                        <input type="text" class="form-control" name="turma" id="turma" readonly required>
                    </div>

                    <div class="col-md-4 mt-4">
                        <a href="{{('/localizar_turma')}}" class="btn btn-info">
                            Localizar
                        </a>
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-3">
                        <label for="dataMarcacao" class="form-label lblCaption">Data de marcação</label>
                        <input type="date" class="form-control" name="dataMarcacao" id="dataMarcacao" required>
                    </div>

                    <div class="col-md-3">
                        <label for="horaMarcacao" class="form-label lblCaption">Horário da marcação</label>
                        <input type="time" class="form-control" name="horaMarcacao" id="horaMarcacao" required>
                    </div>

                    <div class="col-md-3">
                        <label for="dataReposicao" class="form-label lblCaption">Data para a reposição</label>
                        <input type="date" class="form-control" name="dataReposicao" id="dataReposicao" required>
                    </div>

                    <div class="col-md-3">
                        <label for="dataReposicao" class="form-label lblCaption">Data para a reposição</label>
                        <input type="time" class="form-control" name="dataReposicao" id="dataReposicao" required>
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-3">
                        <label for="status" class="form-label lblCaption">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option>Selecione uma opção</option>
                            <option value="marcada">marcada</option>
                            <option value="presente">presente</option>
                            <option value="ausente">ausente</option>
                            <option value="cancelada">cancelada</option>
                        </select>
                    </div>

                    <div class="col-md-9">
                        <label for="obs" class="form-label lblCaption">observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                    </div>

                </div>

                <div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar
                    </button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>

                </div>

            </form>

        </div>
    </div>

@endsection
