@extends('layout.main')
@section('title', 'Sl School - Atualizar informações da sala de Aula') 
@section('content')

    <script src="/assets/js/masks.js"></script>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadatro base</a></li>
                            <li class="breadcrumb-item active">Visualizar Info. Sala</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Visualizar ou atualizar as informações da sala</h4>

                    {{-- Exibe mensagens de sucesso ou erro --}}
                    @if (isset($msg))
                        <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h5>{{ $msg }} </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    @endif

                    @if (isset($msgErro))
                    <div class="alert alert-danger alert-dismissible fade show msg d-flex 
                            justify-content-between align-items-end mb-3"
                        role="alert" style="text-align: center;">
                        <h5>{{ $msgErro }} </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                    @if (session('erro'))
                        <div class="alert alert-danger alert-dismissible fade show msg d-flex 
                    justify-content-between align-items-end mb-3"
                            role="alert" style="text-align: center;">
                            <h6 style="color: red">{{ session('erro') }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- Fim do bloco de mensagens e erros --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Prencha os campos abaixo</h4>
                        <p class="text-muted font-14">
                            Os campos com "<span class="text-danger">*</span>" são obrigátorios
                        </p>

                        <hr>

                        <div class="card border p-2">
                            <form action="{{ route('salasAulas.update', $sala->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-9 mb-4">
                                        <label for="sala" class="form-label">Sala <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="sala" id="sala" maxlength="50"
                                             required value="{{$sala->sala}}">
                                    </div>
                                    <div class="col-md-3  mb-4">
                                        <label for="vagas" class="form-label">Vagas <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" name="vagas" id="vagas" 
                                            required value="{{$sala->vagas}}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="descricao" class="form-label">Descrição <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="descricao" id="descricao" required
                                         maxlength="255" value="{{$sala->descricao}}">
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-success">Salvar
                                        <i class="ri-save-3-fill"></i>
                                    </button>
                                    <a href="javascript:history.back()" class="btn btn-danger">Cancelar
                                        <i class=" ri-close-circle-fill"></i>
                                    </a>
                                </div>

                            </form>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
