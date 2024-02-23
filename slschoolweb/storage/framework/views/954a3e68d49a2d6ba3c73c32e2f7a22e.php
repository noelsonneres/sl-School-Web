
<?php $__env->startSection('title', 'Bloqueios do alunos'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Lista de Bloqueios dos Alunos</h4>
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

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">Cód. Aluno</th>
                        <th scope="col">Aluno</th>
                        <th scope="col">Data</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $listas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($lista->alunos->id); ?> </td>
                            <td><?php echo e($lista->alunos->nome); ?> </td>
                            <td><?php echo e(date('d/m/Y', strtotime($lista->data))); ?> </td>

                            <?php if($lista->status == 'bloqueado'): ?>
                                <td style="color: red; font-weight: 800"><?php echo e($lista->status); ?> </td>
                            <?php else: ?>
                                <td style="color: green; font-weight: 800"><?php echo e($lista->status); ?> </td>
                            <?php endif; ?>

                            <td>

                                <div>
                                    <div class="row">

                                        <?php if($lista->status == 'bloqueado'): ?>
                                            <div class="col-2">
                                                <a href="<?php echo e('/desbloquear_alunos_desbloquear/' . $lista->id); ?>"
                                                    class="btn btn-success btn-sm" title="Desbloquear aluno">
                                                    <i class="bi bi-clipboard-check-fill"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <div class="col-2">
                                            <a href="<?php echo e('/desbloquear_alunos_detalhes/' . $lista->id); ?>"
                                                class="btn btn-info btn-sm" title="Ver informações do bloqueio">
                                                <i class="bi bi-file-earmark-richtext"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($listas->links('pagination::pagination')); ?>

            </div>

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/bloqueados/desbloquearAlunos.blade.php ENDPATH**/ ?>