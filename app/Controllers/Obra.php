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
        $this->session = \Config\Services::session();
    }
    
    public function index(){
        $pesquisa = $this->request->getPost();
        if(count($pesquisa) > 0){
            $obra = $this->obraModel->like('titulo',$pesquisa['pesquisa'])
            ->orlike('categoria',$pesquisa['pesquisa'])
            ->orLike('ano_publicacao',$pesquisa['pesquisa'])
            ->orlike('isbn',$pesquisa['pesquisa'])
            ->orLike('editora.nome', $pesquisa['pesquisa']);
            //dd($dados);
        }else{
        $obra = $this->obraModel->select('editora.nome')->join('editora', 'obra.id_editora = editora.id')->paginate(10);
        };
        $obra =$this->obraModel->select('*')->join('editora', 'obra.id_editora = editora.id')->paginate(10);
        //dd($editora);
        
        $pager = $this->obraModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/index.php',['listaObra'=>$obra,'pager' => $pager]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function cadastrar(){
        $obra = $this->request->getPost();
        $this->obraModel->save($obra);
        return redirect()->to('Obra/index');
    }
    
    public function editar($id){
        $obra = $this->obraModel->find($id);
        $autor = $this->autorModel->findAll();
        $editora = $this->editoraModel->findAll();
        $dadosAutorObra = $this->autorObraModel->findAll();
        
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('obra/edit',['obra' => $obra,'listaAutor' => $autor,'listaEditora' => $editora,'listaAutorObra' => $dadosAutorObra]);
        echo view('_partials/footer');

        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }

    public function adicionarAutor(){
        $this->autorObraModel->save(
            $this->request->getPost()
        );
        return redirect()->to(
            'Obra/editar/'.$this->request->getPost('id_obra')
        );
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
