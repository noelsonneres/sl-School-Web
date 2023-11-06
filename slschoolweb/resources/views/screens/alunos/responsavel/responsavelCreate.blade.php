@extends('layouts.main')
@section('title', 'Novo responsavel')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir responsável</h3>
        </div>

        <hr>
            <h4 class="ps-3">Aluno(a): {{$nomeAluno}}</h4>
        <hr>

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

            <form action="{{ route('responsavel.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                    <input type="hidden" name="idAluno" value="{{$idAluno}}">

                    <div class="row">

                        <div class="col-md-8 mb-3">
                            <label for="nome" class="form-label lblCaption">Nome completo</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                placeholder="Digite o nome do responsável" autofocus required maxlength="100">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="apelido" class="form-label lblCaption">Apelido</label>
                            <input type="text" class="form-control" name="apelido" id="apelido"
                                maxlength="50">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col md-3 mb-3">
                            <label for="dataNascimento" class="form-label lblCaption">Data de nascimento</label>
                            <input type="date" class="form-control" name="dataNascimento" id="dataNascimento">
                        </div>

                        <div class="col md-3 mb-3">
                            <label for="dataCadatro" class="form-label lblCaption">Data de cadastro</label>
                            <input type="date" class="form-control" name="dataCadatro" id="dataCadatro" value="">                            
                        </div>                        

                        <div class="col md-3 mb-3">
                            <label for="cpf" class="form-label lblCaption">RG</label>
                            <input type="text" class="form-control" id="rg" name="rg">
                        </div>
                        
                        <div class="col md-3 mb-3">
                            <label for="cpf" class="form-label lblCaption">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf">                            
                        </div>                        

                    </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/disciplinas" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
