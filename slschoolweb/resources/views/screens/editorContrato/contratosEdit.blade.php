@extends('layouts.main')
@section('title', 'Modelo de contrato')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.tiny.cloud/1/bbjex0u60g9l82u6f89sehnxo5muk831ojo2do93kqw1ud7s/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script src="/tinymce/langs/pt_BR.js"></script>
        <script>
            tinymce.init({
                selector: '#contrato',
                language: 'pt_BR',
            });
        </script>
    </head>

    <body>

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-2">Atualizar informações do contrato</h3>
        </div>

        <hr>
        @if (isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
                                justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5>{{ $msg }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <form method="post" action="{{ route('contrato.update', $contrato->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="contratoID" value="{{ $contrato->id }}">

            <div class="mb-4 mt-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100"
                    value="{{ $contrato->descricao }}">
            </div>

            <textarea id="contrato" name="contrato" style="height: 800px">
        {{ $contrato->contrato }}
    </textarea>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-floppy2"></i>
                    Salvar</button>

                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar</a>
            </div>

        </form>
    </body>

@endsection
