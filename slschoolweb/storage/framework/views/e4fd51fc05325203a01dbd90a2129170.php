
<?php $__env->startSection('title', 'Alunos por turmas'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h4 class="text-center text-white p-3">Alunos por turma</h4>
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

        <div class="cardv pt-2 mt-4">
            <form action="/alunos_por_turma_listar" method="get">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <label for="selecionar" class="form-label">Selecione a turma</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <select class="form-control" name="selecionar" id="selecionar">
                            <?php $__currentLoopData = $listaTurmas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lista->id); ?>"
                                    data-turma-info="<?php echo e($lista->turma); ?> - (<?php echo e($lista->cadastroDias->dia1); ?>

                                                             <?php echo e($lista->cadastroDias->dia2); ?>) - (<?php echo e($lista->cadastroHorarios->entrada); ?> <?php echo e($lista->cadastroHorarios->saida); ?>)"
                                    <?php if(request('selecionar') == $lista->id): ?> selected <?php endif; ?>>
                                    <?php echo e($lista->turma); ?> - (<?php echo e($lista->cadastroDias->dia1); ?>

                                    <?php echo e($lista->cadastroDias->dia2); ?>) - (<?php echo e($lista->cadastroHorarios->entrada); ?>

                                    <?php echo e($lista->cadastroHorarios->saida); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-lg">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>

        <hr>

        <div class="card pt-3 pb-3 ps-3 mt-4 border">

            <div class="row ps-3">

                <?php $__currentLoopData = $turmaMatriculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matricula): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($matricula->matriculas->status == 'ativa'): ?>

                        <div class="col-md-3 card rounded-4 p-0 me-2 shadow" style="width: 12rem; background: #f2f2f3">

                            <a href="<?php echo e(route('matricula.show', $matricula->matriculas_id )); ?>" class="link-card">
    
                                <div class="d-flex align-items-center justify-content-center pt-3">
                                    <img src="/img/aluno/<?php echo e($matricula->alunos->foto); ?>"
                                        class="card-img-top img-fluid rounded float-start" style="width: 100px" alt="...">
                                </div>
    
                                <div class="card-body">
                                    <h5 class="card-text">Aluno(a):<?php echo e($matricula->alunos->nome); ?></h5>
                                    <h5 class="card-text">Matrícula:<?php echo e($matricula->matriculas_id); ?></h5>
                                </div>
                                
                            </a>
    
                        </div>                        

                    <?php endif; ?>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selecionarElement = document.getElementById('selecionar');
            var selectedOption = selecionarElement.options[selecionarElement.selectedIndex];
            var turmaInfo = selectedOption.getAttribute('data-turma-info');

            // Faça algo com a variável 'turmaInfo', como exibi-la em algum lugar na página
            // console.log(turmaInfo);
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunosPorTurma/alunoTurmaShow.blade.php ENDPATH**/ ?>