<?php $__env->startSection('title', 'Novo aluno'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Cadastrando um novo aluno</h3>
        </div>

        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('alunos.store')); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>


                <div class="row">

                    <div class="col-md-9 mb-3">

                        <?php $__errorArgs = ['aluno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <label for="aluno" class="form-label lblCaption">Aluno</label>
                        <input type="text" class="form-control" name="aluno" id="aluno"
                            placeholder="Digite um curso para o professor" maxlength="100" autofocus
                            autocomplete="off">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="apelido" class="form-label lblCaption">Apelido</label>
                        <input type="text" class="form-control" id="apelido" name="apelido" maxlength="20"
                            autocomplete="off">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="dataNascimento" class="form-label lblCaption">Data de nascimento</label>
                        <input type="date" class="form-control" name="dataNascimento" id="dataNascimento">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="dataCadastro" class="form-label lblCaption">Data de cadatro</label>
                        <input type="date" class="form-control" name="dataCadastro" id="dataCadastro"
                            value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="rg" class="form-label lblCaption">RG</label>
                        <input type="text" class="form-control" name="rg" id="rg" maxlength="15">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cpf" class="form-label lblCaption">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="15">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="cep" class="form-label lblCaption">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" maxlength="12">
                    </div>

                    <div class="col-md-9 mb-3">
                        <label for="endereco" class="form-label lblCaption">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" maxlength="100">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="bairro" class="form-label lblCaption">Bairro</label>
                        <input type="text" class="form-control" name="bairro" id="bairro" maxlength="100">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="numero" class="form-label lblCaption">Número</label>
                        <input type="number" class="form-control" name="numero" id="numero">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="complemento" class="form-label lblCaption">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" maxlength="100">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-9 mb-3">
                        <label for="cidade" class="form-label lblCaption">Cidade</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" maxlength="50">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="estado" class="form-label lblCaption">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" maxlength="2">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="telefone" class="form-label lblCaption">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="celular" class="form-label lblCaption">Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label lblCaption">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="100">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="estadoCivil" class="form-label lblCaption">Estado civil</label>
                        <input type="text" class="form-control" id="estadoCivil" name="estadoCivil" maxlength="50">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="profissao" class="form-label lblCaption">Profissão</label>
                        <input type="text" class="form-control" id="profissao" name="profissao" maxlength="50">
                    </div>

                    <div class="col-md-4">
                        <label for="nacionalidade" class="form-label lblCaption">Nacionalidade</label>
                        <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" maxlength="50">
                    </div>

                    <div class="card mt-3">
                        <h3 class="p-2 mb-4">Filiação</h3>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="nomeMae" class="form-label lblCaption">Nome da mãe</label>
                                <input type="text" class="form-control" name="nomeMae" id="nomeMae">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="rgMae" class="form-label lblCaption">RG da mãe</label>
                                <input type="text" class="form-control" name="rgMae" id="rgMae">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cpfMae" class="form-label lblCaption">Cpf da mãe</label>
                                <input type="text" class="form-control" name="cpfMae" id="cpfMae">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="nomePai" class="form-label lblCaption">Nome do pai</label>
                                <input type="text" class="form-control" name="nomePai" id="nomePai">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="rgPai" class="form-label lblCaption">RG do pai</label>
                                <input type="text" class="form-control" name="rgPai" id="rgPai">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="cpfPai" class="form-label lblCaption">Cpf do pai</label>
                                <input type="text" class="form-control" name="cpfPai" id="cpfPai">
                            </div>

                        </div>

                    </div>

                    <div class="card mt-3">
                        <h3 class="p-2 mb-4">Informações medicas</h3>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="fobias" class="form-label lblCaption">Fobias</label>
                                <input type="text" class="form-control" name="fobias" id="fobias"
                                    maxlength="100">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="alergias" class="form-label lblCaption">Alergias</label>
                                <input type="text" class="form-control" name="alergias" id="alergias"
                                    maxlength="100">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="deficiencias" class="form-label lblCaption">Deficiência</label>
                                <input type="text" class="form-control" name="deficiencias" id="deficiencias"
                                    maxlength="100">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="outrosAspectos" class="form-label lblCaption">Outros aspectos</label>
                                <input type="text" class="form-control  " name="outrosAspectos" id="outrosAspectos"
                                    maxlength="100">
                            </div>

                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" id="obs" name="id">
                    </div>


                    <div class="mb-4">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="foto">Selecione uma foto</label>
                            <input type="file" class="form-control" name="foto" id="foto"
                                onchange="exibirFotoSelecionada()">
                        </div>
                        <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/home_aluno" class="btn btn-danger">
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/aluno/alunosCreate.blade.php ENDPATH**/ ?>