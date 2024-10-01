<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
<h2>Atualizar Senha</h2>
</div>
<div class="container p-5">
    <?=form_open('Usuario/salvarsenha')?>
    <input value='<?=$usuario['id']?>'class='form-control' type="hidden" id='id' name='id'>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="telefone">Senha:</label>
        </div>
        <div class="col-10">
            <div class="input-group input-group-merge">
                <input type="password" class="form-control" id="senha" name="senha">
                    <span class="input-group-text cursor-pointer" id="basic-default-password">
                        <i class="bi bi-eye-fill"  id="btn-senha" onclick="mostrarSenha()"></i>
                    </span>
            </div>
        </div>
    </div>
    <div class="row p-4">
        <div class="col">
            <div class="btn-group w-100" role="group">
                <a href='<?=base_url('Usuario/editar/').$usuario['id']?>'class="btn btn-outline-secondary m-1">Cancelar</a>
                <button type="submit" class="btn btn-outline-success m-1">Salvar</button>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>
