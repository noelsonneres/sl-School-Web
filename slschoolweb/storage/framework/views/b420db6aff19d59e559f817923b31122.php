<?php $__env->startSection('title', 'Novo curso'); ?>
<?php $__env->startSection('content'); ?>

<div class="container">

    <div style="background-color: #1976D2;">
        <h3 class="text-center text-white p-3">Incluir um novo curso</h3>
    </div>

    <hr>

    <div class="card p-5">

        <form action="<?php echo e('/salvar_curso_disciplinas'); ?>" method="post" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <input type="hidden" name="curso" value="<?php echo e($cursoID); ?>">

            <div class="mb-4">
                <label for="disciplina" class="form-label">Selecione a disciplina</label>
                <select name="disciplina" id="disciplina" class="form-control">
                    <option value="">Selecione uma disciplina</option>    

                    <?php $__currentLoopData = $disciplinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disciplina): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($disciplina->id); ?>"><?php echo e($disciplina->disciplina); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>    
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/cursosDisciplinas/cursosDisciplinaCreate.blade.php ENDPATH**/ ?>