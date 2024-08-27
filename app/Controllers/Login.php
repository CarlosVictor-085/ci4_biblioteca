<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Session\Session;
use App\Models\UsuarioModel;

class Login extends Controller
{
    protected $session;
    protected $usuarioModel;

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->usuarioModel = new UsuarioModel();
    }
    
    public function index()
    {
        echo view('_partials/header');
        echo view('_partials/navbarlogin');
        echo view('_partials/footer');
        
        // Verificar se o usuário já está logado
        if ($this->session->has('logged_in')) {
            return redirect()->to(base_url('Home/index'));
        }

        // Carregar a view de login
        return view('loguin/index');
    }

    public function authenticate()
    {
    // Obter os dados do formulário
    $email = $this->request->getPost('email');
    $senha = $this->request->getPost('senha');
    $nome = $this->request->getPost('nome');

    // Verificar se os dados estão vazios
    if (empty($email) || empty($senha) || empty($nome)) {
        return redirect()->back()->withInput()->with('error', 'Preencha todos os campos!');
    }

    // Buscar usuário pelo nome e email
    $usuario = $this->usuarioModel->where('nome', $nome)->where('email', $email)->first();

    // Verificar se o usuário existe e se a senha é válida
    if (password_verify($senha, $usuario['senha'])) {
        // Criar sessão
        $this->session->set('logged_in', true);
        $this->session->set('email', $email);
        $this->session->set('nome', $nome);

        // Redirecionar para a página de dashboard
        return redirect()->to(base_url('Home/index'));
    } else {
        // Mostrar mensagem de erro
        return redirect()->back()->withInput()->with('error', 'Email ou senha incorretos!');
    }
    }

    public function logout()
    {
        // Destruir sessão
        $this->session->destroy();

        // Redirecionar para a página de login
        return redirect()->to(base_url('login'));
    }
}
