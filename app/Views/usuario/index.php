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
    <h2>Usuario</h2>
        <div class="float-end me-3 d-flex" role="search">
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                </div>
            </div>                
        </div>                
           
        <!-- Button do Modal -->
        <button type="button" class="btn btn-primary d-grid" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Novo
        </button>
        <br>
        <!-- Tabela de Usuario -->
        <table id="table" class="table table-hover table-bordered">
        <thead>
        <tr>
            <td class="text-start">ID</td>
            <td>NOME</td>
            <td>EMAIL</td>
            <td>TELEFONE</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($listaUsuarios as $u) :?>
                <tr onclick="location.href='<?=base_url('Usuario/editar/'.$u['id'])?>'" role="button">
                    <td class="text-start">
                        <?=$u['id']?>
                    </td>
                    <td>
                        <?=$u['nome']?>
                    </td>
                    <td>
                        <?=$u['email']?>
                    </td>
                    <td>
                        <?=$u['telefone']?>
                    </td>
                </tr>
            <?php endforeach ?>  
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?=form_open("Usuario/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input class='form-control' type="text" id='nome' name='nome'>
                </div>
                <div class="form-group">
                    <label class="form-label" for="e-mail">Email:</label>
                    <input class='form-control' type="text" id='email' name='email'>
                </div>
                <div class="form-group">
                    <label class="form-label" for="senha">Senha:</label>
                    <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                    <input type="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"id="senha" name="senha">
                        <span class="input-group-text cursor-pointer" id="basic-default-password">
                            <i class="bi bi-eye-fill"  id="btn-senha" onclick="mostrarSenha()"></i>
                        </span>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefone">Telefone:</label>
                    <input class='form-control' type="text" id='telefone' name='telefone'>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline-success">Cadastrar</button>
            </div>
        </div>
    </div>
        <?=form_close()?>
    </div>
</div>
