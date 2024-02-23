<?php $__env->startSection('title', 'Configurações das mensaliades'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Novas configurações das mensalidades</h3>
    </div>

    <?php if(isset($msg)): ?>
    <hr>
    <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
        <h5><?php echo e($msg); ?> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
    <?php endif; ?>

    <hr>

    <div class="card p-5">

        <form action="<?php echo e(route('config_mensalidades.store')); ?>" method="post">

            <?php echo csrf_field(); ?>

            <div class="row">

            <div class="col-md-6 mb-3">
                <label for="juros" class="form-label lblCaption">Juros por atraso (%)</label>
                <input type="number" class="form-control" step="0.01" min="0.01" name="juros" id="juros" 
                    placeholder="Digite o juros por atraso" autofocus required value="<?php echo e(old('juros')); ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="multa" class="form-label lblCaption">Multa por atraso (R$)</label>
                <input type="number" class="form-control" step="0.01" min="0.01" name="multa" id="multa"
                     placeholder="Informe a multa por atraso" required value="<?php echo e(old('multa')); ?>">
            </div>

            <div class="mb-4">
                <label for="mensagem" class="form-label lblCaption">Mensagem do carnê</label>
                <textarea class="form-control" name="mensagem" id="mensagem" cols="30" rows="5" maxlength="75"></textarea>
            </div>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/configMensalidades/configMensalidadesCreate.blade.php ENDPATH**/ ?>