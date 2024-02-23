<?php $__env->startSection('title', 'Visualizar dados do dia selecionado'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Dados do dia selecionado</h3>
    </div>

    <hr>
        <h5>Código: <?php echo e($dias->id); ?></h5>
    <hr>

    <div class="card p-5">

        <form action="<?php echo e(route('dias.update', $dias->id)); ?>" method="post">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="dia1" class="form-label lblCaption">Digite o primeiro dia</label>
                <input type="text" class="form-control" name="dia1" id="dia1"
                         placeholder="Digite o primeiro dia" maxlength="50" autofocus required
                         value="<?php echo e($dias->dia1); ?>" >
            </div>
            <div class="mb-3">
                <label for="dia2" class="form-label lblCaption">Segundo dia</label>
                <input type="text" class="form-control" name="dia2" id="dia2"
                     placeholder="Digite o segundo dia" maxlength="50" value="<?php echo e($dias->dia2); ?>">
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/dias/diasEdit.blade.php ENDPATH**/ ?>