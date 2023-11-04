@extends('layouts.main')
@section('title', 'Atualizar Informações da turma')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar Informações da turma</h3>
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

            <form action="{{ route('turma.update', $turmas->id) }}" method="post">

                @csrf
                @method('PUT')

                    <div class="mb-3">
                        <label for="turma" class="form-label lblCaption">Turma</label>
                        <input type="text" class="form-control" name="turma" id="turma" maxlength="100" 
                            autofocus required  autocomplete="off" value="{{$turmas->turma}}">
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label lblCaption">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao"
                            autocomplete="off" value="{{$turmas->descricao}}">
                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="dias" class="form-label lblCaption">Dias</label>
                            <select class="form-control" name="dias" id="dias">
                                <option value="{{$turmas->cadastroDias->id}}">{{$turmas->cadastroDias->dia1}}
                                                            - {{$turmas->cadastroDias->dia2}}</option>

                                @foreach ($dias as $dia)
                                    <option value="{{$dia->id}}">{{$dia->dia1}} - {{$dia->dia2}}</option>                                    
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="horarios" class="form-label lblCaption">Horários</label>
                            <select class="form-control" name="horarios" id="horarios">

                                <option value="{{$turmas->cadastroHorarios->id}}">{{$turmas->cadastroHorarios->entrada}} às 
                                                    {{$turmas->cadastroHorarios->saida}}</option>

                                @foreach ($horarios as $horario)
                                    <option value="{{$horario->id}}">{{$horario->entrada}} às {{$horario->saida}}</option>
                                @endforeach

                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="sala" class="form-label lblCaption">Sala</label>
                            <select class="form-control" name="sala" id="sala">

                                <option value="{{$turmas->sala->id}}">{{$turmas->sala->sala}}</option>

                                @foreach ($salas as $sala)
                                    <option value="{{$sala->id}}">{{$sala->sala}}</option>                                    
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="professor" class="form-label lblCaption">Professor</label>
                            <select class="form-control" name="professor" id="professor">

                                <option value="{{$turmas->professor->id}}">{{$turmas->professor->nome}}</option>

                                @foreach ($professores as $professor)

                                    <option value="{{$professor->id}}">{{$professor->nome}}</option>
                                    
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="turno" class="form-label lblCaption">Turno</label>
                            <select class="form-control" name="turno" id="turno">

                                <option value="{{$turmas->turno}}">{{$turmas->turno}}</option>
                                <option value="matutino">Matutino</option>
                                <option value="vespertino">Vespertino</option>
                                <option value="noturno">Noturno</option>
                                <option value="outros">Outros</option>

                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="ativa" class="form-label lblCaption">Ativa</label>
                            <select class="form-control" name="ativa" id="ativa">

                                <option value="{{$turmas->ativa}}">{{$turmas->ativa}}</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>

                            </select>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" id="obs" name="obs"
                             maxlength="255" value="{{$turmas->obs}}">
                    </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/turma" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

@endsection


















{{-- <p>{{$turmas}}</p> --}}
{{-- <p>{{$turmas->cadastroDias->dia1}} - {{$turmas->cadastroDias->dia2}}</p>
<p>{{$turmas->sala->sala}}</p>
<p>{{$turmas->professor->nome}}</p> --}}