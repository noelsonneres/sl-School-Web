@extends('layout.main')
@section('title', 'Sl-School - Salas de aulas')
@section('content')

    <link rel="stylesheet" href="">

    <!-- Start Content -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadastro base</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Salas de aulas</h4>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif
                    {{-- Fim da mensagem de sucesso ou erro --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="pt-3 ps-4">
                                <a href="{{ route('salasAulas.create') }}" class="btn btn-primary">Nova matrícula</a>
                                <!-- Button trigger modal -->
                                <button class="btn btn-secondary" onclick="print()">Imprimir</button>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="container mb-3">

                        <div class="row p-3">

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Matricula</h3>
                                            <i class="uil-book-reader" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Turmas</h3>
                                            <i class="uil-meeting-board" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>          
                            
                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Disciplinas</h3>
                                            <i class="uil-notebooks" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>        
                            
                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Materiais</h3>
                                            <i class="uil-books" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>     
                            
                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Mensalidades</h3>
                                            <i class=" uil-usd-circle" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>                              
                            
                            <div class="col-sm-2">
                                <a href="#" class="link-card">
                                    <div class="card rounded"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <div class="card-body text-center">
                                            <h3 style="font-weight: 400;">Contrato</h3>
                                            <i class="uil-file-edit-alt" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>  



                        </div>


                    </div>


                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
