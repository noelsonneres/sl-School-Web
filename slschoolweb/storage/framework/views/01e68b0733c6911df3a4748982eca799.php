<?php $__env->startSection('title', 'Reativar Matrícula'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Reativar Matrícula</h3>
        </div>

        <hr>
        <h4 class="p-1">Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4>
        <h4 class="p-1">Matrícula: <?php echo e($matricula->id); ?></h4>
        <h4 class="p-1" style="font-weight: 800">Status: <?php echo e($matricula->status); ?></h4>
        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('matricula_reativar.store')); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="aluno" value="<?php echo e($matricula->alunos->id); ?>">
                <input type="hidden" name="matricula" value="<?php echo e($matricula->id); ?>">


                <div class="row mb-3 p-3">

                    <div class="col-md-6">
                        <label for="data" class="form-label lblCaption">Data</label>
                        <input type="date" class="form-control" name="data" id="data">
                    </div>

                    <div class="col-md-6">
                        <label for="horario" class="form-label lblCaption">Horário</label>
                        <input type="time" class="form-control" name="horario" id="horario">
                    </div>

                </div>

                <div class="mb-3  p-3">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

        </div>

        <div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-floppy2"></i>
                Reativar
            </button>

            <a href="javascript:history.back()" class="btn btn-danger">
                <i class="bi bi-x-circle-fill"></i>
                Cancelar</a>
        </div>

        </form>

    </div>
  

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/reativar/matriculaReativar.blade.php ENDPATH**/ ?>