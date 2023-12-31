
@extends('layouts.main')
@section('title', 'Iniciar novo caixa')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Iniciar novo caixa</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="{{('/controle_caixa_iniciar')}}" method="post">

                @csrf

                <div class="row mb-4">

                    <div class="col-md-4">
                        <label for="dtAbetura" class="form-label lblCaption">Data de abertura</label>
                        <input type="date" class="form-control" name="dtAbetura" id="dtAbetura"
                               readonly required value="{{ \Carbon\Carbon::now()->toDateString() }}">
                    </div>

                    <div class="col-md-4">
                        <label for="hrAbetura" class="form-label lblCaption">Horário de abertura</label>
                        <input type="time" class="form-control" name="hrAbetura" id="hrAbetura"
                               readonly required value="{{ \Carbon\Carbon::now()->toTimeString() }}">
                    </div>

                    <div class="col-md-4">
                        <label for="funcionario" class="form-label lblCaption">Funcionário</label>
                        <input type="text" class="form-control" name="funcionario" id="funcionario" readonly required>
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-6">
                        <label for="saldoAnterior" class="form-label lblCaption">Saldo anterior (R$)</label>
                        <input type="number" class="form-control" name="saldoAnterior" id="saldoAnterior" readonly required value="0">
                    </div>

                    <div class="col-md-6">
                        <label for="valorInformado" class="form-label lblCaption">Valor informado (R$)</label>
                        <input type="number" class="form-control" name="valorInformado" id="valorInformado" required value="0">
                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

                <hr>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
