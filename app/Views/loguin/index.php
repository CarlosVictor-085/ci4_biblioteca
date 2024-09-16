<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
              <img src="<?=base_url('assets/img/sgar.png')?>" alt="Logo" class="me-3" width="50" height="50">
              <span class="app-text demo menu-text fw-bolder fs-3 ">Biblioteca</span>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Bem Vindo a Biblioteca! 👋</h4>
              <p class="mb-4">Faça login para continuar</p>
              <?php if (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
                <?php endif; ?>
              <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
                  <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" placeholder="exemplo@gmail.com" id="email" name="email" value="<?php echo old('email'); ?>">
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="senha">Senha</label>
                  </div>
                  <div class="input-group input-group-merge">
                  <input type="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"id="senha" name="senha">
                        <span class="input-group-text cursor-pointer" id="basic-default-password">
                            <i class="bi bi-eye-fill"  id="btn-senha" onclick="mostrarSenha()"></i>
                        </span>
                </div>
                <br>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary d-grid w-100">Entrar</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

