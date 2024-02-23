<?php $__env->startSection('title', 'Quitar mensalidade'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Informa quitação de mensalidade</h3>
        </div>

        

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(('/mensalidades_quitar')); ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="responsavel" id="responsavel" value="<?php echo e($responsavel->id); ?>">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="card p5">

                    <h4 class="p-3">Informações do aluno</h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label lblCaption">Nome do aluno</label>
                            <input type="text" class="form-control" name="nome" id="nome" readonly
                                value="<?php echo e($aluno->nome); ?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="codigo" class="form-label lblCaption">Código do aluno</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" readonly
                                value="<?php echo e($aluno->id); ?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="matricula" class="form-label lblCaption">Matrícula</label>
                            <input type="text" class="form-control" name="matricula" id="matricula" readonly
                                value="<?php echo e($matricula->id); ?>">
                        </div>

                    </div>

                </div>

                <div class="card-p5">

                    <h4 class="p-3">Informações da mensalidade</h4>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="menalidade" class="form-label lblCaption">Mensalidade</label>
                            <input type="text" class="form-control" name="menalidade" id="menalidade" readonly
                                value="<?php echo e($mensalidade->id); ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                            <input type="text" class="form-control" id="vencimento" name="vencimento" readonly
                                value="<?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="valor" class="form-label lblCaption">Valor da parcela</label>
                            <input type="text" class="form-control" id="valor" name="valor" readonly
                                value="R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?>"
                                style="color: red">
                        </div>

                    </div>

                </div>

                <div class="card-p5 mt-4">

                    <h4 class="p-3">Informações para pagamento</h4>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="juros" class="form-label lblCaption">Juros (<?php echo e($juros['taxaJuros']); ?>%)</label>
                            <input type="text" class="form-control" id="juros" name="juros" readonly
                                value="R$ <?php echo e(number_format($juros['valorJuros'], '2', ',', '.')); ?>"
                                style="color: red">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="multa" class="form-label lblCaption">Multa</label>
                            <input type="text" class="form-control" id="multa" name="multa" readonly
                                value="R$ <?php echo e(number_format($juros['multa'], '2', ',', '.')); ?>"
                                style="color: red">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="desconto" class="form-label lblCaption">Desconto</label>
                            <input type="number" step="0.01" min="0.00" class="form-control" id="desconto"
                                name="desconto" onchange="calcular()" onblur="calcular()" value="0">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="acrescimo" class="form-label lblCaption">Acréscimo</label>
                            <input type="number" step="0.01" min="0.00" class="form-control" id="acrescimo"
                                name="acrescimo" onchange="calcular()" onblur="calcular()"  value="0">
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-2 mb-b">
                            <label for="valorPago" class="form-label lblCaption">Valor pago (R$)</label>
                            <input type="number" class="form-control" step="0.01" min="0.01"
                                name="valorPago" id="valorPago" style="color: red"
                                value="<?php echo e($mensalidade->valor_parcela + $juros['multa'] + $juros['valorJuros']); ?>"
                                    >
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="dataPagamento" class="form-label lblCaption">Data de pagamento</label>
                            <input type="date" class="form-control" name="dataPagamento" id="dataPagamento"
                                style="color: red">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="pago" class="form-label lblCaption">Pago</label>
                            <select class="form-control" name="pago" id="pago">
                                <option value="">Selecione uma opção</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="responsavelPgto" class="form-label lblCaption">Responsável pelo pagamento</label>
                            <input type="text" class="form-control" name="responsavelPgto" id="responsavelPgto">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="meioPagamento" class="form-label lblCaption">Meio de pagamento</label>
                        <select class="form-control" name="meioPagamento" id="meioPagamento" style="color: red">
                            <option value="">Selecione uma forma de pagamento</option>

                            <?php $__currentLoopData = $formas_pagamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($forma->meio_pagamento); ?>"><?php echo e($forma->meio_pagamento); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs"
                            value="<?php echo e($mensalidade->observacao); ?>" maxlength="255">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/professores" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function calcular() {
            var valorParcelaInput = document.getElementById("valor");
            var descontoInput = document.getElementById("desconto");
            var acrescimoInput = document.getElementById("acrescimo");

            var valorParcela = <?php echo e($mensalidade->valor_parcela); ?>;
            var desconto = parseFloat(descontoInput.value);
            var acrescimo = parseFloat(acrescimoInput.value);

            desconto = (isNaN(desconto))?0:desconto;
            acrescimo = (isNaN(acrescimo))?0:acrescimo;

             console.log(acrescimo);

            var juros = <?php echo e($juros['valorJuros']); ?>;
            var multa = <?php echo e($juros['multa']); ?>;

            if (!isNaN(valorParcela) && !isNaN(desconto) && !isNaN(acrescimo))
             {
                var resultado = (valorParcela + acrescimo + multa + juros) - desconto;
                document.getElementById("valorPago").value = resultado.toFixed(2);
            }
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/mensalidade/mensalidadesPagamento.blade.php ENDPATH**/ ?>