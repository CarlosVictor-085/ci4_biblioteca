<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ObraModel;
use App\Models\LivroModel;
use CodeIgniter\Session\Session;

class Livro extends BaseController
{
    private $obraModel;
    private $livroModel;

    public function __construct(){
        $this->obraModel = new ObraModel();
        $this->livroModel = new LivroModel();
        $this->session = \Config\Services::session();
    }

    public function index(){

        $pesquisa = $this->request->getPost();
        if(count($pesquisa) > 0){
            $livro = $this->livroModel->join('obra', 'livro.id_obra = obra.id')
            ->orlike('obra.titulo',$pesquisa['pesquisa'])
            ->orlike('status',$pesquisa['pesquisa'])
            ->orlike('disponivel',$pesquisa['pesquisa']);
            //dd($livro);
            $livro = $livro->paginate(10);
            //dd($livro);
        }else{
            $livro = $this->livroModel->paginate(10);
        };

        $statusdisponivel = LivroModel::STATUSLOCADO;
        $status = LivroModel::STATUSLIVRO;
        $obra = $this->obraModel->findAll();
        $pager = $this->livroModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('livro/index.php',['listaObra'=>$obra,'listaLivro'=>$livro, 'statusdisponivel'=>$statusdisponivel, 'status'=>$status, 'pager'=> $pager]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function editar($id){
        $statusdisponivel = LivroModel::STATUSLOCADO;
        $status = LivroModel::STATUSLIVRO;
        $livro = $this->livroModel->find($id);
        $obra = $this->obraModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('livro/edit',['listaObra' => $obra, 'livro' => $livro, 'statusdisponivel'=>$statusdisponivel, 'status'=>$status]);
        echo view('_partials/footer');

                if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }


    public function cadastrar(){
        $livro = $this->request->getPost();
        $this->livroModel->save($livro);
        return redirect()->to('Livro/index');
    }

    public function salvar(){
        $livro = $this->request->getPost();
        $this->livroModel->save($livro);
        return redirect()->to('Livro/index');
    }

    public function excluir(){
        $livro = $this->request->getPost();
        $this->livroModel->delete($livro);
        return redirect()->to('Livro/index');
    }
}
