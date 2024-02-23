@extends('layout.main')
@section('title', 'Sl School - Inserir configuração das mensalidades') 
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Adminstrativo</a></li>
                            <li class="breadcrumb-item active">Configurar mensalidades</li>
                        </ol>
                    </div>
                    
                    <h4 class="page-title">Inserir configurações das mensalidades</h4>

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
                            <form action="{{ route('configurar_mensalidade.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    <div class="col-md-6 mb-4">
                                        <label for="juros" class="form-label">Juros</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01" name="juros" id="juros"
                                             required value="{{old('juros')}}">
                                    </div>

                                    <div class="col-md-6  mb-4">
                                        <label for="multa" class="form-label">Multa</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01" name="multa" id="multa"
                                             required value="{{old('multa')}}">
                                    </div>
                                </div>

                                <div class=" mb-4">
                                    <label for="mensagem" class="form-label">Mensagem do carnê</label>
                                    <textarea class="form-control" name="mensagem" 
                                        id="mensagem" cols="30" rows="2" maxlength="50"></textarea>
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
