
<?php $__env->startSection('title', 'Relatório Contas a Pagar'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">
        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Relatório Contas a Pagar</h4>
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

        <div class="container">

            <div class="row p-2 border">

                <form action="/rel_contas_pagar_localizar" method="get" id="searchForm">
                    <div class="row">

                        <div class="col-md-2">
                            <label for="planoContas" class="form-label">Plano de contas</label>
                            <select class="form-control" name="planoContas" id="planoContas" required>
                                <option value=""></option>
                                <?php $__currentLoopData = $planoContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plano): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($plano->id); ?>"><?php echo e($plano->plano); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="criterio" class="form-label">Critério</label>
                            <select class="form-control" name="criterio" id="criterio" required>
                                <option value=""></option>
                                <option value="vencimento">Vencimento</option>
                                <option value="data_pagametno">pagamento</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="dt1" class="form-label">Início</label>
                            <input type="date" class="form-control" name="dt1" id="dt1">
                        </div>

                        <div class="col-md-2">
                            <label for="dt2" class="form-label">Término</label>
                            <input type="date" class="form-control" name="dt2" id="dt2">
                        </div>

                        <div class="col-md-2">
                            <label for="pago" class="form-label">Pago</label>
                            <select class="form-control" name="pago" id="pago">
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                        </div>

                        <div class="col-md-2 mt-2">
                            <label for=""></label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>

            <div class="row border p-2 mt-4">

                <form action="/rel_contas_pagar_loc_simples" method="get" id="searchForm2">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="criterio" class="form-label">Critério</label>
                            <select class="form-control" name="criterio" id="criterio" required>
                                <option value=""></option>
                                <option value="vencimento">Vencimento</option>
                                <option value="data_pagametno">pagamento</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="dt1" class="form-label">Início</label>
                            <input type="date" class="form-control" name="dt1" id="dt1">
                        </div>

                        <div class="col-md-2">
                            <label for="dt2" class="form-label">Término</label>
                            <input type="date" class="form-control" name="dt2" id="dt2">
                        </div>

                        <div class="col-md-2">
                            <label for="pago" class="form-label">Pago</label>
                            <select class="form-control" name="pago" id="pago">
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                        </div>

                        <div class="col-md-2 mt-2">
                            <label for=""></label>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1 table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Conta</th>
                        <th scope="col">Plano</th>
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
                                <td style="color: #34d74a; font-weight: bold"><?php echo e($conta->planoContas->plano); ?> </td>
                                <td style="color: #34d74a; font-weight: bold">
                                    <?php echo e(date('d/m/Y', strtotime($conta->vencimento))); ?> </td>
                                <td style="color: #34d74a; font-weight: bold">R$
                                    <?php echo e(number_format($conta->valor, 2, ',', '.')); ?> </td>
                                <td style="color: #34d74a; font-weight: bold"><?php echo e($conta->pago); ?> </td>
                                <td style="color: #34d74a; font-weight: bold">
                                    <?php if($conta->data_pagametno != null): ?>
                                        <?php echo e(date('d/m/Y', strtotime($conta->data_pagametno))); ?>

                                    <?php endif; ?>
                                </td>
                            <?php elseif($conta->pago == 'nao' and $conta->vencimento < now()): ?>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->id); ?> </td>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->conta); ?> </td>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->planoContas->plano); ?> </td>
                                <td style="color: #e30f41; font-weight: bold">
                                    <?php echo e(date('d/m/Y', strtotime($conta->vencimento))); ?> </td>
                                <td style="color: #e30f41; font-weight: bold">R$
                                    <?php echo e(number_format($conta->valor, 2, ',', '.')); ?> </td>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e($conta->pago); ?> </td>
                                <td style="color: #e30f41; font-weight: bold">
                                    <?php if($conta->data_pagametno != null): ?>
                                        <?php echo e(date('d/m/Y', strtotime($conta->data_pagametno))); ?>

                                    <?php endif; ?>
                                </td>
                            <?php elseif($conta->pago == 'nao' and $conta->vencimento >= now()): ?>
                                <td style="color: font-weight: bold"><?php echo e($conta->id); ?> </td>
                                <td style="font-weight: bold"><?php echo e($conta->conta); ?> </td>
                                <td style="font-weight: bold"><?php echo e($conta->planoContas->plano); ?> </td>
                                <td style="font-weight: bold"><?php echo e(date('d/m/Y', strtotime($conta->vencimento))); ?> </td>
                                <td style="font-weight: bold">R$ <?php echo e(number_format($conta->valor, 2, ',', '.')); ?> </td>
                                <td style="font-weight: bold"><?php echo e($conta->pago); ?> </td>
                                <td style="font-weight: bold">
                                    <?php if($conta->data_pagametno != null): ?>
                                        <?php echo e(date('d/m/Y', strtotime($conta->data_pagametno))); ?>

                                    <?php endif; ?>
                                </td>
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

    <script>
        // Restaurar valores dos campos ao carregar a página
        window.onload = function() {
            restoreFormValues();
        };

        // Armazenar valores dos campos no armazenamento local ao enviar o formulário
        document.getElementById('searchForm').addEventListener('submit', function() {
            storeFormValues();
        });

        // Função para armazenar valores dos campos no armazenamento local
        function storeFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                localStorage.setItem(element.name, element.value);
            });
        }

        // Função para restaurar valores dos campos do armazenamento local
        function restoreFormValues() {
            document.querySelectorAll('input, select').forEach(function(element) {
                if (localStorage.getItem(element.name)) {
                    element.value = localStorage.getItem(element.name);
                }
            });
        }
    </script>

<script>
    // Restaurar valores dos campos ao carregar a página
    window.onload = function() {
        restoreFormValues();
    };

    // Armazenar valores dos campos no armazenamento local ao enviar o formulário
    document.getElementById('searchForm2').addEventListener('submit', function() {
        storeFormValues();
    });

    // Função para armazenar valores dos campos no armazenamento local
    function storeFormValues() {
        document.querySelectorAll('input, select').forEach(function(element) {
            localStorage.setItem(element.name, element.value);
        });
    }

    // Função para restaurar valores dos campos do armazenamento local
    function restoreFormValues() {
        document.querySelectorAll('input, select').forEach(function(element) {
            if (localStorage.getItem(element.name)) {
                element.value = localStorage.getItem(element.name);
            }
        });
    }
</script>    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens\relatorios\financeiro/relContasPagar.blade.php ENDPATH**/ ?>