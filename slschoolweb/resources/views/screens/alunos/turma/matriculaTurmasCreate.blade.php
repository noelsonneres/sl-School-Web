@extends('layouts.main')
@section('title', 'Selecione a turma que deseja adicionar')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Selecione a turma que deseja adicionar</h4>
        </div>

        @if (isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                        justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="row">

            <div class="col-8">

                <form action="/turma_pesquisar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="turma">Turma</option>
                                <option value="descricao">Descrição</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="find" id="find"
                                placeholder="Digite o que deseja buscar">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-sm">Pesquisar</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Turma</th>
                        <th scope="col">Dias</th>
                        <th scope="col">Horários</th>
                        <th scope="col">Adicionar</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($listaTurmas as $turma)
                        <tr>
                            <td>{{ $turma->id }} </td>
                            <td>{{ Str::substr($turma->turma, 0, 30) }} </td>
                            <td>{{ $turma->cadastroDias->dia1 }} - {{ $turma->cadastroDias->dia2 }}</td>
                            <td>{{ $turma->cadastroHorarios->entrada }} - {{ $turma->cadastroHorarios->saida }}</td>
                            
                            <td>

                                <div class="col-3">

                                    <form method="POST" action="{{ route('matricula_turmas.store') }}">
                                        @csrf             
                                        <input type="hidden" name="matricula" id="matricula" value="{{$matricula}}">
                                        <input type="hidden" name="turma" id="turma" value="{{$turma->id}}">                           
                                        <button type="submit" class="btn btn-success btn">Adicionar</button>
                                    </form>

                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{ $listaTurmas->links('pagination::pagination') }}
            </div>
        </div>
    </div>

@endsection
