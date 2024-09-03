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
        $pesquisa = $this->request->getPost();
        if(count($pesquisa) > 0){
        $dados = $this->usuarioModel->like('nome',$pesquisa['pesquisa'])
            ->orlike('email',$pesquisa['pesquisa'])
            ->orlike('telefone',$pesquisa['pesquisa']);
            $dados = $dados->paginate(10);
            //dd($dados);
            
        }else{
           $dados = $this->usuarioModel->paginate(10);
        }
        $pages = $this->usuarioModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/index.php',['listaUsuarios' => $dados, 'pager' => $pages]);
        echo view('_partials/footer');
    }

    public function editar($id){
        $dados = $this->usuarioModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('usuario/edit',['usuario' => $dados]);
        echo view('_partials/footer');
    }

    public function cadastrar(){
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
