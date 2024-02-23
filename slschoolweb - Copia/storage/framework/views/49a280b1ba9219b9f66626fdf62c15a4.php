<?php $__env->startSection('title', 'Caixa'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Iniciar ou encerrar um caixa</h3>
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

            <div class="col-4">

                <a href="<?php echo e(('/controle_caixa_novo_caixa')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo caixa</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="/dia_pesquisar" method="get">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="find" id="find" placeholder="Digite o que deseja buscar">
                    <button type="submit" class="btn btn-success btn-sm">Pesquisar
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <div class="table-responsive">
                <table class="table p-1">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">DT Abertura</th>
                        <th scope="col">HR Abertura</th>
                        <th scope="col">Saldo anterior</th>
                        <th scope="col">Saldo saldo informado</th>
                        <th scope="col">DT Encerramento</th>
                        <th scope="col">HR Enceramento</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operação</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $caixas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caixa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e($caixa->id); ?> </td>
                            <td><?php echo e(date('d/m/Y', strtotime($caixa->data_abertura))); ?> </td>
                            <td><?php echo e($caixa->hora_abertura); ?> </td>
                            <td>R$ <?php echo e(number_format($caixa->saldo_anterior, 2, ',', '.')); ?> </td>
                            <td>R$ <?php echo e(number_format($caixa->informado, 2, ',', '.')); ?> </td>

                            <?php if($caixa->data_encerramento != null): ?>
                                <td><?php echo e(date('d/m/Y', strtotime($caixa->data_encerramento))); ?> </td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                            <td><?php echo e($caixa->hora_encerramento); ?> </td>
                            <td>R$ <?php echo e(number_format($caixa->saldo_encerramento, 2, ',', '.')); ?> </td>

                            <?php if($caixa->status == 'encerrado'): ?>
                                <td style="color: red"><?php echo e($caixa->status); ?> </td>
                            <?php elseif($caixa->status == 'aberto'): ?>
                                <td style="color:forestgreen; font-weight: bold"><?php echo e($caixa->status); ?> </td>
                            <?php endif; ?>

                            <?php if($caixa->status == 'aberto'): ?>
                                <td>
                                    <div class="col-2">
                                        <a href="<?php echo e(route('controle_caixa.edit', $caixa->id)); ?>" class="btn btn-success btn-sm"
                                           title="Encerrar caixa">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                            <?php endif; ?>


                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    <?php echo e($caixas->links('pagination::pagination')); ?>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/controleCaixa/caixaShow.blade.php ENDPATH**/ ?>