<?php

namespace App\Controller\Home;

use App\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Escola';
        $this->data['content'] = 'home/index';
    }

    public function index()
    {
        $this->render($this->data);
    }
}
