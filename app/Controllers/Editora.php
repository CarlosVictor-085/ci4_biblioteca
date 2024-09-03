<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EditoraModel;
use CodeIgniter\Session\Session;

class Editora extends BaseController
{
    private $editoraModel;
    
    public function __construct(){
        $this->editoraModel = new EditoraModel();
        $this->session = \Config\Services::session();
    }
    
    public function index(){
        $pesquisa = $this->request->getPost();
        if(count($pesquisa) > 0){
            $dados = $this->editoraModel->like('nome',$pesquisa['pesquisa'])
            ->orlike('email',$pesquisa['pesquisa'])
            ->orlike('telefone',$pesquisa['pesquisa']);
            $dados = $dados->paginate(10);
            //dd($dados);
        }else{
        $dados = $this->editoraModel->paginate(10);
        }
        $pager = $this->editoraModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('editora/index.php',['listaEditora' => $dados,'pager' => $pager]);
        echo view('_partials/footer');

    }

    public function cadastrar(){
        $editora = $this->request->getPost();
        $editora['senha']= md5("senhaforte");
        $this->editoraModel->save($editora);
        return redirect()->to('Editora/index');
    }
    
    public function editar($id){
        $dados = $this->editoraModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('editora/edit',['editora' => $dados]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function salvar(){
        $editora = $this->request->getPost();
        $this->editoraModel->save($editora);
        return redirect()->to('Editora/index');
    }

    public function excluir(){
        $editora = $this->request->getPost();
        $this->editoraModel->delete($editora);
        return redirect()->to('Editora/index');
    }
}
