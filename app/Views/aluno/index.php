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
    <h2>Aluno</h2>
        <div class="float-end me-3 d-flex" role="search">
            <div class="navbar-nav align-items-center">
                    
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
            <td>CPF</td>
            <td>EMAIL</td>
            <td>TELEFONE</td>
            <td>TURMA</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($listaAlunos as $au) :?>
                <tr onclick="location.href='<?=base_url('Aluno/editar/'.$au['id'])?>'" role="button">
                    <td class="text-start">
                        <?=$au['id']?>
                    </td>
                    <td>
                        <?=$au['nome']?>
                    </td>
                    <td>
                        <?=$au['cpf']?>
                    </td>
                    <td>
                        <?=$au['email']?>
                    </td>
                    <td>
                        <?=$au['telefone']?>
                    </td>
                    <td>
                        <?=$au['turma']?>
                    </td>
                    
                </tr>
            <?php endforeach ?>  
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1D" aria-labelledby="exampleModalLabel" aria-hidden="true">
<?=form_open("Aluno/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Aluno</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                    <label class="form-label" for="cpf">CPF:</label>
                    <input class='form-control' type="text" id='cpf' name='cpf' required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="nome">Nome:</label>
                    <input class='form-control' type="text" id='nome' name='nome'>
                </div>
                <div class="form-group">
                    <label class="form-label" for="e-mail">Email:</label>
                    <input class='form-control' type="text" id='email' name='email'>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefone">Telefone:</label>
                    <input class='form-control' type="text" id='telefone' name='telefone'>
                </div>
                <div class="form-group">
                    <label class="form-label" for="turma">Turma:</label>
                    <select class='form-select' name="turma" id="turma">
                        <option hidden>Selecione Uma Turma...</option>                    
                        <option value="1A">1A</option>
                        <option value="1B">1B</option>
                        <option value="1C">1C</option>
                        <option value="1D">1D</option>
                        <option value="2A">2A</option>
                        <option value="2B">2B</option>
                        <option value="2C">2C</option>
                        <option value="2D">2D</option>
                        <option value="3A">3A</option>
                        <option value="3B">3B</option>
                        <option value="3C">3C</option>
                        <option value="3D">3D</option>
                    </select>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Seletor para todos os campos de select com a classe 'form-select'
    var selects = document.querySelectorAll('.form-select');

    selects.forEach(function(select) {
        // Cria a opção de texto padrão
        var defaultOption = document.createElement('option');
        defaultOption.value = ''; // Valor vazio
        defaultOption.disabled = true; // Desabilitado
        defaultOption.selected = true; // Selecionado por padrão
        defaultOption.textContent = 'Selecione uma opção'; // Texto a ser exibido

        // Adiciona a opção padrão ao select
        select.prepend(defaultOption);
    });

    // Adiciona o required a todos os inputs e selects da classe 'form-control'
    var inputsAndSelects = document.querySelectorAll('.form-control, .form-select');
    inputsAndSelects.forEach(function(element) {
        element.setAttribute('required', 'required');
    });
});

</script>