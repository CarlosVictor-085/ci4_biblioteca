<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
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

<div class="container p-5">
    <?=form_open('Obra/salvar')?>
    <input value='<?=$obra['obra_id']?>' type="hidden" class='form-control'  id='id' name='id'>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="nome">Titulo</label>
        </div>
        <div class="col-10">
            <input value='<?=$obra['titulo']?>'class='form-control' type="text" id='titulo' name='titulo' required>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="nome">Categoria</label>
        </div>
        <div class="col-10">
            <input value='<?=$obra['categoria']?>'class='form-control' type="text" id='categoria' name='categoria' required>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="nome">Ano</label>
        </div>
        <div class="col-10">
            <input value='<?=$obra['ano_publicacao']?>'class='form-control' type="text" id='ano_publicacao' name='ano_publicacao' required>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="isbn">ISBN</label>
        </div>
        <div class="col-10">
            <input value='<?=$obra['isbn']?>'class='form-control' type="text" id='isbn' name='isbn' required>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="editora">Editora</label>
        </div>
        <div class="col-10">
        <select class='form-select' name="id_editora" id="id_editora" required>
          <option value="<?=$obra['id_editora']?>" hidden><?=$obra['nome']?></option>
            <?php foreach($editora as $ed) : ?>
              <option value="<?=$ed['id']?>" <?= ($ed['id'] == $obra['id_editora']) ? 'selected' : '' ?>>
                <?=$ed['nome']?>
              </option>
            <?php endforeach ?>
        </select>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="isbn">Quantidade</label>
        </div>
        <div class="col-10">
            <input value='<?=$obra['quantidade']?>'class='form-control' type="number" id='quantidade' name='quantidade' min="1" required>
        </div>
    </div>
    <div id="tomboContainer" class="row p-2"></div>
    <div class="row p-2">
        <div class="col-2">
            <label class="form-label" for="autores">Autores(a)</label>
        </div>
        <div class="col-10">
            <?php
            $autor;
                foreach($listaAutor as $a){
                    $autor[$a['id']] = $a['nome'];
                }
            ?>
            <?php foreach($listaAutorObra as $lao):?>
                <?php if($lao['id_obra'] == $obra['obra_id']):?>
                    <div><?=$autor[$lao['id_autor']]?></div>
                <?php endif?>
            <?php endforeach?>

            <!-- Button do Modal Autores-->
        <div>
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModalautor">
                Adicionar...
            </button>
        </div>
    </div>
    <div class="row p-4">
        <div class="col">
            <div class="btn-group w-100" role="group">
                <a href='<?=base_url('Obra/index')?>'class="btn btn-outline-secondary m-1">Cancelar</a>
                <button type="submit" class="btn btn-outline-success m-1">Salvar</button>
                <button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Excluir
                </button>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>

    <!-- Modal De Excluir-->
    <?=form_open('Obra/excluir')?>
    <input value='<?=$obra['obra_id']?>'class='form-control' type="hidden" id='id' name='id'>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Você tem certeza que deseja excluir: <br>ID: <?=$obra['obra_id']?><br>Titulo: <?=$obra['titulo']?><br>Ano: <?=$obra['ano_publicacao']?><br>ISBN: <?=$obra['isbn']?><br> Editora: <?=$obra['nome']?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-danger">Excluir</button>
        </div>
        </div>
        <?=form_close()?>
    </div>
    </div>

    <!-- Modal De Autores-->
    <div class="modal fade" id="exampleModalautor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?=form_open('Obra/adicionarAutor')?>
    <input value='<?=$obra['nome']?>'class='form-control' type="hidden" id='id_obra' name='id_obra'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lista de Autores</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="autor">Autores:</label>
                            <select class='form-select' name="id_autor" id="id_autor" required>
                                <option>Selecione</option>
                                <?php foreach($listaAutor as $autor) : ?>
                                    <option value="<?=$autor['id']?>"><?=$autor['nome']?></option>
                                <?php endforeach ?>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success">Salvar</button>
                </div>
            </div>
        </div>
    <?=form_close()?>
    </div>
    <script>
                // Array de tombos que já existem na tabela, enviados pelo PHP
        var tombosExistentes = <?= json_encode($tombosExistentes) ?>; // Recebendo os tombos existentes

        document.getElementById('quantidade').addEventListener('input', function() {
            var quantidadeTotal = parseInt(this.value);
            var livrosExistentes = <?= $quantidadeExistente ?>;
            var quantidadeFaltante = quantidadeTotal - livrosExistentes;

            var container = document.getElementById('tomboContainer');
            container.innerHTML = ''; // Limpa os campos de tombo anteriores

            if (!isNaN(quantidadeFaltante) && quantidadeFaltante > 0) {
                for (var i = 1; i <= quantidadeFaltante; i++) {
                    var rowDiv = document.createElement('div');
                    rowDiv.className = 'row p-2';

                    var labelDiv = document.createElement('div');
                    labelDiv.className = 'col-2';

                    var label = document.createElement('label');
                    label.className = 'form-label';
                    label.setAttribute('for', 'tombo' + i);
                    label.innerHTML = 'Tombamento ' + (i + livrosExistentes) + ':';

                    labelDiv.appendChild(label);

                    var inputDiv = document.createElement('div');
                    inputDiv.className = 'col-10';

                    var input = document.createElement('input');
                    input.className = 'form-control';
                    input.type = 'text';
                    input.name = 'tombo[]';
                    input.id = 'tombo' + i;

                    // Adiciona o evento de input para verificar duplicatas
                    input.addEventListener('input', verificarDuplicatas);

                    inputDiv.appendChild(input);
                    rowDiv.appendChild(labelDiv);
                    rowDiv.appendChild(inputDiv);
                    container.appendChild(rowDiv);
                }
            }
        });

        // Função para verificar duplicatas de tombamento
        function verificarDuplicatas() {
            var tombos = document.querySelectorAll("input[name='tombo[]']");
            var valoresDigitados = [];
            var hasDuplicate = false;

            tombos.forEach(function(tombo) {
                var valor = tombo.value.trim();

                // Verifica se o valor é duplicado ou já existe no banco
                if (valor !== '' && (valoresDigitados.includes(valor) || tombosExistentes.includes(valor))) {
                    tombo.classList.add('is-invalid'); // Destaca o campo com duplicata
                    hasDuplicate = true;
                } else {
                    tombo.classList.remove('is-invalid'); // Remove o destaque se não for duplicata
                    valoresDigitados.push(valor); // Adiciona o valor ao array de valores digitados
                }
            });

            // Desabilita o botão de envio se houver duplicatas
            var submitButton = document.querySelector("button[type='submit']");
            submitButton.disabled = hasDuplicate;
        }

</script>