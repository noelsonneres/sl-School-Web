
@extends('layouts.main')
@section('title', 'Configurações da carteira')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Configurações da carteira</h3>
        </div>

        @if(isset($msg))
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
                <h5>{{$msg}} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        <hr>

        <div class="card p-5">

            <form action="{{route('conf_carteira.store')}}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="mb-4">
                    <label for="mensagem" class="form-label lblCaption">Mensagem</label>
                    <input type="text" class="form-control" name="mensagem" id="mensagem"
                           placeholder="Digite a mensagem que será exibida na carteirinha"
                            autofocus required maxlength="255">
                </div>

                <div class="mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="foto">Selecione uma foto</label>
                        <input type="file" class="form-control" name="foto" id="foto"
                               onchange="exibirFotoSelecionada()">
                    </div>
                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/dias" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    <script>
        function exibirFotoSelecionada() {
            const input = document.getElementById("foto");
            const imagem = document.getElementById("imagemSelecionada");

            if (input.files && input.files[0]) {
                const leitor = new FileReader();

                leitor.onload = function(e) {
                    imagem.src = e.target.result;
                };

                leitor.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
