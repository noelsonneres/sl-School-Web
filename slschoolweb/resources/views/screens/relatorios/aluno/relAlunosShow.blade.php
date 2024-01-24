@extends('layouts.main')
@section('title', 'Lista de alunos cadastrados')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Lista de alunos cadastrados</h4>
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

            <div class="col-5 border p-2 me-3">
                <form action="/rel_Aluno_loc_data" method="get">
                    @csrf

                    <div class="row">
                        <div class="col-md-5">
                            <label for="dt1" class="form-label">Primeira data</label>
                            <input type="date" class="form-control" name="dt1" id="dt1">
                        </div>

                        <div class="col-md-5">
                            <label for="dt2" class="form-label">Segunda data</label>
                            <input type="date" class="form-control" name="dt2" id="dt2">
                        </div>

                        <div class="col-md-2 mt-2">
                            <label for=""></label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="col-6 border p-2">
                <form action="/rel_Aluno_localizar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-4">
                            <label for="opt" class="form-label">Critério de pesquisa</label>
                            <select class="form-control" name="opt" id="opt" aria-label="Critério de pesquisa">
                                <option value="id">Código</option>
                                <option value="Nome">Nome</option>
                                <option value="apelido">Apelido</option>
                                <option value="cpf">CPF</option>
                                <option value="nome_mae">Nome da mãe</option>
                                <option value="nome_pai">Nome da pai</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="find" class="form-label">Caixa de pesquisar</label>
                            <input type="text" class="form-control" name="find" id="find"
                                placeholder="Digite o que deseja buscar" aria-label="Informação de busca">
                        </div>

                        <div class="col-md-2 mt-2">
                            <label for=""></label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>

        <hr>

        <div class="row border p-2">

            <form action="/rel_Aluno_loc_status" method="get">
                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <label for="ativo" class="form-label">Somente alunos ativos</label>
                        <select class="form-control" name="ativo" id="ativo">
                            <option value="sim">Sim</option>
                            <option value="bloqueado">Bloqueado</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-2">
                        <label for=""></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                </div>

            </form>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Apelido</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Data de cadastro</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->id }} </td>
                            <td>{{ $aluno->nome }} </td>
                            <td>{{ $aluno->apelido }} </td>
                            <td>{{ $aluno->cpf }} </td>
                            <td>{{ date('d/m/Y', strtotime($aluno->data_cadastro)) }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ ('/rel_Aluno_impressao/'.$aluno->id) }}" class="btn btn-success btn-sm"
                                                title="Visualizar informações do aluno">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('salas.edit', $aluno->id) }}" class="btn btn-info btn-sm"
                                                title="Visualizar informações do responável">
                                                <i class="bi bi-person-rolodex"></i>
                                            </a>
                                        </div>    
                                        
                                        <div class="col-2">
                                            <a href="{{'/matricula_home/'.$aluno->id}}" class="btn btn-primary btn-sm"
                                                title="Visualizar matrículas">
                                                <i class="bi bi-folder-plus"></i>
                                            </a>
                                        </div>                                             

                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>



            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                {{ $alunos->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
