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
        echo view('_partials/navbar2');
        echo view('home/index.php');
        echo view('_partials/footer');
    }
}
