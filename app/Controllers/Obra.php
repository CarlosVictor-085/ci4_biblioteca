<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\EditoraModel;
use App\Models\AutorModel;
use App\Models\AutorObraModel;
use CodeIgniter\Session\Session;

class Obra extends BaseController
{
    private $obraModel;
    private $editoraModel;
    private $autorModel;
    private $autorObraModel;
    
    public function __construct(){
        $this->editoraModel = new EditoraModel();
        $this->obraModel = new ObraModel();
        $this->autorModel = new AutorModel();
        $this->autorObraModel = new AutorObraModel();
    }
    
    public function index(){
        $obra =$this->obraModel->select('obra.id, obra.titulo, obra.categoria, obra.ano_publicacao, obra.isbn, editora.nome')->join('editora', 'obra.id_editora = editora.id')->findAll();
        
        //dd($obra);
        
        $pager = $this->obraModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/index.php',['listaObra'=>$obra,'pager' => $pager]);
        echo view('_partials/footer');

    }

    public function cadastrar(){
        $obra = $this->request->getPost();
        $this->obraModel->save($obra);
        return redirect()->to('Obra/index');
    }
    
    public function editar($id){
        $obra =$this->obraModel->select('obra.id, obra.titulo, obra.categoria, obra.ano_publicacao, obra.isbn, obra.id_editora,editora.nome, editora.id')->join('editora', 'obra.id_editora = editora.id')->find($id);
        //dd($obra);
        $autor = $this->autorModel->findAll();
        $dadosAutorObra = $this->autorObraModel->findAll();
        $editora = $this->editoraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/edit',['obra' => $obra,'editora' => $editora,'listaAutor' => $autor,'listaAutorObra' => $dadosAutorObra]);
        echo view('_partials/footer');
    }

    public function adicionarAutor(){
        $this->autorObraModel->save(
            $this->request->getPost()
        );
        return redirect()->to(previous_url());
    }

    public function salvar(){
        $obra = $this->request->getPost();
        $this->obraModel->save($obra);
        return redirect()->to('Obra/index');
    }

    public function excluir(){
        $obra = $this->request->getPost();
        $this->obraModel->delete($obra);
        return redirect()->to('Obra/index');
    }
}