<?php $__env->startSection('title', 'Atualizar dados da disciplina'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar dados da disciplina</h3>
        </div>

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

            <form action="<?php echo e(route('disciplinas.update', $disciplina->id)); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="disciplinas" class="form-label lblCaption">Disciplina</label>
                    <input type="text" class="form-control" name="disciplinas" id="disciplinas"
                        placeholder="Digite um nome para a disciplina" autofocus required maxlength="50"
                            value="<?php echo e($disciplina->disciplina); ?>">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label lblCaption">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao"
                        placeholder="Informe uma descrição para a disciplina" maxlength="50" 
                            value="<?php echo e($disciplina->descricao); ?>">
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="valor" class="form-label lblCaption">Valor (R$)</label>
                        <input type="number" step="0.01" min="0.01" class="form-control"
                             name="valor" id="valor" value="<?php echo e($disciplina->valor); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="duracao" class="form-label lblCaption">Duração em meses</label>
                        <input type="number" class="form-control" name="duracao" id="duracao" 
                            value="<?php echo e($disciplina->duracao_meses); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="cargaHoraria" class="form-label lblCaption">Carga horária</label>
                        <input type="number" class="form-control" name="cargaHoraria" id="cargaHoraria" 
                            value="<?php echo e($disciplina->carga_horaria); ?>">
                    </div>

                </div>

                <div class="mb-3">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs"
                    value="<?php echo e($disciplina->observacao); ?>" maxlength="255">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

                    <a href="/disciplinas" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/disciplinas/disciplinasEdit.blade.php ENDPATH**/ ?>