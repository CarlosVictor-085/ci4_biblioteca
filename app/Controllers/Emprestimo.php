<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmprestimoModel;
use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\UsuarioModel;
use App\Models\ObraModel;
use CodeIgniter\Session\Session;

class Emprestimo extends BaseController
{
    private $EmprestimoModel;
    private $livroModel;
    private $alunoModel;
    private $usuarioModel;
    private $obraModel;
    
    public function __construct(){
        $this->EmprestimoModel = new EmprestimoModel();
        $this->livroModel = new LivroModel();
        $this->alunoModel = new AlunoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->obraModel = new ObraModel();
    }
    
    public function index(){
         // Construindo a consulta usando QueryBuilder
         $builder = $this->EmprestimoModel->builder();

         // Verifique se a tabela principal e seus aliases estão corretos
         $builder->select('e.id AS emprestimo_id, e.data_inicio, e.data_prazo, e.data_fim, 
                           a.nome AS nome_aluno, u.nome AS nome_usuario, o.titulo AS nome_obra')
                 ->distinct()
                 ->from('emprestimo e') // Definindo a tabela principal e o alias
                 ->join('aluno a', 'e.id_aluno = a.id', 'left') // Certifique-se de que a tabela é `alunos`
                 ->join('usuario u', 'e.id_usuario = u.id', 'left') // Certifique-se de que a tabela é `usuarios`
                 ->join('livro l', 'e.id_livro = l.id', 'left') // Certifique-se de que a tabela é `livros`
                 ->join('obra o', 'l.id_obra = o.id', 'left') // Certifique-se de que a tabela é `obras`
                 ->orderBy('e.id', 'DESC'); // Ordena os resultados
 
         // Obtendo todos os registros
         $emprestimos = $builder->get()->getResultArray();

        // Processando cada empréstimo para formatar as datas e calcular o estado da devolução
        foreach ($emprestimos as &$emprestimo) {
            // Data de início - convertendo de string para timestamp
            $data_inicio = explode('-', $emprestimo['data_inicio']);
            $timestamp_inicio = mktime(0, 0, 0, $data_inicio[1], $data_inicio[2], $data_inicio[0]);

            // Calculando a data de prazo
            $prazo = $emprestimo['data_prazo'] * 24 * 60 * 60; // Convertendo o prazo de dias para segundos
            $timestamp_prazo = $timestamp_inicio + $prazo; // Somando o prazo à data de início

            // Adicionando as datas formatadas ao array
            $emprestimo['data_inicio_formatada'] = date('d/m/Y', $timestamp_inicio); // Data de início formatada
            $emprestimo['data_prazo_formatada'] = date('d/m/Y', $timestamp_prazo);   // Data de prazo formatada

            // Verificando e formatando data de fim
            if (!empty($emprestimo['data_fim'])) {
                $data_fim = explode('-', $emprestimo['data_fim']);
                $timestamp_fim = mktime(0, 0, 0, $data_fim[1], $data_fim[2], $data_fim[0]);
                $emprestimo['data_fim_formatada'] = date('d/m/Y', $timestamp_fim); // Data de fim formatada

                // Calculando se a devolução está no prazo ou fora do prazo
                if ($timestamp_fim - $timestamp_prazo <= 0) {
                    $emprestimo['status_devolucao'] = "Devolução no prazo";
                } else {
                    $emprestimo['status_devolucao'] = "Devolução fora do prazo";
                }
            } else {
                $emprestimo['data_fim_formatada'] = null; // Ou qualquer valor padrão se `data_fim` estiver vazio
                $emprestimo['status_devolucao'] = null; // Sem devolução registrada
            }
        }
        //dd($emprestimo);
        $livro = $this->livroModel->findAll();
        $dadosobra = $this->obraModel->findAll();
        $aluno = $this->alunoModel->findAll();
        $usuario = $this->usuarioModel->findAll();
        $pager = $this->EmprestimoModel->pager;
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/index.php',['listaEmprestimo'=>$emprestimos,'listaLivro'=>$livro,'listaAluno'=> $aluno,'listaUsuario'=>$usuario,'listaObra' => $dadosobra,'pager' => $pager]);
        echo view('_partials/footer');

    }

    public function cadastrar()
    {
        $dados = $this->request->getPost();
        $this->EmprestimoModel->save($dados);
        $this->livroModel->update($dados['id_livro'], ['disponivel' => 0]);
        return redirect()->to('emprestimo/index');
    }
    public function editar($id)
    {
        $dados = $this->EmprestimoModel->find($id);
        $dadosaluno = $this->alunoModel->findAll();
        $dadosobra = $this->obraModel->findAll();
        $dadosusuario = $this->usuarioModel->findAll();
        $dadoslivro = $this->livroModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('emprestimo/edit',['emprestimo' => $dados,'listaAluno' => $dadosaluno,'listaLivro' => $dadoslivro,'listaUsuario' => $dadosusuario,'listaObra' => $dadosobra]);
        echo view('_partials/footer');

    }
    public function salvar(){
        $dados = $this->request->getPost();
        $this->EmprestimoModel->save($dados);
        $this->livroModel->update($dados['id_livro_antigo'],['disponivel' => 1]);
        $this->livroModel->update($dados['id_livro'], ['disponivel' => 0]);
        return redirect()->to('emprestimo/index');
    }
    public function salvardev(){
        $dados = $this->request->getPost();
        $this->EmprestimoModel->save($dados);
        $this->livroModel->update($dados['id_livro'], ['disponivel' => 1]);
        return redirect()->to('emprestimo/index');
    }
    public function excluir(){
        $dados = $this->request->getPost();
        $this->livroModel->update($dados['id_livro'], ['disponivel' => 1]);
        $this->EmprestimoModel->delete($dados);
        return redirect()->to('emprestimo/index');
    }

    public function devolucao($id){
        $emprestimo = $this->EmprestimoModel->find($id);
        $dadosobra = $this->obraModel->findAll();
        $livro = $this->livroModel->findAll();
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('devolução/index.php',['emprestimo'=>$emprestimo,'listaLivro'=>$livro,'listaObra' => $dadosobra]);
        echo view('_partials/footer');
    }
}
