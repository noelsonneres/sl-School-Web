<?php $__env->startSection('title', 'Dias disponíveis para aulas'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir novos dias de aulas</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="<?php echo e(route('dias.store')); ?>" method="post">

            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="dia1" class="form-label lblCaption">Digite o primeiro dia</label>
                <input type="text" class="form-control" name="dia1" id="dia1" placeholder="Digite o primeiro dia" autofocus required>
            </div>
            <div class="mb-3">
                <label for="dia2" class="form-label lblCaption">Segundo dia</label>
                <input type="text" class="form-control" name="dia2" id="dia2" placeholder="Digite o segundo dia">
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/dias/diasCreate.blade.php ENDPATH**/ ?>