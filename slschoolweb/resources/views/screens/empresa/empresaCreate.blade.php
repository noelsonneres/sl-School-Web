@extends('layouts.main')
@section('title', 'Informações da empresa')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Inserindo Informações da empresa</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="{{route('empresa.store')}}" method="post">

            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label lblCaption">Nome fantasia</label>
                <input type="text" class="form-control" name="nome" id="nome" 
                    placeholder="Digite o nome fantasia da empresa" autofocus required maxlength="50">
            </div>

            <div class="mb-3">
                <label for="razao_social" class="form-label lblCaption">Razão social</label>
                <input type="text" class="form-control" name="razao_social" id="razao_social" 
                    placeholder="Digite a razão social" maxlength="50">
            </div>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label for="dataAbertura" class="form-label lblCaption">Data de abertura</label>
                    <input type="date" class="form-control" name="dataAbertura" id="dataAbertura">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="cnpj" class="form-label lblCaption">CNPJ</label>
                    <input type="text" class="form-control" name="cnpj" id="cnpj">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="Telefone" class="form-label lblCaption">Telefone</label>
                    <input type="text" class="form-control" name="Telefone" id="Telefone">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="celular" class="form-label lblCaption">Celular</label>
                    <input type="text" class="form-control" name="celular" id="celular">
                </div>

            </div>

            <div class="mb-3">
                <label for="email" class="form-label lbl">E-mail</label>
                <input type="email" class="form-control" name="email" id="email">
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