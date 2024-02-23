
<?php $__env->startSection('title', 'Relatório Mensalidades'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Relatório Mensalidades</h4>
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

            <div class="col border p-2 me-3">
                <form action="/rel_mensalidades_loc_data" method="get">
                    <?php echo csrf_field(); ?>
        
                    <div class="row pe-3">
        
                        <div class="col-md-3 mb-3">
                            <label for="dtTipo" class="form-label">Tipo</label>
                            <select class="form-control" name="dtTipo" id="dtTipo">
                                <option value="vencimento">Vencimento</option>
                                <option value="data_pagamento">Pagamento</option>
                            </select>
                        </div>
        
                        <div class="col-md-4 mb-3">
                            <label for="dt1" class="form-label">Primeira data</label>
                            <input type="date" class="form-control" name="dt1" id="dt1">
                        </div>
        
                        <div class="col-md-4 mb-3">
                            <label for="dt2" class="form-label">Segunda data</label>
                            <input type="date" class="form-control" name="dt2" id="dt2">
                        </div>
        
                        <div class="col-md-1 mt-2 mb-3">
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
        
            <div class="col-5 border p-2">
                <form action="/rel_mensalidades_localizar" method="get">
                    <?php echo csrf_field(); ?>
        
                    <div class="row">
        
                        <div class="col-md-4 mb-3">
                            <label for="opt" class="form-label">Critério de pesquisa</label>
                            <select class="form-control" name="opt" id="opt" aria-label="Critério de pesquisa">
                                <option value="id">Mensalidade</option>
                                <option value="alunos_id">Cód. Aluno</option>
                                <option value="matriculas_id">Matrícula</option>
                                <option value="aluno">Aluno</option>
                            </select>
                        </div>
        
                        <div class="col-md-6 mb-3">
                            <label for="find" class="form-label">Caixa de pesquisa</label>
                            <input type="text" class="form-control" name="find" id="find" placeholder="Digite o que deseja buscar" aria-label="Informação de busca">
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

        <div class="row border p-2">

            <form action="/rel_mensalidades_loc_status" method="get">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-6">
                        <label for="status" class="form-label">Selecione o status da mensalidade</label>
                        <select class="form-control" name="status" id="status">
                            <option value="sim">Pagas</option>
                            <option value="nao">Não pagas</option>
                            <option value="cancelado">Canceladas</option>
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
                                <td style="color: #e30f41; font-weight: bold"><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
                            <?php else: ?>
                            <td style="color: #053d16; font-weight: bold"><?php echo e(date('d/m/Y', strtotime($mensalidade->vencimento))); ?> </td>
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

                                        <div class="col-2">
                                            <a href="<?php echo e(('/rel_mensalidades_impressao/'.$mensalidade->id)); ?>" class="btn btn-success btn-sm"
                                                title="Visualizar informações do aluno">
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

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($mensalidades->links('pagination::pagination')); ?>

            </div>

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/mensalidade/relMensalidades.blade.php ENDPATH**/ ?>