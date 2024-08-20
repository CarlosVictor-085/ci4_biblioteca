<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AlunoModel;
use CodeIgniter\Session\Session;

class Aluno extends BaseController{   
    private $alunoModel;
    
    public function __construct(){
        $this->alunoModel = new AlunoModel();
        $this->session = \Config\Services::session();
    }
    
    public function index(){
        $pesquisa = $this->request->getPost();
        if(count($pesquisa) > 0){
            $dados = $this->alunoModel->like('nome', $pesquisa['pesquisa'])
                                    ->orlike('cpf', $pesquisa['pesquisa'])
                                    ->orlike('email', $pesquisa['pesquisa'])
                                    ->orLike('telefone', $pesquisa['pesquisa'])
                                    ->orLike('turma',$pesquisa['pesquisa']);
            $dados = $dados->paginate(10);
            
        }else{
            $dados = $this->alunoModel->paginate(10);
        }; 
        $pager = $this->alunoModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('aluno/index.php',['listaAlunos' => $dados,'pager' => $pager]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function cadastrar(){
        $aluno = $this->request->getPost();
        $aluno['senha']= md5("senhaforte");
        $this->alunoModel->save($aluno);
        return redirect()->to('Aluno/index');
    }

    public function editar($id){
        $dados = $this->alunoModel->find($id);
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('aluno/edit',['aluno' => $dados]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function salvar(){
        $aluno = $this->request->getPost();
        $this->alunoModel->save($aluno);
        return redirect()->to('Aluno/index');
    }

    public function excluir(){
        $aluno = $this->request->getPost();
        $this->alunoModel->delete($aluno);
        return redirect()->to('Aluno/index');
    }

}
