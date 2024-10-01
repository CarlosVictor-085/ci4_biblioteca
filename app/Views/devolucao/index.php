<div class="container p-5">
    <?=form_open('Emprestimo/salvardev')?>
    <input value='<?=$emprestimo['id']?>'class='form-control' type="hidden" id='id' name='id'>
    <div class="row p-2">
        <div class="col-2">
            <label for="data_fim">Data do Fim:</label>
        </div>
        <div class="col-10">
            <input required value='<?=$emprestimo['data_fim']?>'class='form-control' type="date" id='data_fim' name='data_fim'>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-2">
            <label for="telefone">Livro:</label>
        </div>
        <div class="col-10">
        <select class='form-select' name="id_livro" id="id_livro" required>
        <?php
            // Cria um array associativo de ID para título de obra
            $obras = [];
            foreach($listaObra as $obra) {
             $obras[$obra['id']] = $obra['titulo'];
            }

            // Cria um array associativo de ID para título de livro
            $livros = [];
            foreach($listaLivro as $livro) {
                $livros[$livro['id']] = $obras[$livro['id_obra']];
            }

            // Itera sobre a lista de livros para criar as opções do select
            foreach($listaLivro as $livro) {
            // Verifica se o livro atual é o selecionado
            $selected = ($livro['id'] == $emprestimo['id_livro']) ? 'selected' : '';
            echo "<option value=\"{$livro['id']}\" $selected>{$livros[$livro['id']]}</option>";
        }
        ?>
        </select>

        </div>
    </div>
    <div class="row p-4">
        <div class="col">
            <div class="btn-group w-100" role="group">
                <a href='<?=base_url('Emprestimo/index')?>'class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" class="btn btn-outline-success">Salvar</button>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>