
@extends('layouts.main')
@section('title', 'Atualizar informações da visita ou interesado')
@section('content')

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar informações da visita ou interesado</h3>
        </div>

        <hr>

        <div class="card p-5">

            <form action="{{route('visitas.update', $visitas->id)}}" method="post">

                @csrf
                @method('PUT')

                <div class="row mb-4">

                    <div class="col-md-6">
                        <label for="nome" class="form-label lblCaption">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" id="nome"
                               required maxlength="100" value="{{$visitas->nome}}">
                    </div>

                    <div class="col-md-3">
                        <label for="telefone" class="form-label lblCaption">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone" value="{{$visitas->telefone}}">
                    </div>

                    <div class="col-md-3">
                        <label for="celular" class="form-label lblCaption">Celular</label>
                        <input type="text" class="form-control" name="celular" id="celular"
                               required value="{{$visitas->celular}}">
                    </div>

                </div>

                <div class="mb-4">
                    <label for="email" class="form-label lblCaption">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" maxlength="100"
                        value="{{$visitas->email}}">
                </div>

                <div class="row mb-4">

                    <div class="col-md-3">
                        <label for="cep" class="form-label lblCaption">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" value="{{$visitas->cep}}">
                    </div>

                    <div class="col-md-9">
                        <label for="endereco" class="form-label lblCaption">Endereço</label>
                        <input type="text" class="form-control" name="endereco" id="endereco" maxlength="100"
                            value="{{$visitas->endereco}}">
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-6">
                        <label for="bairro" class="form-label lblCaption">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" maxlength="50" value="{{$visitas->bairro}}">
                    </div>

                    <div class="col-md-2">
                        <label for="numero" class="form-label lblCaption">Número</label>
                        <input type="number" class="form-control" name="numero" id="numero" value="{{$visitas->numero}}">
                    </div>

                    <div class="col-md-4">
                        <label for="complemento" class="form-label lblCaption">Complemento</label>
                        <input type="text" class="form-control" name="complemento" id="complemento" maxlength="50"
                               value="{{$visitas->complemento}}" >
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-9">
                        <label for="cidade" class="form-label lblCaption">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" maxlength="50"
                                value="{{$visitas->cidade}}">
                    </div>

                    <div class="col-md-3">
                        <label for="estado" class="form-label lblCaption">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" maxlength="2"
                            value="{{$visitas->estado}}">
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-6">
                        <label for="retorno" class="form-label lblCaption">Retorno</label>
                        <input type="text" class="form-control" name="retorno" id="retorno" maxlength="50"
                            value="{{$visitas->retorno}}">
                    </div>

                    <div class="col-md-6">
                        <label for="situacao" class="form-label lblCaption">Situação</label>
                        <input type="text" class="form-control" name="situacao" id="situacao" maxlength="50"
                            value="{{$visitas->situacao}}">
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-4">
                        <label for="grauInteresse" class="form-label llbCaption">Grau de interesse</label>
                        <select class="form-control" name="grauInteresse" id="grauInteresse">
{{--                            <option value="">Selecione uma opção</option>--}}
                            <option value="{{$visitas->grau_interesse}}">{{$visitas->grau_interesse}}</option>
                            <option value="alto">alto</option>
                            <option value="normal">normal</option>
                            <option value="baixo">baixo</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="curso" class="form-label llbCaption">Curso de interesse</label>
                        <select class="form-control" name="curso" id="curso">
{{--                            <option value="">Selecione uma opção</option>--}}
                            <option value="{{$visitas->curso_de_interesse}}">{{$visitas->curso_de_interesse}}</option>

                            @foreach($cursos as $curso)
                                <option value="{{$curso->curso}}">{{$curso->curso}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="turno" class="form-label lblCaption">Turno</label>
                        <select class="form-control" name="turno" id="turno">
                            <option value="{{$visitas->turno}}">{{$visitas->turno}}</option>
                            <option value="matutino">matutino</option>
                            <option value="vespertino">vespertino</option>
                            <option value="noturno">noturno</option>
                        </select>
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-6">

                        <label for="dia" class="form-label lblCaption">Dias</label>
                        <select class="form-control" name="dia" id="dia">
                            <option value="{{$visitas->dia}}">{{$visitas->dia}}</option>

                            @foreach($dias as $dia)
                                <option value="{{$dia->dia1}} - {{$dia->dia2}}">{{$dia->dia1}} - {{$dia->dia2}}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-6">

                        <label for="horarios" class="form-label lblCaption">Horários</label>
                        <select class="form-control" name="horarios" id="horarios">
                            <option value="{{$visitas->horario}}">{{$visitas->horario}}</option>

                            @foreach($horarios as $horario)
                                <option value="{{$horario->entrada}} - {{$horario->saida}}">{{$horario->entrada}} - {{$horario->saida}}</option>
                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255"
                        value="{{$visitas->observacao}}">
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

    {{-- PROCESSO DE VALIDAÇÃO DO CAMPOS --}}
    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- Inclua o InputMask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <script>
        // Aplicar a máscara de telefone usando InputMask
        $(document).ready(function() {
            $('#telefone').inputmask('(99) 9 9999-9999');
            $('#celular').inputmask('(99) 9 9999-9999');
            $('#cep').inputmask('99999-999');
            $('#cpf').inputmask('999.999.999-99');

            $('#cpfMae').inputmask('999.999.999-99');
            $('#cpfPai').inputmask('999.999.999-99');
        });
    </script>

    <!-- ViaCEP -->


    <!-- Adicionando Javascript -->
    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

@endsection
