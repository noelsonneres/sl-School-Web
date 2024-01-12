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
        <h3 class="text-center text-white p-2">Incluir novos dias de aulas</h3>
    </div>    

  <form method="post" action="{{route('contrato.store')}}" enctype="multipart/form-data">
    @csrf

        <div class="mb-4 mt-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
        </div>

    <textarea id="contrato" name="contrato" style="height: 800px">

    </textarea>

    <div>
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