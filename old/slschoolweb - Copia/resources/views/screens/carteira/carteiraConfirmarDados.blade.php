
@extends('layouts.main')
@section('title', 'Confirmar dados do aluno')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Confirmar dados antes de gerar a carteirinha</h3>
        </div>

        <hr>

            <div class="row ps-3">
                <div class="col-md-4"><h4>Aluno(a): {{$matricula->alunos->nome}}</h4></div>
                <div class="col-md-4"><h4>Matrícula: {{$matricula->id}}</h4></div>
                <div class="col-md-4"> <h4>Curso: {{$matricula->cursos->curso}}</h4></div>
            </div>

        <hr>

        <div class="card p-5">

            <form action="{{route('impressao_carteira.store')}}" method="post">

                @csrf

                <input type="hidden" name="alunos" value="{{$matricula->alunos_id}}">
                <input type="hidden" name="matriculas" value="{{$matricula->id}}">

                <div class="row mb-4">

                    <div class="col-md-6">
                        <label for="dtImpressao" class="form-label lblCaption">Data de impressão</label>
                        <input type="date" class="form-control" name="dtImpressao" id="dtImpressao"
                               value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="dtValidade" class="form-label lblCaption">Data de validade</label>
                        <input type="date" class="form-control" name="dtValidade" id="dtValidade" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="mensagem" class="form-label lblCaption">Mensagem</label>
                    <textarea class="form-control" name="mensagem" id="mensagem" maxlength="255" required>{{$conf->mensagem}}</textarea>
                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

                <div class="mb-4">
                    <div class="input-group mb-3">
{{--                        <label class="input-group-text" for="foto">Selecione uma foto</label>--}}
{{--                        <input type="file" class="form-control" name="foto" id="foto"--}}
{{--                               onchange="exibirFotoSelecionada()">--}}
                    </div>
                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px"
                         src="/img/aluno/{{ $matricula->alunos->foto }}">
                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                    Gerar Carteira
                </button>

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
