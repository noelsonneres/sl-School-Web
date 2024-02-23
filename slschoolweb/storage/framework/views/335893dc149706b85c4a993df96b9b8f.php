
<?php $__env->startSection('title', 'Selecione o contrato para impressão'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Selecione o contrato para impressão</h3>
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

            <div class="col-4">

                <a href="<?php echo e(route('contrato.create')); ?>" class="btn btn-primary" title="Criar novo curso">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo Contrato</a>

            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Operação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contratos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contrato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($contrato->id); ?> </td>
                            <td><?php echo e($contrato->descricao); ?> </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="<?php echo e('/contrato_iniciar/'.$matricula.'/'.$contrato->id); ?>"
                                                title="Editar informações do professor" class="btn btn-info btn-sm">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="row">
                <div>
                    <?php echo e($contratos->links('pagination::pagination')); ?>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/editorContrato/listarModeloContratosImpressao.blade.php ENDPATH**/ ?>