
<?php $__env->startSection('title', 'Mensalidades por Período'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Mensalidades por Período</h4>
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

            <form action="/rel_mensalidades_periodo_localizar" method="get" id="searchForm">

                <dsiv class="row border ps-3 pb-2">

                    <div class="col-md-4 mt-2 p-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="sim">Pago</option>
                            <option value="nao">Não pagas</option>
                            <option value="cancelado">Canceladas</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for="dt1" class="form-label">Início</label>
                        <input type="date" class="form-control" name="dt1" id="dt1" required>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for="dt2" class="form-label">Término</label>
                        <input type="date" class="form-control" name="dt2" id="dt2" required>
                    </div>

                    <div class="col-md-2 mt-2 p-2">
                        <label for="filtro" class="form-label">Filtrar por</label>
                        <select class="form-control" name="filtro" id="filtro" required>
                            <option value="vencimento">Data de vencimento</option>
                            <option value="data_pagamento">Data de pagamento</option>
                        </select>
                    </div>

                    <div class="col-md-2 mt-3 p-2">
                        <label for=""></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                </dsiv>

            </form>

        </div>

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Mensalidade</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Vencimento</th>
                        <th scope="col">DT Pagamento</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $mensalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensalidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($mensalidade->id); ?> </td>
                            <td><?php echo e($mensalidade->matriculas->id); ?> </td>
                            <td><?php echo e($mensalidade->alunos->nome); ?> </td>
                            <td>R$ <?php echo e(number_format($mensalidade->valor_parcela, '2', ',', '.')); ?></td>

                            <?php if($mensalidade->pago == 'nao' and $mensalidade->vencimento < now()): ?>
                                <td style="color: #e30f41; font-weight: bold">
                                    <?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                            <?php else: ?>
                                <td style="color: #053d16; font-weight: bold">
                                    <?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                            <?php endif; ?>

                            <?php if($mensalidade->data_pagamento != null): ?>
                                <td><?php echo e(date('d/m/Y', strtotime($mensalidade->data_pagamento))); ?> </td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>

                            <?php if($mensalidade->pago == 'nao' and $mensalidade->vencimento < now()): ?>
                                <td style="color: #e30f41; font-weight: bold"><?php echo e($mensalidade->pago); ?> </td>
                            <?php else: ?>
                                <td style="color: #053d16; font-weight: bold"><?php echo e($mensalidade->pago); ?> </td>
                            <?php endif; ?>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-3">
                                            <a href="<?php echo e('/rel_mensalidades_impressao/' . $mensalidade->id); ?>"
                                                class="btn btn-primary btn-sm" title="Visualizar informações do aluno">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>
                                        </div>

                                        <?php if($mensalidade->pago === 'nao'): ?>
                                            <div class="col-2">
                                                <a href="<?php echo e('/selecionar_pagameto/' . $mensalidade->id . '/' . $mensalidade->matriculas_id); ?>"
                                                    class="btn btn-success btn-sm" title="Quitar mensalidade">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/mensalidade/relMensalidadesPeriodo.blade.php ENDPATH**/ ?>