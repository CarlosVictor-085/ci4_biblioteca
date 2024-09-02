
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
                <div class="form-password-toggle">
                    <label class="form-label" for="senha">Senha</label>
                    <div class="input-group input-group-merge">
                    <input type="password" class="form-control" aria-describedby="basic-default-password" id="senha" name="senha">
                        <span class="input-group-text cursor-pointer" id="basic-default-password">
                            <i class="bi bi-eye-fill  id="btn-senha" onclick="mostrarSenha()"></i>
                        </span>
                    </div>
                </div><br>
                <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password32">Password</label>
                        <div class="input-group input-group-merge">
                          <input
                            type="password"
                            class="form-control"
                            id="basic-default-password32"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="basic-default-password"
                          />
                          <span class="input-group-text cursor-pointer" id="basic-default-password"
                            ><i class="bx bx-hide"></i
                          ></span>
                        </div>
                      </div>
                <button type="submit" class="btn btn-dark">Entrar</button>
            </form>
        </div>
    </div>
</div>

