@extends('layout.main')
@section('title', 'Sl School - Contrato do aluno')
@section('content')

    <script src="https://cdn.tiny.cloud/1/bbjex0u60g9l82u6f89sehnxo5muk831ojo2do93kqw1ud7s/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="/tinymce/langs/pt_BR.js"></script>
    <script>
        tinymce.init({
            selector: '#contrato',
            language: 'pt_BR',
        });
    </script>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Matrículas</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contrato do aluno</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Contrato do aluno</h4>
                    <h5 class="ps-2">Aluno: {{$matricula->alunos->nome}}&nbsp;&nbsp;  |&nbsp;&nbsp;  Matricula: {{$matricula->id}}</h5>
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
                        <div class="row">
                            <div class="col md-2 pt-3 ps-4">
                                <a href="{{('/dashboard/'.$matricula->id)}}" class="btn btn-danger">Voltar</a>
                            </div>
                        </div>
                        <hr>

                        <div class="card border p-2">
                            <form action="#" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="card">
                                    <textarea id="contrato" name="contrato" style="height: 800px">
                                       {{$contratoAluno}}
                                    </textarea>

                                </div>

                            </form>
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
