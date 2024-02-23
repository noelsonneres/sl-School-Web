<?php $__env->startSection('title', 'Selecione a turma que deseja adicionar'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Selecione a turma que deseja adicionar</h4>
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

            <div class="col-8">

                <form action="/turma_pesquisar" method="get">
                    <?php echo csrf_field(); ?>

                    <div class="row">

                        <div class="col-md-3">
                            <select class="form-control" name="opt" id="opt">
                                <option value="id">Código</option>
                                <option value="turma">Turma</option>
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

            <table class="table p-1">
                <thead>
                    <tr>
                        
                        <th scope="col">Turma</th>
                        <th scope="col">Dias</th>
                        <th scope="col">Horários</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Adicionar</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__currentLoopData = $listaTurmas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td><?php echo e(Str::substr($turma->turma, 0, 30)); ?> </td>
                            <td><?php echo e($turma->cadastroDias->dia1); ?> - <?php echo e($turma->cadastroDias->dia2); ?></td>
                            <td><?php echo e($turma->cadastroHorarios->entrada); ?> - <?php echo e($turma->cadastroHorarios->saida); ?></td>
                            <td><?php echo e($turma->sala->sala); ?></td>
                            
                            <td>

                                <div class="col-3">

                                    <form method="POST" action="<?php echo e(route('matricula_turmas.store')); ?>">
                                        <?php echo csrf_field(); ?>             
                                        <input type="hidden" name="matricula" id="matricula" value="<?php echo e($matricula->id); ?>">
                                        <input type="hidden" name="aluno" id="aluno" value="<?php echo e($matricula->alunos->id); ?>">
                                        <input type="hidden" name="dia" id="dia" value="<?php echo e($turma->cadastroDias->id); ?>">
                                        <input type="hidden" name="horario" id="horario" value="<?php echo e($turma->cadastroHorarios->id); ?>">
                                        <input type="hidden" name="sala" id="sala" value=<?php echo e($turma->sala->id); ?>>
                                        <input type="hidden" name="turma" id="turma" value="<?php echo e($turma->id); ?>">                           
                                        <button type="submit" class="btn btn-success btn">Adicionar</button>
                                    </form>

                                </div>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>

            <div class="container-fluid pl-5 d-flex justify-content-center">
                <?php echo e($listaTurmas->links('pagination::pagination')); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/turma/matriculaTurmasCreate.blade.php ENDPATH**/ ?>