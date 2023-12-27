
@extends('layouts.main')
@section('title', 'Nova visita ou interesado')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova visita ou interesado</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="{{route('visitas.store')}}" method="post">

                @csrf

                    <div class="row mb-4">

                        <div class="col-md-6">
                            <label for="nome" class="form-label lblCaption">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="nome" required maxlength="100">
                        </div>

                        <div class="col-md-3">
                            <label for="telefone" class="form-label lblCaption">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone">
                        </div>

                        <div class="col-md-3">
                            <label for="celular" class="form-label lblCaption">Celular</label>
                            <input type="text" class="form-control" name="celular" id="celular" required>
                        </div>

                    </div>

                    <div class="row mb-4">

                       <div class="col-md-3">
                           <label for="cep" class="form-label lblCaption">CEP</label>
                           <input type="text" class="form-control" name="cep" id="cep">
                       </div>

                        <div class="col-md-9">
                            <label for="endereco" class="form-label lblCaption">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco" maxlength="100">
                        </div>

                    </div>

                <div class="row mb-4">

                     <div class="col-md-6">
                         <label for="bairro" class="form-label lblCaption">Bairro</label>
                         <input type="text" class="form-control" name="bairro" id="bairro" maxlength="50">
                     </div>

                     <div class="col-md-2">
                         <label for="numero" class="form-label lblCaption">Número</label>
                         <input type="number" class="form-control" name="numero" id="numero">
                     </div>

                     <div class="col-md-4">
                         <label for="complemento" class="form-label lblCaption">Complemento</label>
                         <input type="text" class="form-control" name=complemento" id="complemento" maxlength="50">
                     </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-9">
                        <label for="cidade" class="form-label lblCaption">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" maxlength="50">
                    </div>

                    <div class="col-md-3">
                        <label for="estado" class="form-label lblCaption">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" maxlength="2">
                    </div>

                </div>

                <div class="row mb-4">

                   <div class="col-md-6">
                       <label for="retorno" class="form-label lblCaption">Retorno</label>
                       <input type="text" class="form-control" name="retorno" id="retorno" maxlength="50">
                   </div>

                    <div class="col-md-6">
                        <label for="situacao" class="form-label lblCaption">Situação</label>
                        <input type="text" class="form-control" name="situacao" id="situacao" maxlength="50">
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-4">
                        <label for="grauInteresse" class="form-label llbCaption">Grau de interesse</label>
                        <select class="form-control" name="grauInteresse" id="grauInteresse">
                            <option value="">Selecione uma opção</option>
                            <option value="alto">alto</option>
                            <option value="normal">normal</option>
                            <option value="baixo">baixo</option>
                        </select>
                    </div>

                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/dias" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
