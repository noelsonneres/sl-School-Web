
<?php $__env->startSection('title', 'Matrículas trancadas'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Matrículas trancadas</h4>
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

            <div class="col-5 border p-2 me-3">
                <form action="/rel_trancados_loc_data" method="get">
                    <?php echo csrf_field(); ?>
        
                    <div class="row pe-3">

                        <div class="col-md-5 mb-3">
                            <label for="dt1" class="form-label">Primeira data</label>
                            <input type="date" class="form-control" name="dt1" id="dt1">
                        </div>
        
                        <div class="col-md-5 mb-3">
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
        
            <div class="col border p-2">
                <form action="/rel_trancados_localizar" method="get">
                    <?php echo csrf_field(); ?>
        
                    <div class="row">
        
                        <div class="col-md-4 mb-3">
                            <label for="opt" class="form-label">Critério de pesquisa</label>
                            <select class="form-control" name="opt" id="opt" aria-label="Critério de pesquisa">
                                <option value="matriculas_id">Matrícula</option>
                                <option value="alunos_id">Cód. Aluno</option>
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

        <hr>

        <div class="card pt-2 mt-4">

            <table class="table p-1 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Cód. Aluno</th>
                        <th scope="col">Aluno</th>
                        <th scope="col">Data de trancamento</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $trancados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trancado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($trancado->matriculas_id); ?> </td>
                            <td><?php echo e($trancado->alunos_id); ?> </td>
                            <td><?php echo e($trancado->alunos->nome); ?> </td>
                            <td><?php echo e(date('d/m/Y', strtotime($trancado->data))); ?> </td>
                            <td><?php echo e($trancado->motivo); ?> </td>
                            <td><?php echo e($trancado->matriculas->status); ?> </td>

                            <td>

                                <div>
                                    <div class="row">

                                        <div class="col-2">
                                            <a href="<?php echo e(('/rel_trancados_impressao/'.$trancado->id)); ?>" class="btn btn-success btn-sm"
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
                <?php echo e($trancados->links('pagination::pagination')); ?>

            </div>

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/relatorios/trancada/relMatriculaTrancadaShow.blade.php ENDPATH**/ ?>