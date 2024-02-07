@extends('layouts.main')
@section('title', 'Relatótio Entrada de valores')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Relatótio Entrada de valores</h4>
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

        <div class="container border">

            <form action="/rel_entrada_loc_datas" method="get" id="searchForm">

                <div class="row mb-3 mt-2">

                    <div class="col-md-3">
                        <label for="dt1" class="form-label">Início</label>
                        <input type="date" class="form-control" name="dt1" id="dt1" required>
                    </div>
        
                    <div class="col-md-3">
                        <label for="dt2" class="form-label">Término</label>
                        <input type="date" class="form-control" name="dt2" id="dt2" required>
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

        <div class="container mt-4 border mb-4">

                <form action="rel_entrada_localizar" method="get">

                    <div class="row mb-3 mt-2">
                        <div class="col-md-8">
                            <label for="motivo" class="form-label">Motivo</label>
                            <input type="text" class="form-control" name="motivo" id="motivo">
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
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($entradas as $entrada)
                    <tr>

                        <td>{{ $entrada->id }} </td>
                        <td>{{date('d/m/Y', strtotime($entrada->data))}} </td>
                        <td>{{ $entrada->hora}} </td>
                        <td>{{ $entrada->motivo }} </td>
                        <td>R$ {{number_format( $entrada->valor, 2, ',', '.') }} </td>

                        <td>

                            <div>
                                <div class="row">

                                    <div class="col-2">
                                        <a href="{{('/rel_entrada_impressao/'.$entrada->id)}}"
                                           class="btn btn-primary btn-sm"
                                           title="Exibir informações da entrada">
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
                {{$entradas->links('pagination::pagination')}}
            </div>

        </div>


    </div>

    <script>
        // Restaurar valores dos campos ao carregar a página
        window.onload = function() {
            restoreFormValues();
        };

        // Armazenar valores dos campos no armazenamento local ao enviar o formulário
        document.getElementById('searchForm').addEventListener('submit', function() {
            storeFormValues();
        });

        // Função para armazenar valores dos campos no armazenamento local
        function storeFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                localStorage.setItem(element.name, element.value);
            });
        }

        // Função para restaurar valores dos campos do armazenamento local
        function restoreFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                if (localStorage.getItem(element.name)) {
                    element.value = localStorage.getItem(element.name);
                }
            });
        }
    </script>    

@endsection
