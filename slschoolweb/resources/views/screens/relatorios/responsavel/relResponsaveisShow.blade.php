@extends('layouts.main')
@section('title', 'Lista de Responsáveis')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Lista de Responsáveis</h4>
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

        <div class="row ps-4">

            <div class="p-2">
                <form action="/rel_responsavel_localizar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-4">
                            <label for="opt" class="form-label">Critério de pesquisa</label>
                            <select class="form-control" name="opt" id="opt" aria-label="Critério de pesquisa">
                                <option value="id">Código</option>
                                <option value="Nome">Nome</option>
                                <option value="apelido">Apelido</option>
                                <option value="cpf">CPF</option>
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

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">Apelido</th>
                        <th scope="col">Código do aluno</th>
                        <th scope="col">Aluno</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($responsaveis as $responsavel)
                        <tr>

                            <td>{{ $responsavel->id }} </td>
                            <td>{{ $responsavel->nome }} </td>
                            <td>{{ $responsavel->apelido }} </td>
                            <td>{{ $responsavel->alunos->id }} </td>
                            <td>{{ $responsavel->alunos->nome }} </td>

                            <td>
                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ '/rel_responsavel_impressao/' . $responsavel->id }}"
                                                class="btn btn-success btn-sm" title="Visualizar informações do aluno">
                                                <i class="bi bi-printer-fill"></i>
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
                {{ $responsaveis->links('pagination::pagination') }}
            </div>

        </div>



    </div>

@endsection
