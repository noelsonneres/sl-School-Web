@extends('layouts.main')
@section('title', 'Nova frequência')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova frequência</h3>
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

                <div class="row">

                    <div class="col-md-6 mb-3">
                        @error('disciplina')
                        <span class="text text-danger">*</span>
                        @enderror
                        <label for="disciplina" class="form-label lblCaption">Disciplina</label>
                        <select class="form-control" name="disciplina" id="disciplina" required>
                            <option value="">Selecione a disciplina</option>

                            @foreach ($listaDisciplinas as $lista)
                                <option
                                    value="{{ $lista->disciplinas->id }}">{{ $lista->disciplinas->disciplina }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        @error('dataLancamento')
                        <span class="text text-danger">*</span>
                        @enderror
                        <label for="dataLancamento" class="form-label lblCaption">Data de lançamento</label>
                        <input type="date" class="form-control" name="dataLancamento" id="dataLancamento" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        @error('horaLancamento')
                        <span class="text text-danger">*</span>
                        @enderror
                        <label for="horaLancamento" class="form-label lblCaption">Hora lançamento</label>
                        <input type="time" class="form-control" name="horaLancamento" id="horaLancamento" required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        @error('situacao')
                        <span class="text text-danger">*</span>
                        @enderror
                        <label for="situacao" class="form-label lblCaption">Situação</label>
                        <select class="form-control" name="situacao" id="situacao" required>

                            <option value="">Selecione uma opção</option>
                            <option value="presente">presente</option>
                            <option value="ausente">ausente</option>

                        </select>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="justificativa" class="form-label lblCaption">Justificativa</label>
                        <input type="text" class="form-control" name="justificativa" id="justificativa" maxlength="50">
                    </div>

                </div>

                <div class="mb-3">
                    <label for="conteudo" class="form-label lblCaption">Conteúdo</label>
                    <input type="text" class="form-control" name="conteudo" id="conteudo" maxlength="100">
                </div>

                <div class="row">

                    <div class="col-md-2 mb-4">
                        @error('dataPresenca')
                        <span class="text text-danger">*</span>
                        @enderror
                        <label for="dataPresenca" class="form-label lblCaption">Data de presença</label>
                        <input type="date" class="form-control" name="dataPresenca" id="dataPresenca" required>
                    </div>

                    <div class="col-md-2 mb-4">
                        @error('horaPresenca')
                        <span class="text text-danger">*</span>
                        @enderror
                        <label for="horaPresenca" class="form-label lblCaption"> Horário da presença</label>
                        <input type="time" class="form-control" name="horaPresenca" id="horaPresenca" required>
                    </div>

                    <div class="col-md-8 mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
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
