@extends('layouts.main')
@section('title', 'Finalizar caixa atual')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Finalizar o caixa atual</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="{{route('controle_caixa.update', $caixa->id)}}" method="post">

                @csrf
                @method('PUT')

                <div class="card border mb-4 ps-3 pe-3 pt-4 pb-4">

                    <h4 class="mb-4">Informações de abertura</h4>

                    <div class="row">

                        <div class="col-md-2">
                            <label for="dtAbertura" class="form-label lblCaption">Data de abertura</label>
                            <input type="date" class="form-control" name="dtAbertura" id="dtAbertura" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="hrAbertura" class="form-label lblCaption">HOrário de abertura</label>
                            <input type="time" class="form-control" name="hrAbertura" id="hrAbertura" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="funcionario" class="form-label lblCaption">Funcionário</label>
                            <input type="text" class="form-control" name="funcionario" id="funcionario"
                                   readonly maxlength="100">
                        </div>

                        <div class="col-md-2">
                            <label for="valorAnterior" class="form-label lblCaption">Valor anterior</label>
                            <input type="number" class="form-control" name="valorAnterior" id="valorAnterior" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="valorInformado" class="form-label lblCaption">Valor informado</label>
                            <input type="number" class="form-control" name="valorInformado" id="valorInformado" readonly>
                        </div>

                    </div>

                </div>

                <div class="card border mb-4 ps-3 pe-3 pt-4 pb-4">

                    <h4 class="mb-4">Informações de encerramento</h4>

                    <div class="row mb-4">

                        <div class="col-md-2">
                            <label for="dtEncerramento" class="form-label lblCaption">Data de encerramento</label>
                            <input type="date" class="form-control" name="dtEncerramento" id="dtEncerramento" required>
                        </div>

                        <div class="col-md-2">
                            <label for="hrEncerramento" class="form-label lblCaption">HR. encerramento</label>
                            <input type="time" class="form-control" name="hrEncerramento" id="hrEncerramento" required>
                        </div>

                        <div class="col-md-4">
                            <label for="funcEncerramento" class="form-label lblCaption">Funcionário Encerramennto</label>
                            <input type="text" class="form-control" name="funcEncerramento" id="funcEncerramento" maxlength="100">
                        </div>

                        <div class="col-md-2">
                            <label for="saldoEncerramento" class="form-label lblCaption">Saldo de encerramento</label>
                            <input type="number" class="form-control" name="saldoEncerramento" id="saldoEncerramento" required>
                        </div>

                        <div class="col-md-2">
                            <label for="status" class="form-label lblCaption">Status</label>
                            <input type="text" class="form-control" name="status" id="status" required>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                    </div>

                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar
                    </button>

                    <a href="/dias" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
