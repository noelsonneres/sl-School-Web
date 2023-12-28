
@extends('layouts.main')
@section('title', 'Incluir nova mensalidade')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir nova mensalidade</h3>
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
        
    <div class="p-2">
        <h4>Aluno(a): {{$aluno->nome}}</h4>
        <h4>Matrícula: {{$matricula->id}}</h4>
    </div>

    <hr>

    <div class="card p-5">

        <form action="{{route('mensalidades.store')}}" method="post">

            @csrf

            <input type="hidden" name="responsavel" id="responsavel" value="{{$matricula->responsavels_id}}">
            <input type="hidden" name="aluno" id="aluno" value="{{$matricula->alunos_id}}">
            <input type="hidden" name="matricula" id="matricula" value="{{$matricula->id}}">

            <div class="row">

                <div class="col md-4 mb-4">
                    <label for="qtdeParcelas" class="form-label lblCaption">Quantidade de parcelas</label>
                    <input type="number" class="form-control" name="qtdeParcelas" id="qtdeParcelas"
                         required value="{{old('qtdeParcelas')}}">
                </div>

                <div class="col md-4 mb-4">
                    <label for="valor" class="form-label lblCaption">Valor da parcela</label>
                    <input type="number" class="form-control" name="valor" id="valor" 
                        required value="{{old('valor')}}"> 
                </div>
                
                <div class="col md-4 mb-4">
                    <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                    <input type="date" class="form-control" name="vencimento" id="vencimento" 
                        required value="{{old('vencimento')}}">  
                </div>   
                
                <div class="mb-3">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="50">
                </div>

            </div>

            <div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Gerar</button>

                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>

    </div>
</div>

@endsection