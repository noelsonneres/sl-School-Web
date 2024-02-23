<?php $__env->startSection('title', 'Atualizar informações da disciplina'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Atualizar informações da disciplina do aluno</h3>
        </div>

        <hr>
        <h4 class="p-1">Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4>
        <h4 class="p-1">Matrícula: <?php echo e($matricula->id); ?></h4>
        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('matricula_disciplina.store')); ?>" method="post"
                  enctype="multipart/form-data">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="aluno" id="aluno" value="<?php echo e($matricula->alunos_id); ?>">
                <input type="hidden" name="matricula" id="alunos_id" value="<?php echo e($matricula->id); ?>">
                <input type="hidden" name="curso" id="curso" value="<?php echo e($matricula->cursos_id); ?>">


                <div class="card border">

                    <div class="mb-3 p-3">
                        <label for="disciplina" class="form-label lblCaption">Disciplina</label>
                        <select class="form-control" name="disciplina" id="disciplina">
                            <option value="">Seleccione uma disciplina</option>

                            <?php $__currentLoopData = $listaDisciplinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lista->id); ?>"><?php echo e($lista->disciplina); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                </div>

                <div class="card border">

                    <h4 class="p-4">Informações sobre o andamento da disciplina</h4 class="p-4">

                    <div class="row mb-3 p-3">

                        <div class="col-md-4">
                            <label for="inicio" class="form-label lblCaption">Início</label>
                            <input type="date" class="form-control" name="inicio" id="inicio">
                        </div>

                        <div class="col-md-4">
                            <label for="termino" class="form-label lblCaption">Término</label>
                            <input type="date" class="form-control" name="termino" id="termino">
                        </div>

                        <div class="col-md-4">
                            <label for="concluido" class="form-label lblCaption">situacao</label>
                            <select class="form-control" name="concluido" id="concluido">
                                <option value="Iniciado">Iniciado</option>
                                <option value="Em andamento">Em andamento</option>
                                <option value="Pausado">Pausado</option>
                                <option value="Cancelado">Cancelado</option>
                                <option value="Concluido">Concluido</option>
                                <option value="Não iniciado">Não iniciado</option>

                            </select>
                        </div>


                    </div>

                    <div class="mb-3  p-3">
                        <label for="obs" class="form-label lblCaption">Observação</label>
                        <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                    </div>

                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar
                    </button>

                    <a href="javascript:history.back()" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function calcular() {
            var qtdeParcelaInput = document.getElementById("qtdeParcelas");
            var ValorParceladoInput = document.getElementById("valorParcelado");

            var qtdeParcela = parseFloat(qtdeParcelaInput.value);
            var ValorParcelado = parseFloat(ValorParceladoInput.value);

            if (!isNaN(qtdeParcela) && !isNaN(ValorParcelado)) {
                var resultadoDivisao = ValorParcelado / qtdeParcela;
                document.getElementById("valorPorParcela").value = resultadoDivisao.toFixed(2);
            }
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/alunos/disciplina/disciplinasCreate.blade.php ENDPATH**/ ?>