<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;
use CodeIgniter\Session\Session;

class Usuario extends BaseController{
    private $usuarioModel;
    
    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
        $this->session = \Config\Services::session();
    }
    
    public function index(){
        $dados = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/index.php',['listaUsuarios' => $dados]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function cadastrar(){
        $usuario = $this->request->getPost();   
        $this->usuarioModel->save($usuario);
        return redirect()->to('Usuario/index');
    }
    
    public function editar($id){
        $dados = $this->usuarioModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/edit',['usuario' => $dados]);
        echo view('_partials/footer');
    }

    public function salvar(){
        $usuario = $this->request->getPost();
        $this->usuarioModel->save($usuario);
        return redirect()->to('Usuario/index');
    }

    public function excluir(){
        $usuario = $this->request->getPost();
        $this->usuarioModel->delete($usuario);
        return redirect()->to('Usuario/index');
    }


}
