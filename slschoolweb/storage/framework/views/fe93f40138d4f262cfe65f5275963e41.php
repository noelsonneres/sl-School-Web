<?php $__env->startSection('title', 'Confirmar dados do aluno'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Confirmar dados antes de gerar a carteirinha</h3>
        </div>

        <hr>

            <div class="row ps-3">
                <div class="col-md-4"><h4>Aluno(a): <?php echo e($matricula->alunos->nome); ?></h4></div>
                <div class="col-md-4"><h4>Matrícula: <?php echo e($matricula->id); ?></h4></div>
                <div class="col-md-4"> <h4>Curso: <?php echo e($matricula->cursos->curso); ?></h4></div>
            </div>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('impressao_carteira.store')); ?>" method="post">

                <?php echo csrf_field(); ?>

                <input type="hidden" name="alunos" value="<?php echo e($matricula->alunos_id); ?>">
                <input type="hidden" name="matriculas" value="<?php echo e($matricula->id); ?>">

                <div class="row mb-4">

                    <div class="col-md-6">
                        <label for="dtImpressao" class="form-label lblCaption">Data de impressão</label>
                        <input type="date" class="form-control" name="dtImpressao" id="dtImpressao"
                               value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="dtValidade" class="form-label lblCaption">Data de validade</label>
                        <input type="date" class="form-control" name="dtValidade" id="dtValidade" required>
                    </div>

                </div>

                <div class="mb-4">
                    <label for="mensagem" class="form-label lblCaption">Mensagem</label>
                    <textarea class="form-control" name="mensagem" id="mensagem" maxlength="255" required><?php echo e($conf->mensagem); ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="obs" class="form-label lblCaption">Observação</label>
                    <input type="text" class="form-control" name="obs" id="obs" maxlength="255">
                </div>

                <div class="mb-4">
                    <div class="input-group mb-3">



                    </div>
                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px"
                         src="/img/aluno/<?php echo e($matricula->alunos->foto); ?>">
                </div>


                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                    Gerar Carteira
                </button>

                    <a href="/dias" class="btn btn-danger">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar</a>
                </div>

            </form>

        </div>
    </div>

    <script>
        function exibirFotoSelecionada() {
            const input = document.getElementById("foto");
            const imagem = document.getElementById("imagemSelecionada");

            if (input.files && input.files[0]) {
                const leitor = new FileReader();

                leitor.onload = function(e) {
                    imagem.src = e.target.result;
                };

                leitor.readAsDataURL(input.files[0]);
            }
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/carteira/carteiraConfirmarDados.blade.php ENDPATH**/ ?>