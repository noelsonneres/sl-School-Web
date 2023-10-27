@extends('layouts.main')
@section('title', 'Incluir nova disciplina')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir nova disciplina</h3>
        </div>

        @if (isset($msg))
            <hr>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="card p-5">

            <form action="{{ route('disciplinas.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="disciplinas" class="form-label lblCaption">Disciplina</label>
                    <input type="text" class="form-control" name="disciplinas" id="disciplinas"
                        placeholder="Digite um nome para a disciplina" autofocus required maxlength="50">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label lblCaption">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao"
                        placeholder="Informe uma descrição para a disciplina" maxlength="50">
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="valor" class="form-label lblCaption">Valor</label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="valor" id="valor">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="duracao" class="form-label lblCaption">Duração em meses</label>
                        <input type="number" class="form-control" name="duracao" id="duracao">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cargaHoraria" class="form-label lblCaption">Carga horária</label>
                        <input type="number" class="form-control" name="cargaHoraria" id="cargaHoraria">
                    </div>

                </div>

                <div class="mb-3">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/empresa" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>


@endsection
