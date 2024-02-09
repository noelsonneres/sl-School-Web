@extends('layouts.main')
@section('title', 'Atualizar informações da conta')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar informações da conta</h3>
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

            <form action="{{ route('contas_pagar.update', $conta->id) }}" method="post">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-8 mb-4">
                        <label for="conta" class="form-label lblCaption">Conta</label>
                        <input type="text" class="form-control" name="conta" id="conta" maxlength="50"
                               autofocus required value="{{$conta->conta}}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="tipo" class="form-label lblCaption">Plano de contas</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="{{$conta->planoContas->id}}">{{$conta->planoContas->plano}}</option>

                            @foreach($planoContas as $plano)
                                <option value="{{$plano->id}}">{{$plano->plano}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label lblCaption">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao"
                           maxlength="100" value="{{$conta->descricao}}">
                </div>

                <div class="row">

                    <div class="col-md-3 mb-4">
                        <label for="valor" class="form-label lblCaption">Valor</label>
                        <input type="number" class="form-control" name="valor" id="valor" step="0.01" min="0.01"
                               required value="{{$conta->valor}}">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento"
                               required value="{{$conta->vencimento}}">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="juros" class="form-label lblCaption">Juros %</label>
                        <input type="number" class="form-control" name="juros" id="juros"
                               step="0.01" min="0" value="{{$conta->juros}}">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="multa" class="form-label lblCaption">Multa</label>
                        <input type="number" class="form-control" name="multa" id="multa"
                               step="0.01" min="0" value="{{$conta->multa}}">
                    </div>
                </div>

                <div class="row mb-4">

                    <div class="col-md-3">
                        <label for="desconto" class="form-label lblCaption">Desconto</label>
                        <input type="number" class="form-control" name="desconto" id="desconto"
                               step="0.01" min="0" value="{{$conta->desconto}}">
                    </div>

                    <div class="col-md-3">
                        <label for="acrescimo" class="form-label lblCaption">Acréscimo</label>
                        <input type="number" class="form-control" name="acrescimo" id="acrescimo"
                               step="0.01" min="0" value="{{$conta->acrescimo}}">
                    </div>

                    <div class="col-md-2">
                        <label for="dtPagamento" class="form-label lblCaption">DT. Pagamento</label>
                        <input type="date" class="form-control" name="dtPagamento" id="dtPagamento"
                            value="{{$conta->data_pagametno}}">
                    </div>

                    <div class="col-md-1">
                        <label for="pago" class="form-label lblCaption">Pago ?</label>
                        <select class="form-control" name="pago" id="pago" >
                            <option value="{{$conta->pago}}" >{{$conta->pago}}</option>
                            <option value="nao" >nao</option>
                            <option value="sim">sim</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="total" class="form-label lblCaption">Total</label>
                        <input type="number" class="form-control" name="total" id="total"
                            value="{{$conta->total}}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255"
                        value="{{$conta->observacao}}">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
