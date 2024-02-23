<?php $__env->startSection('title', 'Inclusão de novos horários'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir novos horários de aulas</h3>
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

            <form action="<?php echo e(route('horarios.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="entrada" class="form-label lblCaption">Horário de entrada</label>
                    <input type="time" class="form-control" name="entrada" id="entrada" autofocus required>
                </div>
                <div class="mb-3">
                    <label for="saida" class="form-label lblCaption">Horário de saída</label>
                    <input type="time" class="form-control" name="saida" id="saida" required>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/horarios/horariosCreate.blade.php ENDPATH**/ ?>