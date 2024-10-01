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
    <h2>Autor</h2>
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
        </tr>
        </thead>
        <tbody>
        <?php foreach($listaAutor as $a) :?>
                <tr onclick="location.href='<?=base_url('Autor/editar/'.$a['id'])?>'" role="button">
                    <td class="text-start">
                        <?=$a['id']?>
                    </td>
                    <td>
                        <?=$a['nome']?>
                    </td>
                </tr>
            <?php endforeach ?>  
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<?=form_open("Autor/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Autor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input class='form-control' type="text" id='nome' name='nome'>
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
