<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmprestimoModel;
use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\UsuarioModel;

class Emprestimo extends BaseController
{
    private $emprestimoModel;
    private $livroModel;
    private $alunoModel;
    private $usuarioModel;
    
    public function __construct(){
        $this->emprestimoModel = new EmprestimoModel();
        $this->livroModel = new LivroModel();
        $this->alunoModel = new AlunoModel();
        $this->usuarioModel = new UsuarioModel();
    }
    
    public function index(){
        $emprestimo = $this->emprestimoModel->findAll();
        $livro = $this->livroModel->findAll();
        $aluno = $this->alunoModel->findAll();
        $usuario = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/index.php',['listaEmprestimo'=>$emprestimo,'listaLivro'=>$livro,'listaAluno'=> $aluno,'listaUsuario'=>$usuario]);
        echo view('_partials/footer');
    }

    public function cadastrar(){
        $emprestimo = $this->request->getPost();
        $this->emprestimoModel->save($emprestimo);
        return redirect()->to('Emprestimo/index');
    }
    
    public function editar($id){
        $emprestimo = $this->emprestimoModel->find($id);
        $livro = $this->livroModel->findAll();
        $aluno = $this->alunoModel->findAll();
        $usuario = $this->usuarioModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/edit',['emprestimo'=>$emprestimo,'listaLivro'=>$livro,'listaAluno'=> $aluno,'listaUsuario'=>$usuario]);
        echo view('_partials/footer');
    }

    public function salvar(){
        $emprestimo = $this->request->getPost();
        $this->emprestimoModel->save($emprestimo);
        return redirect()->to('Emprestimo/index');
    }

    public function excluir(){
        $emprestimo = $this->request->getPost();
        $this->emprestimoModel->delete($emprestimo);
        return redirect()->to('Emprestimo/index');
    }

    public function devolucao($id){
        $emprestimo = $this->emprestimoModel->find($id);
        $livro = $this->livroModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('devolução/index.php',['emprestimo'=>$emprestimo,'listaLivro'=>$livro]);
        echo view('_partials/footer');
    }
}
