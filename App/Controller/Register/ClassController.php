<?php

namespace App\Controller\Register;

use App\Controller;
use App\Model\ClassModel;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Cadastrar Turma';
        $this->data['content'] = 'Register/Class';

        $this->addScript('register');
    }

    public function index()
    {
        $this->render($this->data);
    }

    public function register()
    {
        if (!$this->validateData($_POST)) {
            $this->data['message'] = $this->errors;
            $this->data['message_type'] = 'warning';

            $this->errors = [];
        } else {
            $class = new ClassModel();

            if ($class->register($_POST)) {
                $this->data['message'] = 'Turma cadastrada com sucesso!';
                $this->data['message_type'] = 'success';
            } else {
                $this->data['message'] = 'Não foi possível cadastrar a turma!';
                $this->data['message_type'] = 'warning';
            }
        }

        $this->render($this->data);
    }

    private function validateData($data)
    {
        if (empty($data['description'])) {
            $this->errors[] = 'Campo Descrição deve ser preenchido!';
        }

        if (empty($data['year'])) {
            $this->errors[] = 'Campo Ano deve ser preenchido!';
        }

        if (empty($data['vacancies'])) {
            $this->errors[] = 'Campo Vagas deve ser preenchido!';
        }

        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }
}
