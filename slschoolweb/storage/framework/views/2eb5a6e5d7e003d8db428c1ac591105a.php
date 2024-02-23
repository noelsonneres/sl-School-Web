
<?php $__env->startSection('title', 'Bloquear aluno'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Bloquear aluno</h3>
        </div>

        <div class=" row ps-2">
            <div class="col-md-6">
                <h4>Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4>
            </div>
            <div class="col-md-3">
                <h5>Matrícula: <?php echo e($matricula->id); ?></h5>
            </div>
            <div class="col-md-3">
                <h5>Código do aluno: <?php echo e($matricula->alunos->id); ?></h5>
            </div>
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

            <form action="<?php echo e(route('bloqueados.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="matricula" value="<?php echo e($matricula->id); ?>">
                <input type="hidden" name="codigoAluno" value="<?php echo e($matricula->alunos->id); ?>">

                <div class="row mb-4">

                    <div class="col-md-2">
                        <label for="data" class="form-label lblCaption">Data</label>
                        <input type="date" class="form-control" name="data" id="name" required>
                    </div>

                    <div class="col-md-2">
                        <label for="hora" class="form-label lblCaption">Horário</label>
                        <input type="time" class="form-control" name="hora" id="hora" required>
                    </div>

                    <div class="col-md-8">
                        <label for="motivo" class="form-label lblCaption">Motivo</label>
                        <input type="text" class="form-control" name="motivo" id="motivo" required maxlength="50">
                    </div>

                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs">
                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Bloquear</button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/bloqueados/bloquearAluno.blade.php ENDPATH**/ ?>