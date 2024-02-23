
<?php $__env->startSection('title', 'Localizar mensalidade'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Localizar mensalidade</h4>
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

            </div>

            <div class="col-8">

                <form action="/quitar_mensalidade_localizar" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Mensalidade</option>
                                <option value="matriculas_id">Matrícula</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="find" id="find"
                                placeholder="Digite o que deseja buscar">
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
                        <th scope="col">Mensalidade</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Nome</th>
                        <th scope="col">valor</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $mensalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensalidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($mensalidade->id); ?> </td>
                            <td><?php echo e($mensalidade->matriculas_id); ?> </td>
                            <td><?php echo e($mensalidade->alunos->nome); ?> </td>
                            <td>R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?> </td>
                            <td><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                            <td><?php echo e($mensalidade->pago); ?> </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <?php if($mensalidade->pago === 'nao'): ?>
                                            <div class="col-2">
                                                <a href="<?php echo e('/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id); ?>"
                                                    title="Informar quitação" class="btn btn-success btn-sm">
                                                    <i class="bi bi-currency-dollar"></i>
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

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($mensalidades->links('pagination::pagination')); ?>

            </div>

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/quitarMensalidade/quitarMensalidade.blade.php ENDPATH**/ ?>