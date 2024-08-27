
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2>Faça Login Para Continuar</h2>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
                <div class="form-group">
                    <label for="nome">Usuario</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo old('nome'); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo old('email'); ?>">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-group mb-3">
                    <input type="password" class="form-control" id="senha" name="senha">
                        <div class="input-group-append align-self-center ms-2">
                            <i class="bi bi-eye-fill input-group-text" style="Height: 38px" id="btn-senha" onclick="mostrarSenha()"></i>
                        </div>
                    </div>
                </div><br>
                <button type="submit" class="btn btn-dark">Entrar</button>
            </form>
        </div>
    </div>
</div>

