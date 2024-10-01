<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container">
    <h2>Obra</h2>
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
            <td>TITULO</td>
            <td>CATEGORIA</td>
            <td class="text-start">ANO</td>
            <td>ISBN</td>
            <td>EDITORA</td>
            <td class="text-start">QUANTIDADE</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($listaObra as $ob) :?>
                <tr onclick="location.href='<?=base_url('Obra/editar/'.$ob['id'])?>'" role="button">
                    <td class="text-start">
                        <?=$ob['id']?>
                    </td>
                    <td>
                        <?=$ob['titulo']?>
                    </td>
                    <td>
                        <?=$ob['categoria']?>
                    </td>
                    <td class="text-start">
                        <?=$ob['ano_publicacao']?>
                    </td>
                    <td>
                        <?=$ob['isbn']?>
                    </td>
                    <td>
                        <?=$ob['nome']?>
                    </td>
                    <td class="text-start">
                        <?=$ob['quantidade'] ?>
                    </td>
                </tr>
            <?php endforeach ?>  
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?=form_open("Obra/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Obra</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="titulo">Titulo:</label>
                    <input class='form-control' type="text" id='titulo' name='titulo' required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="categoria">Categoria:</label>
                    <input class='form-control' type="text" id='categoria' name='categoria' required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="ano">Ano:</label>
                    <input class='form-control' type="text" id='ano_publicacao' name='ano_publicacao' required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="isbn">ISBN:</label>
                    <input class='form-control' type="text" id='isbn' name='isbn' required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefone">EDITORA:</label>
                    <select class='form-select' name="id_editora" id="id_editora" required>
                        <option>Selecione uma editora</option>
                        <?php foreach($listaEditora as $ob) : ?>
                            <option value="<?=$ob['id']?>"><?=$ob['nome']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <div class="form-group">
                    <label class="form-label" for="isbn">Quantidade:</label>
                    <input class='form-control' type="number" id='quantidade' name='quantidade' min="1" max="100" required>

                </div>
                <div class="form-group" id="tomboContainer"> </div>

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
    document.getElementById('quantidade').addEventListener('input', function() {
        // Limitar a quantidade a um máximo de 100
        if (this.value > 100) {
            this.value = 100; // Define o valor máximo como 100
        }

        var quantidade = parseInt(this.value);
        var container = document.getElementById('tomboContainer');
        container.innerHTML = ''; // Limpa qualquer campo de tombo previamente adicionado

        if (!isNaN(quantidade) && quantidade > 0) {
            for (var i = 1; i <= quantidade; i++) {
                // Cria o rótulo do campo
                var label = document.createElement('label');
                label.className = 'form-label';
                label.setAttribute('for', 'tombo' + i);
                label.innerHTML = 'Tombamento ' + i + ':';

                // Cria o campo de input para o tombamento
                var input = document.createElement('input');
                input.className = 'form-control';
                input.type = 'text';
                input.name = 'tombo[]'; // Armazena os valores como um array
                input.id = 'tombo' + i;

                // Adiciona um evento de input para verificar duplicatas enquanto o usuário digita
                input.addEventListener('input', verificarDuplicatas);

                // Adiciona o campo de input ao container
                container.appendChild(label);
                container.appendChild(input);
            }
        }
    });

    // Função para verificar duplicatas de tombamento
    function verificarDuplicatas() {
        var tombos = document.querySelectorAll("input[name='tombo[]']");
        var valores = [];
        var hasDuplicate = false;

        tombos.forEach(function(tombo) {
            var valor = tombo.value.trim();

            if (valor !== '' && valores.includes(valor)) {
                tombo.classList.add('is-invalid'); // Destaca o campo com duplicata
                hasDuplicate = true;
            } else {
                tombo.classList.remove('is-invalid'); // Remove o destaque se não for duplicata
                valores.push(valor);
            }
        });

        // Desabilita o botão de envio se houver duplicatas
        var submitButton = document.querySelector("button[type='submit']");
        submitButton.disabled = hasDuplicate;
    }
</script>

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