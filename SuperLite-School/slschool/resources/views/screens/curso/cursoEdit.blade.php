@extends('layout.main')
@section('title', 'Sl School - Atualizar as informações do curso')
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
                            <li class="breadcrumb-item active">Informações do Curso</li>
                        </ol>
                    </div>

                    <h4 class="page-title">Visualizar ou atualizar as informações do curso</h4>

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
                            <form action="{{ route('cursos.update', $curso->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="curso" class="form-label">Curso <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="curso" id="curso" required
                                        maxlength="50" value="{{$curso->curso}}">
                                </div>

                                <div class="mb-4">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" id="descricao"
                                        maxlength="100" value="{{$curso->descricao}}">
                                </div>

                                <div class="row">

                                    <div class="col-md-3 mb-4">
                                        <label for="valorAVista" class="form-label"> Valor a vista</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorAVista" id="valorAVista" value="{{$curso->valor_avista}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorComDesconto" class="form-label">Valor com desconto</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorComDesconto" id="valorComDesconto" value="{{$curso->valor_com_desconto}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="qtdeParcelas" class="form-label">Qtde. Parcelas <span
                                                class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" step="1" min="0" name="qtdeParcelas" id="qtdeParcelas"
                                            required onchange="calcular()" onblur="calcular()" value="{{$curso->qtde_parcelas}}">
                                    </div>

                                    <div class="col-md-3 mb-4">
                                        <label for="valorPorParcela" class="form-label">Valor por parcela</label>
                                        <input type="number" class="form-control" step="0.01" min="0.01"
                                            name="valorPorParcela" id="valorPorParcela" value="{{$curso->valor_por_parcela}}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4 mb-4">
                                        <label for="duracao" class="form-label">Duração <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" step="1" min="0" name="duracao" id="duracao"
                                             required value="{{$curso->duracao}}">
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="cargaHoraria" class="form-label">Carga horária <span class="text-danger">*</span> </label>
                                        <input type="number" class="form-control" step="1" min="0" name="cargaHoraria" id="cargaHoraria"
                                             required value="{{$curso->carga_horaria}}">
                                    </div>

                                    <div class="col md-4 mb-4">
                                        <label for="ativo" class="form-label">Ativo <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="ativo" id="ativo" required>
                                            <option value="{{$curso->ativo}}">{{$curso->ativo}}</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                        </select>
                                    </div>                                    

                                </div>

                                <div class="mb-4">
                                    <label for="obs" class="form-label">Observação</label>
                                    <input type="text" class="form-control" name="obs" id="obs" max="255"
                                        value="{{$curso->obs}}">
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

    {{--Calcula o valor da parcela --}}
    <script>
        function calcular() {
            var qtdeParcelaInput = document.getElementById("qtdeParcelas");
            var ValorParceladoInput = document.getElementById("valorComDesconto");
            
            var qtdeParcela = parseFloat(qtdeParcelaInput.value);
            var ValorParcelado = parseFloat(ValorParceladoInput.value);
    
            if (!isNaN(qtdeParcela) && !isNaN(ValorParcelado)) {
                var resultadoDivisao = ValorParcelado / qtdeParcela;
                document.getElementById("valorPorParcela").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>    

@endsection
