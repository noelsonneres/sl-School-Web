@extends('layouts.main')
@section('title', 'Lista de alunos bloqueados')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Lista de alunos bloqueados</h4>
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

            <div class="col-4">

                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            {{-- <div class="col-8">

                <form action="/sala_pesquisar" method="get">
                    @csrf

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="alunos_id">Código do aluno</option>
                                <option value="sala">Nome</option>
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

            </div> --}}

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cód. Aluno</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Data</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($bloqueados as $bloqueado)
                        <tr>
                            <td>{{ $bloqueado->id }} </td>
                            <td>{{ $bloqueado->alunos_id }} </td>
                            <td>{{ $bloqueado->alunos->nome }} </td>
                            <td>{{date('d/m/Y', strtotime( $bloqueado->data ))}} </td>
                            <td>{{ $bloqueado->status }} </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="{{ ('/bloqueados_visualizar/'.$bloqueado->id) }}" 
                                                    class="btn btn-info btn-sm"
                                                    title="Visaulizar informações do bloqueio">
                                                    <i class="bi bi-file-earmark-medical-fill"></i>
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
            {{$bloqueados->links('pagination::pagination')}}
            </div>

        </div>



    </div>

@endsection
