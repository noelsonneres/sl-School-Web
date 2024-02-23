<?php $__env->startSection('title', 'Selecionar Alunos'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Selecione o aluno para impressão da carteirinha</h3>
        </div>

        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <hr>

        <div class="row">

            <div class="col-8">

                <form action="/impressao_carteira_loc_alunos" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="alunos_id">Cód. Aluno</option>
                                <option value="id">Matrícula</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="find" id="find" placeholder="Digite o que deseja buscar">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-sm">Pesquisar</button>
                        </div>

                    </div>

                </form>
            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                <tr>
                    <th scope="col">Cód. Aluno</th>
                    <th scope="col">Matricula</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operação</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $matriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td><?php echo e($matricula->alunos_id); ?> </td>
                        <td><?php echo e($matricula->id); ?> </td>
                        <td><?php echo e($matricula->alunos->nome); ?> </td>
                        <td><?php echo e($matricula->cursos->curso); ?> </td>

                        <?php if($matricula->status == 'ativa'): ?>
                            <td style="color: #0c6135; font-weight: bold"><?php echo e($matricula->status); ?> </td>
                        <?php else: ?>
                            <td style="color: red; font-weight: bolder"><?php echo e($matricula->status); ?> </td>
                        <?php endif; ?>

                        <td>

                            <div>
                                <div class="row">
                                    <?php if($matricula->status == 'ativa'): ?>
                                        <div class="col-2">
                                            <a href="<?php echo e(('/impressao_carteira_confirmar/'.$matricula->id)); ?>" class="btn btn-success btn-sm" title="Selecionar o aluno para impressão">
                                                <i class="bi bi-check2-circle" style="font-size: 15px"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>


                                </div>

                            </div>

                        </td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    <?php echo e($matriculas->links('pagination::pagination')); ?>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/carteira/carteiraSelecionarAlunos.blade.php ENDPATH**/ ?>