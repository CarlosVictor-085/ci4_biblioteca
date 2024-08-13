<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;

class Home extends BaseController
{
    public function __construct(){
        $this->session = \Config\Services::session();
    }
    public function index(){
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('home/index.php');
        echo view('_partials/footer');
        
        if ($this->session->has('logged_in')) {
        }else{
            return redirect()->to(base_url('Login/index'));
        }
    }
}
