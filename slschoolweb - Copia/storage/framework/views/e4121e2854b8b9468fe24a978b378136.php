<?php $__env->startSection('title', 'Lista de carteirinhas geradas'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Lista das carteirinhas geradas</h3>
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

                <a href="<?php echo e(route('impressao_carteira.create')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Nova carteira</a>
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

            <table class="table p-1">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cód. Aluno</th>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Aluno</th>
                    <th scope="col">DT. Impresão</th>
                    <th scope="col">Validade</th>
                    <th scope="col">Operações</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $carteiras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carteira): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($carteira->id); ?> </td>
                        <td><?php echo e($carteira->alunos_id); ?> </td>
                        <td><?php echo e($carteira->matriculas_id); ?> </td>
                        <td><?php echo e($carteira->alunos->nome); ?> </td>
                        <td><?php echo e(date('d/m/Y', strtotime($carteira->data_impressao))); ?> </td>
                        <td><?php echo e(date('d/m/Y', strtotime($carteira->Validade))); ?> </td>

                        <td>

                            <div>
                                <div class="row">

                                    <div class="col-3">
                                        <a href="<?php echo e(('/impressao_carteira_impressao/'.$carteira->id)); ?>"
                                            class="btn btn-success btn-sm" title="Imprimir carteira selecioada">
                                            <i class="bi bi-printer-fill"></i>
                                        </a>
                                    </div>

                                    <div class="col-3">

                                        <form method="POST" class="delete-form" action="<?php echo e(route('impressao_carteira.destroy', $carteira->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
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

            <!-- Exibir a barra de paginação -->
            <div class="row">
                <div>
                    <?php echo e($carteiras->links('pagination::pagination')); ?>

                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/carteira/carteiraShow.blade.php ENDPATH**/ ?>