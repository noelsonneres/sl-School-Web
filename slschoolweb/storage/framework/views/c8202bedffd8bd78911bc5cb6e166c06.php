<?php $__env->startSection('title', 'Incluir nova disciplina'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Incluir nova disciplina</h3>
        </div>

        <hr>
            <h5>Professor(a): <?php echo e($professor->nome); ?></h5>

        <?php if(isset($msg)): ?>
            <hr>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex 
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('professor_disciplina.store')); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="professor" value="<?php echo e($professor->id); ?>">
                <div class="mb-4">
                    <label for="disciplina" class="form-label lblCaption">Disciplina</label>
                    <select name="opt" id="opt" class="form-control">
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

                    <a href="/professores" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/disciplinasProfessores/disciplinasProfessorCreate.blade.php ENDPATH**/ ?>