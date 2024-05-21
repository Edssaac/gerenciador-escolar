<?php

namespace App\Controller\Home;

use App\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];

        $data['title'] = 'Escola';
        $data['content'] = 'home/index';

        $this->render($data);
    }
}
