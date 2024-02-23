<?php $__env->startSection('title', 'Nova frequência'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Nova frequência</h3>
        </div>

        <hr>

        <div class="row ms-4">

            <div class="col md-4">
                <h4>Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4>
            </div>

            <div class="col-md-2">
                <h4>Matricula: <?php echo e($matricula->id); ?></h4>
            </div>

            <div class="col-md-6">
                <h4>Curso: <?php echo e($matricula->cursos->curso); ?></h4>
            </div>

        </div>

        <hr>

        <div class="row ms-4">
            <div class="col-4">
                <button onclick="javascript:history.back()" class="btn btn-danger">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                    Voltar
                </button>

            </div>
        </div>


        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('frequencia.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="aluno" value="<?php echo e($matricula->alunos->id); ?>">
                <input type="hidden" name="matricula" value="<?php echo e($matricula->id); ?>">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <?php $__errorArgs = ['disciplina'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <label for="disciplina" class="form-label lblCaption">Disciplina</label>
                        <select class="form-control" name="disciplina" id="disciplina" required>
                            <option value="">Selecione a disciplina</option>

                            <?php $__currentLoopData = $listaDisciplinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lista): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($lista->disciplinas->id); ?>"><?php echo e($lista->disciplinas->disciplina); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <?php $__errorArgs = ['dataLancamento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <label for="dataLancamento" class="form-label lblCaption">Data de lançamento</label>
                        <input type="date" class="form-control" name="dataLancamento" id="dataLancamento" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <?php $__errorArgs = ['horaLancamento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <label for="horaLancamento" class="form-label lblCaption">Hora lançamento</label>
                        <input type="time" class="form-control" name="horaLancamento" id="horaLancamento" required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <?php $__errorArgs = ['situacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <label for="situacao" class="form-label lblCaption">Situação</label>
                        <select class="form-control" name="situacao" id="situacao" required>

                            <option value="">Selecione uma opção</option>
                            <option value="presente">presente</option>
                            <option value="ausente">ausente</option>

                        </select>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="justificativa" class="form-label lblCaption">Justificativa</label>
                        <input type="text" class="form-control" name="justificativa" id="justificativa" maxlength="50">
                    </div>

                </div>

                <div class="mb-3">
                    <label for="conteudo" class="form-label lblCaption">Conteúdo</label>
                    <input type="text" class="form-control" name="conteudo" id="conteudo" maxlength="100">
                </div>

                <div class="row">

                    <div class="col-md-2 mb-4">
                        <?php $__errorArgs = ['dataPresenca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <label for="dataPresenca" class="form-label lblCaption">Data de presença</label>
                        <input type="date" class="form-control" name="dataPresenca" id="dataPresenca" required>
                    </div>

                    <div class="col-md-2 mb-4">
                        <?php $__errorArgs = ['horaPresenca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text text-danger">*</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <label for="horaPresenca" class="form-label lblCaption"> Horário da presença</label>
                        <input type="time" class="form-control" name="horaPresenca" id="horaPresenca" required>
                    </div>

                    <div class="col-md-8 mb-4">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/frequencia/frequenciaCreate.blade.php ENDPATH**/ ?>