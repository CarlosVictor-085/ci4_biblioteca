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
                    <label class="form-label" for="disponivel">Disponivel:</label>
                    <select class='form-select' name="disponivel" id="disponivel" required>
                        <option>Selecione a Disponibilidade</option>
                        <?php foreach($statusdisponivel as $chave => $valor) : ?>
                            <option value="<?=$chave?>"><?=$valor?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status:</label>
                    <select class='form-select' name="status" id="status" required>
                        <option>Selecione o Status</option>
                        <?php foreach($status as $chave => $valor) : ?>
                            <option value="<?=$chave?>"><?=$valor?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefone">Obra:</label>
                    <select class='form-select' name="id_obra" id="id_obra" required>
                        <option>Selecione uma obra</option>
                        <?php foreach($listaObra as $obra) : ?>
                            <option value="<?=$obra['id']?>"><?=$obra['titulo']?></option>
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
$(document).ready(function() {
    $('#pesquisa').keyup(function() {
        var searchQuery = $(this).val();
        searchBooks(searchQuery);
    });
});

function searchBooks(searchQuery) {
    $.ajax({
        url: '<?=base_url('Livro/busca')?>',
        type: 'POST',
        data: {pesquisa: searchQuery},
        success: function(data) {
            // Substitua o corpo da tabela com os novos resultados de busca
            $('tbody').html(data);
        }
    });
}
</script>