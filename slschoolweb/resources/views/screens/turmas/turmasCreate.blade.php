@extends('layouts.main')
@section('title', 'Incluir nova turma')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir nova turma</h3>
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

            <form action="{{ route('salas.store') }}" method="post">

                @csrf

                    <div class="mb-3">
                        <label for="turma" class="form-label lblCaption">Turma</label>
                        <input type="text" class="form-control" name="turma" id="turma" maxlength="100" 
                            autofocus required >
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label lblCaption">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="dias" class="form-label lblCaption">Dias</label>
                            <select class="form-control" name="dias" id="dias">
                                <option value="">Selecione um dia</option>

                                @foreach ($dias as $dia)
                                    <option value="{{$dia->id}}">{{$dia->dia1}} - {{$dia->dia2}}</option>                                    
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="horarios" class="form-label lblCaption">Horários</label>
                            <select class="form-control" name="horarios" id="horarios">

                                <option value="">Selecione um horário</option>

                                @foreach ($horarios as $horario)
                                    <option value="{{$horario->id}}">{{$horario->entrada}} às {{$horario->saida}}</option>
                                @endforeach

                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="sala" class="form-label lblCaption">Sala</label>
                            <select class="form-control" name="sala" id="sala">

                                <option value="">Selecione uma sala</option>

                                @foreach ($salas as $sala)
                                    <option value="{{$sala->id}}">{{$sala->sala}}</option>                                    
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="row">
                        
                    </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/config_mensalidades" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection
