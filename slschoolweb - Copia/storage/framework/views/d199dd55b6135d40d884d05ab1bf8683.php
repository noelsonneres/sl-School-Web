<?php $__env->startSection('title', 'Lista de mensalidades'); ?>
<?php $__env->startSection('content'); ?>

    <style>
        .pago {
            color: green;
        }

        .a-vencer {
            color: blue;
        }

        .vencido {
            color: red;
        }
    </style>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Mensalidades</h3>
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

            <div class="col-6">

                <a href="<?php echo e(('/mensalidades_adicionar/'.$matricula->id)); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Incluir mensalidade </a>

                <a href="<?php echo e('/mensalidades_impressao/'.$matricula->id); ?>"class="btn btn-success">
                    <i class="bi bi-printer-fill"></i>
                    Carnê de pagamento</a>

                    <a href="<?php echo e(route('matricula.show', $matricula->id)); ?>"class="btn btn-info">
                        <i class="bi bi-plus-circle-fill"></i>
                        Matrícula </a>

                <button onclick="(print())" class="btn $teal-300">Imprimir</button>

            </div>

        </div>

        <hr>

        <h4>Aluno(a): <?php echo e($aluno->nome); ?></h4>
        <h4>Matrícula: <?php echo e($matricula->id); ?></h4>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1 table-striped">
                <thead>
                    <tr>
                        <th scope="col">Mensalidades</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">Dt. Pgto</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $mensalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensalidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="pago">
                            <?php if($mensalidade->pago == 'sim'): ?>
                                <td style="color: #34d74a; font-weight: bold"><?php echo e($mensalidade->id); ?> </td>
                                <td style="color: #34d74a; font-weight: bold">R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?> </td>
                                <td style="color: #34d74a; font-weight: bold"><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                                <td style="color: #34d74a; font-weight: bold">
                                    <?php if($mensalidade->data_pagamento != null): ?>
                                        <?php echo e(date('d/m/Y', strtotime($mensalidade->data_pagamento))); ?>

                                    <?php endif; ?>
                                </td>
                                <td style="color: #34d74a; font-weight: bold"><?php echo e($mensalidade->pago); ?> </td>

                                <?php elseif($mensalidade->pago == 'nao' and $mensalidade->vencimento < now()): ?>

                                <td style="color: #e30f41; font-weight: bold"><?php echo e($mensalidade->id); ?> </td>
                                <td style="color: #e30f41; font-weight: bold">R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?> </td>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                                <td style="color: #e30f41; font-weight: bold">
                                    <?php if($mensalidade->data_pagamento != null): ?>
                                        <?php echo e(date('d/m/Y', strtotime($mensalidade->data_pagamento))); ?>

                                    <?php endif; ?>
                                </td>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e($mensalidade->pago); ?> </td>

                            <?php else: ?>
                                <td style="color: font-weight: bold"><?php echo e($mensalidade->id); ?> </td>
                                <td style="color: font-weight: bold">R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?> </td>
                                <td style="color: font-weight: bold"><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                                <td style="color: font-weight: bold"><?php if($mensalidade->data_pagamento <> null): ?>
                                    <?php echo e(date('d/m/Y', strtotime($mensalidade->data_pagamento))); ?>

                                <?php endif; ?> </td>
                                <td><?php echo e($mensalidade->pago); ?> </td>

                            <?php endif; ?>

                            <td>

                                <div class="row">

                                    <div class="col-2">
                                        <a href="<?php echo e('/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id); ?>"
                                            title="Informar quitação" class="btn btn-success btn-sm">
                                            <i class="bi bi-currency-dollar"></i>
                                        </a>
                                    </div>

                                    <div class="col-2">
                                        <a href="<?php echo e(route('mensalidades.edit', $mensalidade->id)); ?>"
                                            title="Editar mensalidade" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </div>

                                    <div class="col-2">

                                        <form method="POST" class="delete-form" action="<?php echo e(route('mensalidades.destroy', $mensalidade->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" title="Excluir professor" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>

            <div class="row">
                <div>
                    <?php echo e($mensalidades->links('pagination::pagination')); ?>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/mensalidade/mensalidadesShow.blade.php ENDPATH**/ ?>