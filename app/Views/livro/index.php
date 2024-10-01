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
    <h2>Livro</h2>
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
            <td>DISPONIVEL</td>
            <td>STATUS</td>
            <td class="text-start">TOMBAMENTO</td>
            <td>OBRA</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($listaLivro as $li) :?>
                <tr onclick="location.href='<?=base_url('Livro/editar/'.$li['id'])?>'" role="button">
                    <td class="text-start">
                        <?=$li['id']?>
                    </td>
                    <td>
                        <?=$statusdisponivel[$li['disponivel']]?>
                    </td>
                    <td>
                        <?=$status[$li['status']]?>
                    </td>
                    <td class="text-start">
                        <?=$li['tombo']?>
                    </td>
                    <td>
                        <?=$li['titulo']?>
                    </td>
                </tr>
            <?php endforeach ?>  
        </tbody>
    </table>
                                
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?=form_open("Livro/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Livro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="tombo">Tombamento:</label>
                    <input type="text" class="form-control" name="tombo" id="tombo" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefone">Obra:</label>
                    <select class='form-select' name="id_obra" id="id_obra" required>
                        <option>Selecione uma obra</option>
                        <?php foreach($listaObra as $obra) : ?>
                            <?php if($obra['livros_cadastrados'] < $obra['quantidade']) : // Apenas exibe se ainda tiver espaço ?>
                                <option value="<?=$obra['id']?>"><?=$obra['titulo']?></option>
                            <?php endif; ?>
                        <?php endforeach ?>
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