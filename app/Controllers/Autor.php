<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AutorModel;
use CodeIgniter\Session\Session;

class Autor extends BaseController
{
    private $autorModel;
    
    public function __construct(){
        $this->autorModel = new AutorModel();
        $this->session = \Config\Services::session();
    }

    public function index(){
        $dados = $this->autorModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('autor/index.php',['listaAutor' => $dados]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function cadastrar(){
        $autor = $this->request->getPost();
        $autor['senha']= md5("senhaforte");
        $this->autorModel->save($autor);
        return redirect()->to('Autor/index');
    }
    
    public function editar($id){
        $dados = $this->autorModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('autor/edit',['autor' => $dados]);
        echo view('_partials/footer');
    }

    public function salvar(){
        $autor = $this->request->getPost();
        $this->autorModel->save($autor);
        return redirect()->to('Autor/index');
    }

    public function excluir(){
        $autor = $this->request->getPost();
        $this->autorModel->delete($autor);
        return redirect()->to('Autor/index');
    }

}
