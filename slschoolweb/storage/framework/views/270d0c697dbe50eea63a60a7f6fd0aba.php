<?php $__env->startSection('title', 'Nova entrada de valores'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova entrada de valores</h3>
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

            <form action="<?php echo e(route('entrada_valores.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="mb-4">
                        <label for="motivo" class="form-label lblCaption">Motivo</label>
                        <input type="text" class="form-control" name="motivo" id="motivo" maxlength="50"
                               autofocus required value="<?php echo e(old('sala')); ?>">
                    </div>

                <div class="row">

                    <div class="col-md-4 mb-4">
                        <label for="data" class="form-label lblCaption">Data</label>
                        <input type="date" class="form-control" name="data" id="data" required
                               value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>">
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="hora" class="form-label lblCaption">Hora</label>
                        <input type="time" class="form-control" name="hora" id="hora" required>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="valor" class="form-label lblCaption">valor</label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="valor" id="valor" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar
                    </button>

                    <a href="/config_mensalidades" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/entradaValores/entradaValoresCreate.blade.php ENDPATH**/ ?>