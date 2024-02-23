<?php $__env->startSection('title', 'Atualizar informações da carteira'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container">

        <div style="background-color: #1976D2;">
            <h3 class="text-center text-white p-3">Visualizar ou Atualizar as configurações da carteira</h3>
        </div>

        <?php if(isset($msg)): ?>
            <div class="alert alert-warning alert-dismissible fade show msg d-flex
							justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
                <h5><?php echo e($msg); ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        <?php endif; ?>

        <hr>

        <div class="card p-5">

            <form action="<?php echo e(route('conf_carteira.update', $conf->id)); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-4">
                    <label for="mensagem" class="form-label lblCaption">Mensagem</label>
                    <input type="text" class="form-control" name="mensagem" id="mensagem"
                           placeholder="Digite a mensagem que será exibida na carteirinha"
                           autofocus required maxlength="255" value="<?php echo e($conf->mensagem); ?>">
                </div>

                <div class="mb-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="foto">Selecione uma foto</label>
                        <input type="file" class="form-control" name="foto" id="foto"
                               onchange="exibirFotoSelecionada()">
                    </div>
                    <img id="imagemSelecionada" class="img-thumbnail" alt="" width="250px"
                            src="/img/carteira/<?php echo e($conf->logo); ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-floppy2"></i>
                        Salvar</button>

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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\noels\OneDrive\Documentos\GitHub\sl-School-Web\slschoolweb\resources\views/screens/confCarteira/configurarCarteiraEdit.blade.php ENDPATH**/ ?>