<?php $__env->startSection('title', 'Contas a pagar'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Contas a pagar</h4>
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

                <a href="<?php echo e(route('contas_pagar.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Novo</a>
                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

            <div class="col-8">

                <form action="<?php echo e(('/contas_localizar')); ?>" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="conta">Conta</option>
                                <option value="descricao">Descrição</option>
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

            <table class="table p-1 table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Conta</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">pago</th>
                    <th scope="col">DT. Pagamento</th>
                    <th scope="col">Operações</th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $contas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <?php if($conta->pago == 'sim'): ?>

                        <td style="color: #34d74a; font-weight: bold"><?php echo e($conta->id); ?> </td>
                        <td style="color: #34d74a; font-weight: bold"><?php echo e($conta->conta); ?> </td>
                        <td style="color: #34d74a; font-weight: bold"><?php echo e(date('d/m/Y', strtotime( $conta->vencimento))); ?> </td>
                        <td style="color: #34d74a; font-weight: bold">R$ <?php echo e(number_format( $conta->valor, 2, ',', '.')); ?> </td>
                        <td style="color: #34d74a; font-weight: bold"><?php echo e($conta->pago); ?> </td>
                        <td style="color: #34d74a; font-weight: bold">
                            <?php if($conta->data_pagametno != null): ?>
                                <?php echo e(date('d/m/Y', strtotime( $conta->data_pagametno))); ?>

                            <?php endif; ?></td>

                            <?php elseif($conta->pago == 'nao' and $conta->vencimento < now()): ?>

                            <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->id); ?> </td>
                            <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->conta); ?> </td>
                            <td style="color: #e30f41; font-weight: bold"><?php echo e(date('d/m/Y', strtotime( $conta->vencimento))); ?> </td>
                            <td style="color: #e30f41; font-weight: bold">R$ <?php echo e(number_format( $conta->valor, 2, ',', '.')); ?> </td>
                            <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->pago); ?> </td>
                            <td style="color: #e30f41; font-weight: bold">
                                <?php if($conta->data_pagametno != null): ?>
                                    <?php echo e(date('d/m/Y', strtotime( $conta->data_pagametno))); ?>

                                <?php endif; ?></td>

                        <?php elseif($conta->pago == 'nao' and $conta->vencimento >= now()): ?>

                            <td style="color: font-weight: bold"><?php echo e($conta->id); ?> </td>
                            <td style="font-weight: bold"><?php echo e($conta->conta); ?> </td>
                            <td style="font-weight: bold"><?php echo e(date('d/m/Y', strtotime( $conta->vencimento))); ?> </td>
                            <td style="font-weight: bold">R$ <?php echo e(number_format( $conta->valor, 2, ',', '.')); ?> </td>
                            <td style="font-weight: bold"><?php echo e($conta->pago); ?> </td>
                            <td style="font-weight: bold">
                                <?php if($conta->data_pagametno != null): ?>
                                    <?php echo e(date('d/m/Y', strtotime( $conta->data_pagametno))); ?>

                                <?php endif; ?></td>


                        <?php endif; ?>

                        <td>

                            <div>
                                <div class="row">

                                    <div class="col-3">
                                        <a href="<?php echo e(route('contas_pagar.edit', $conta->id)); ?>"
                                           class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>

                                    <div class="col-3">

                                        <form method="POST" class="delete-form"
                                              action="<?php echo e(route('contas_pagar.destroy', $conta->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete(this)">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(button) {
                                                if (confirm('Tem certeza de que deseja excluir este item?')) {
                                                    var form = button.closest('form');
                                                    form.submit();
                                                }
                                            }
                                        </script>


                                    </div>

                                </div>

                            </div>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>


            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($contas->links('pagination::pagination')); ?>

            </div>

        </div>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/contasPagar/contasPagarShow.blade.php ENDPATH**/ ?>