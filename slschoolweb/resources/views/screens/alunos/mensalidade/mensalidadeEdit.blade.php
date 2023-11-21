
@extends('layouts.main')
@section('title', 'Editar mensalidades')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Editar mensalidades</h3>
    </div>

    @if(isset($msg))
    <hr>
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="card p-5">

        <form action="{{route('mensalidades.update', $mensalidade->id)}}" method="post">

            @csrf
            @method('PUT')

            <input type="hidden" name="matricula" id="matricula" value="{{$mensalidade->matriculas_id}}">

            <div class="row">

            <div class="col-md-6 mb-3">
                <label for="valor" class="form-label lblCaption">Valor da parccela (R$)</label>
                <input type="number" class="form-control" step="0.01" min="0.01" name="valor" id="valor" 
                     autofocus required value="{{$mensalidade->valor_parcela}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="dataVencimento" class="form-label lblCaption">Data de vencimento</label>
                <input type="date" class="form-control" name="dataVencimento" id="dataVencimento"
                      required value="{{$mensalidade->vencimento}}">
            </div>

            <div class="mb-4">
                <label for="obs" class="form-label lblCaption">Observações</label>
                <input type="text" class=form-control name="obs" id="obs" maxlength="50" value="{{$mensalidade->observacao}}">
            </div>

            </div>

            <div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                 Atualizar</button>

                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>

    </div>
</div>

@endsection