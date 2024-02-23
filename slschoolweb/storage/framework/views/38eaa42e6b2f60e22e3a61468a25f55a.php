<?php $__env->startSection('title', 'Nova conta a pagar'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir uma nova conta</h3>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('contas_pagar.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-8 mb-4">
                        <label for="conta" class="form-label lblCaption">Conta</label>
                        <input type="text" class="form-control" name="conta" id="conta" maxlength="50"
                               autofocus required value="<?php echo e(old('conta')); ?>">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="tipo" class="form-label lblCaption">Plano de contas</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="">Selecione o plano de contas</option>

                            <?php $__currentLoopData = $planoContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plano->id); ?>"><?php echo e($plano->plano); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label lblCaption">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100">
                </div>

                <div class="row">

                    <div class="col-md-3 mb-4">
                        <label for="valor" class="form-label lblCaption">Valor</label>
                        <input type="number" class="form-control" name="valor" id="valor" step="0.01" min="0.01"
                               required value="<?php echo e(old('valor')); ?>">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="vencimento" class="form-label lblCaption">Vencimento</label>
                        <input type="date" class="form-control" name="vencimento" id="vencimento"
                               required value="<?php echo e(old('vencimento')); ?>">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="juros" class="form-label lblCaption">Juros %</label>
                        <input type="number" class="form-control" name="juros" id="juros" step="0.01" min="0.01">
                    </div>

                    <div class="col-md-3 mb-4">
                        <label for="multa" class="form-label lblCaption">Multa</label>
                        <input type="number" class="form-control" name="multa" id="multa" step="0.01" min="0.01">
                    </div>
                </div>

                <div class="row mb-4">

                    <div class="col-md-3">
                        <label for="desconto" class="form-label lblCaption">Desconto</label>
                        <input type="number" class="form-control" name="desconto" id="desconto" step="0.01" min="0.01">
                    </div>

                    <div class="col-md-3">
                        <label for="acrescimo" class="form-label lblCaption">Acréscimo</label>
                        <input type="number" class="form-control" name="acrescimo" id="acrescimo" step="0.01" min="0.01">
                    </div>

                    <div class="col-md-2">
                        <label for="dtPagamento" class="form-label lblCaption">DT. Pagamento</label>
                        <input type="date" class="form-control" name="dtPagamento" id="dtPagamento">
                    </div>

                    <div class="col-md-1">
                        <label for="pago" class="form-label lblCaption">Pago ?</label>
                        <select class="form-control" name="pago" id="pago" >
                            <option value="nao" >nao</option>
                            <option value="sim">sim</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="total" class="form-label lblCaption">Total</label>
                        <input type="number" class="form-control" name="total" id="total">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/contasPagar/contasCreate.blade.php ENDPATH**/ ?>