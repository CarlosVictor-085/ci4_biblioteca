<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\EditoraModel;
use App\Models\AutorModel;
use App\Models\AutorObraModel;
use App\Models\LivroModel;
use CodeIgniter\Session\Session;

class Obra extends BaseController
{
    private $obraModel;
    private $editoraModel;
    private $autorModel;
    private $autorObraModel;
    private $livroModel;
    
    public function __construct(){
        $this->editoraModel = new EditoraModel();
        $this->obraModel = new ObraModel();
        $this->autorModel = new AutorModel();
        $this->autorObraModel = new AutorObraModel();
        $this->livroModel = new LivroModel();
    }
    
    public function index(){
        $obra =$this->obraModel->select('obra.id, obra.titulo, obra.categoria, obra.ano_publicacao, obra.isbn, obra.quantidade, editora.nome')
        ->join('editora', 'obra.id_editora = editora.id')
        ->findAll();
        $editora = $this->editoraModel->findAll();
        //dd($obra);
        

        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/index.php',['listaObra'=>$obra,'listaEditora'=>$editora]);
        echo view('_partials/footer');
    }

    public function cadastrar() {
        $obra = $this->request->getPost();
        
        // Primeiro cadastra a obra na tabela "obra"
        $this->obraModel->save($obra);
        $id_obra = $this->obraModel->getInsertID(); // Obtém o ID da obra recém-criada
    
        // Verifica se os tombos foram enviados
        if (isset($obra['tombo']) && is_array($obra['tombo'])) {
            foreach ($obra['tombo'] as $tombo) {
                // Para cada tombo, cria um registro na tabela "livro"
                $dataLivro = [
                    'id_obra' => $id_obra,
                    'tombo' => $tombo,
                    'disponivel' => 1,  // Disponibilidade
                    'status' => 1       // Status
                ];
                $this->livroModel->save($dataLivro); // Salva cada livro com seu tombo
            }
        }
    
        return redirect()->to('Obra/index')->with('success', 'Obra e livros cadastrados com sucesso!');
    }
    
    public function editar($id) {
        $obra = $this->obraModel
            ->select('obra.id as obra_id, obra.titulo, obra.categoria, obra.ano_publicacao, obra.isbn, obra.quantidade, obra.id_editora, editora.nome, editora.id')
            ->join('editora', 'obra.id_editora = editora.id')
            ->find($id);
    
        // Obtém os tombos dos livros relacionados a esta obra
        $livrosExistentes = $this->livroModel->where('id_obra', $id)->findAll();
        $tombosExistentes = array_column($livrosExistentes, 'tombo'); // Extrai os tombos existentes
    
        // Obtém outros dados, como autores e editoras
        $autor = $this->autorModel->findAll();
        $dadosAutorObra = $this->autorObraModel->findAll();
        $editora = $this->editoraModel->findAll();
    
        // Passa os dados para a view, incluindo os tombos existentes
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/edit', [
            'obra' => $obra,
            'editora' => $editora,
            'listaAutor' => $autor,
            'listaAutorObra' => $dadosAutorObra,
            'tombosExistentes' => $tombosExistentes, // Passando os tombos para a view
            'quantidadeExistente' => count($livrosExistentes) // Número de livros já cadastrados
        ]);
        echo view('_partials/footer');
    }
    
    
    public function adicionarAutor(){
        $this->autorObraModel->save(
            $this->request->getPost()
        );
        return redirect()->to(previous_url());
    }

    public function salvar() {
        $obra = $this->request->getPost();
        $id_obra = $obra['id']; // Presumindo que o ID da obra esteja no array
    
        // Primeiro, atualiza a obra na tabela "obra"
        $this->obraModel->save($obra);
    
        // Obtém a quantidade informada pelo usuário
        $quantidadeNova = isset($obra['quantidade']) ? (int)$obra['quantidade'] : 0;
    
        // Verifica quantos livros já existem para essa obra
        $livrosExistentes = $this->livroModel->where('id_obra', $id_obra)->findAll();
        $quantidadeExistente = count($livrosExistentes);
    
        // Calcula a quantidade que falta adicionar
        $quantidadeAdicionar = $quantidadeNova - $quantidadeExistente;
    
        // Obtém os tombos do formulário, se disponíveis
        $tombos = isset($obra['tombo']) ? $obra['tombo'] : [];
    
        // Verifica se há necessidade de adicionar novos livros
        if ($quantidadeAdicionar > 0 && !empty($tombos)) {
            // Adiciona novos livros
            for ($i = 0; $i < $quantidadeAdicionar; $i++) {
                // Certifique-se de que há tombos suficientes fornecidos pelo usuário
                if (isset($tombos[$i])) {
                    $dataLivro = [
                        'id_obra' => $id_obra,
                        'tombo' => $tombos[$i], // Usa o tombo fornecido pelo usuário
                        'disponivel' => 1,  // Disponibilidade
                        'status' => 1       // Status
                    ];
                    $this->livroModel->save($dataLivro); // Salva cada livro com o tombo fornecido
                }
            }
        } elseif ($quantidadeAdicionar < 0) {
            // Se a quantidade diminuir, remova os livros extras
            $quantidadeRemover = abs($quantidadeAdicionar);
            for ($i = 0; $i < $quantidadeRemover; $i++) {
                // Remove o último livro adicionado para esta obra
                if (!empty($livrosExistentes)) {
                    $livroParaRemover = array_pop($livrosExistentes); // Remove o último livro
                    $this->livroModel->delete($livroParaRemover['id']); // Presumindo que a chave primária é 'id'
                }
            }
        }
    
        return redirect()->to('Obra/index')->with('success', 'Obra e livros atualizados com sucesso!');
    }
    
    

    public function excluir(){
        $obra = $this->request->getPost();
        
        try {
            $this->obraModel->delete($obra);
            session()->setFlashdata('success', 'Obra excluída com sucesso!');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', 'Erro ao excluir a obra. Você não pode excluir uma obra que está vinculada a uma editora.');
            return redirect()->to('Obra/editar/' . $obra['id']);
        }
        
        return redirect()->to('Obra/index');
    }
    
    
    
}