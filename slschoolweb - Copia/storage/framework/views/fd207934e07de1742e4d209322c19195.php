<?php $__env->startSection('title', 'Alunos por turmas'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Alunos por turma</h4>
        </div>

        <hr>
        <div class="ps-3">
            <h3><?php echo e($turma->turma); ?></h3>
        </div>
        <hr>

        <div class="row">

            <div class="col-4">

                <a href="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                    Voltar</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

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

        <div class="card pt-2 mt-4 border">
            <h3 class="ms-5">Lista de alunos</h3>
            <table class="table p-1 table-striped">
                <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>


                <tbody>
                <?php $__currentLoopData = $matriculasTurmas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($turma->matriculas_id); ?> </td>
                        <td><?php echo e($turma->alunos->nome); ?> </td>
                        <td><?php echo e($turma->turmas->cadastroDias->dia1); ?> - <?php echo e($turma->turmas->cadastroDias->dia2); ?> </td>
                        <td><?php echo e($turma->turmas->cadastroHorarios->entrada); ?> - <?php echo e($turma->turmas->cadastroHorarios->saida); ?> </td>
                        <td><?php echo e($turma->turmas->sala->sala); ?></td>

                        <td>
                            <a href="<?php echo e(('/frequencia_adicionar/'.$turma->matriculas_id)); ?>" class="btn btn-info btn-sm" title="Lançar frequência">
                                <i class="bi bi-check-circle-fill"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>

        </div>


        <hr>
        <div class="card pt-2 mt-4 border">
            <h3 class="ms-5">Lista de reposições</h3>

            <table class="table p-1 table-striped">
                <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">Dias</th>
                    <th scope="col">Horários</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $reposicoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reposicao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($reposicao->matriculas_id); ?> </td>
                        <td><?php echo e($reposicao->alunos->nome); ?> </td>
                        <td><?php echo e($reposicao->turmas->cadastroDias->dia1); ?> - <?php echo e($reposicao->turmas->cadastroDias->dia2); ?> </td>
                        <td><?php echo e($reposicao->turmas->cadastroHorarios->entrada); ?> - <?php echo e($reposicao->turmas->cadastroHorarios->saida); ?> </td>
                        <td><?php echo e($reposicao->turmas->sala->sala); ?></td>

                        <td>
                            <a href="<?php echo e(('/frequencia_adicionar/'.$reposicao->matriculas_id)); ?>" class="btn btn-info btn-sm" title="Lançar frequência">
                                <i class="bi bi-check-circle-fill"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/gradeHorarios/gradeHorariosAlunos.blade.php ENDPATH**/ ?>