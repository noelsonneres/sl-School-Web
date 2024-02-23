<?php $__env->startSection('title', 'Editando as informações da sala'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Editando as informações da sala</h3>
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

            <form action="<?php echo e(route('salas.update', $salas->id)); ?>" method="post">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">

                    <div class="col-md-8 mb-3">
                        <label for="sala" class="form-label lblCaption">Sala</label>
                        <input type="text" class="form-control" name="sala" id="sala" 
                            maxlength="50" autofocus required value="<?php echo e($salas->sala); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="vagas" class="form-label lblCaption">Vagas</label>
                        <input type="number" class="form-control" name="vagas" id="vagas"
                             required value="<?php echo e($salas->vagas); ?>">
                    </div>

                    <div class="mb-4">
                        <label for="descricao" class="form-label lblCaption">Descrição</label>
                        <input type="text" class="form-control" name="descricao"
                             id="descricao" maxlength="100" value="<?php echo e($salas->descricao); ?>">
                    </div>

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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/salas/salasEdit.blade.php ENDPATH**/ ?>