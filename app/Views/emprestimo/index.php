<div class="container">
    <h2>Emprestimo</h2>
        <!-- Button do Modal -->
        <button type="button" class="btn btn-primary d-grid" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Novo
        </button>
        <br>
        <!-- Tabela de Usuario -->
        <table id="table" class="table table-hover table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>DATA DE INICIO</td>
            <td>DATA DO FIM</td>
            <td>DATA DO PRAZO</td>
            <td>LIVRO</td>
            <td>ALUNO</td>
            <td>USUARIO</td>
            <td>DEVOLUÇAO</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach($listaEmprestimo as $em) :?>
                <tr onclick="location.href='<?=base_url('Emprestimo/editar/'.$em['emprestimo_id'])?>'" role="button">
                    <td class="text-start">
                        <?=$em['emprestimo_id']?>
                    </td>
                    <td>
                    <?=$em['data_inicio_formatada']?>
                    </td>
                    <td>
                    <?=!empty($em['data_fim_formatada']) ? $em['data_fim_formatada'] : 'Não definida';?>
                    </td>
                    <td>
                        <?=$em['data_prazo_formatada']?>
                    </td>
                    <td>
                        <?=$em['nome_obra']?>
                    </td>
                    <td>
                        <?=$em['nome_aluno']?>
                    </td>
                    <td>
                        <?=$em['nome_usuario']?>
                    </td>
                    <td>
                        <?php if (empty($em['data_fim'])): ?>
                            <?= anchor("Emprestimo/devolucao/" . $em['emprestimo_id'], "Devolução", ['class' => 'btn btn-dark']) ?>
                        <?php else: ?>
                            <?= $em['status_devolucao'] ? $em['status_devolucao'] : 'Aguardando devolução'; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>  
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?=form_open("Emprestimo/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Emprestimo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                    foreach($listaObra as $obra){
                        $obras[$obra['id']] = $obra['titulo'];
                    }
                ?>
                <div class="form-group">
                    <label for="data_inicio">Data de Inicio:</label>
                    <input class='form-control' type="date" id='data_inicio' name='data_inicio'>
                </div>
                <div class="form-group">
                    <label for="data_prazo">Prazo:</label>
                    <input class='form-control' type="text" id='data_prazo' name='data_prazo'>
                </div>
                <div class="form-group">
                    <label for="telefone">Livro:</label>
                    <select class='form-select' name="id_livro" id="id_livro" required>
                        <option>Selecione um Livro</option>
                        <?php foreach($listaLivro as $livro) : ?>
                            <?php if($livro['disponivel'] >= 1):?>
                                <option value="<?=$livro['id']?>"><?=$obras[$livro['id_obra']]?></option>
                            <?php endif?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefone">Aluno:</label>
                    <select class='form-select' name="id_aluno" id="id_aluno" required>
                        <option>Selecione um Aluno</option>
                        <?php foreach($listaAluno as $aluno) : ?>
                            <option value="<?=$aluno['id']?>"><?=$aluno['nome']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefone">Usuario:</label>
                    <!-- Exibe o nome do usuário, mas o campo é somente leitura -->
                    <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" value="<?= session()->get('nome') ?>" readonly>
                    <!-- Campo oculto para enviar o ID do usuário -->
                    <input type="hidden" name="id_usuario" value="<?=session()->get('id') ?>">
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