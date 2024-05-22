<?php

namespace App\Controller\Home;

use App\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Gerenciador Escolar';
        $this->data['content'] = 'home/index';
    }

    public function index()
    {
        session_start();

        if (isset($_SESSION['INTERNAL_SITUATION']) && $_SESSION['INTERNAL_SITUATION'] === 500) {
            $this->data['message'] = 'Não foi possível acessar o recurso no momento. 
                Tente novamente e se o erro persistir entre em contato com o suporte.
            ';

            $this->data['message_type'] = 'danger';
        }

        session_destroy();

        $this->render($this->data);
    }
}
