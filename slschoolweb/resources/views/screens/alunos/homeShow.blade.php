
@extends('layouts.main')
@section('title', 'Alunos cadastrados')
@section('content')

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Alunos cadastrados</h3>
    </div>
    
    @if(isset($msg))
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5>{{$msg}} </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    @endif

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="{{route('alunos.create')}}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i>
                Novo </a>
            <button onclick="(print())" class="btn $teal-300">Imprimir</button>

        </div>

        <div class="col-8">

            <form action="/cursos_pesquisar" method="get">
                @csrf

                <div class="row">

                    <div class="col-md-3">
                        <select class="form-control" name="opt" id="opt">
                            <option value="id">Código</option>
                            <option value="curso">Curso</option>
                            <option value="desscricao">Descricao</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="find" id="find" placeholder="Digite o que deseja buscar">
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
                    <th scope="col">Nome</th>
                    <th scope="col">Apelido</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($alunos as $aluno)

                <tr>
                    <td>{{$aluno->id}} </td>
                    <td>{{$aluno->nome}} </td>
                    <td>{{$aluno->apelido}} </td>
                    <td>{{$aluno->telefone}} </td>
                    <td>{{$aluno->celular}} </td>

                    <td>

                            <div class="row">                          

                                <div class="col-2">
                                    <a href="{{ route('alunos.edit', $aluno->id) }}" 
                                           title="Visualizar informações do alunos" class="btn btn-success btn-sm">
                                           <i class="bi bi-eye"></i>
                                    </a>
                                </div>

                                <div class="col-2">
                                    <a href="{{ route('alunos.edit', $aluno->id) }}" 
                                           title="Responsável do aluno" class="btn btn-info btn-sm">
                                           <i class="bi bi-person-rolodex"></i>
                                    </a>
                                </div>

                                <div class="col-2">
                                    <a href="{{ route('alunos.edit', $aluno->id) }}" 
                                           title="Informações sobre a matrícula" class="btn btn-primary btn-sm">
                                           <i class="bi bi-folder-plus"></i>
                                    </a>
                                </div>

                            </div>

                    </td>
                </tr>

                @endforeach                
               
            </tbody>
        </table>

        <div class="row">
            <div>
                {{ $alunos->links('pagination::pagination') }}
            </div>
        </div>

    </div>

</div>

@endsection