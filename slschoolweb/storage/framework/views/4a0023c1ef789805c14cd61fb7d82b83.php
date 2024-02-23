<?php $__env->startSection('title', 'Grade de horários'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Grade de horários</h3>
        </div>


        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3"
                role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <hr>

        <div class="row">

            <form action="/grade_horarios_filtrar" method="get">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-4">
                        <select class="form-control" name="sala" id="sala">
                            <option value="">selecione a sala</option>

                            <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sala->id); ?>"><?php echo e($sala->sala); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <select class="form-control" name="dia" id="dia">
                            <option value="">Selecione um dia de aula</option>

                            <?php $__currentLoopData = $dias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dia->id); ?>"><?php echo e($dia->dia1); ?> - <?php echo e($dia->dia2); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-sm">Pesquisar</button>
                    </div>

                </div>

            </form>


        </div>

        <hr>

        <div class="card mt-4">


            <div class="row ms-1 p-2">

                <?php $__currentLoopData = $turmas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 card rounded-4 p-0 me-2 shadow"
                        style="height: 150px; background: rgb(38, 165, 216)">
                        <a href="<?php echo e(('/grade_horarios_alunos/'.$turma->id)); ?>" class="link-card">
                            <div class="card-body">
                                <h4 class="text-white" style="font-weight: 600"><?php echo e(Str::substr($turma->turma, 0, 50)); ?></h4>
                                <h5 class="text-white" style="font-weight: 500"><?php echo e($turma->sala->sala); ?>

                                    (<?php echo e($turma->sala->vagas); ?>)</h5>
                                <h6 class="text-white" style="font-weight: 500"><?php echo e($turma->cadastroDias->dia1); ?> -
                                    <?php echo e($turma->cadastroDias->dia2); ?></h6>
                                <h6 class="text-white" style="font-weight: 500"><?php echo e($turma->cadastroHorarios->entrada); ?> -
                                    <?php echo e($turma->cadastroHorarios->saida); ?></h6>
                                <h6 class="text-white" style="font-weight: 500"></h6>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/gradeHorarios/gradeHorarioshow.blade.php ENDPATH**/ ?>