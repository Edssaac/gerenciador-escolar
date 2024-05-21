<?php

namespace App\Controller\Cadastrar;

use App\Controller;
use App\Model\AlunoModel;

class AlunoController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Cadastrar Aluno';
        $this->data['content'] = 'cadastrar/aluno';

        $this->addScript('register');
    }

    public function index()
    {
        $this->render($this->data);
    }

    public function cadastrar()
    {
        if (!$this->validarDados($_POST)) {
            $this->data['message'] = $this->errors;
            $this->data['message_type'] = 'warning';

            $this->errors = [];
        } else {
            $aluno = new AlunoModel();

            $_POST['birth_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $_POST['birth_date'])));
            $_POST['cpf'] = preg_replace("/[^0-9]/", "", $_POST['cpf']);

            if ($aluno->cadastrar($_POST)) {
                $this->data['message'] = 'Aluno foi inserido no sistema!';
                $this->data['message_type'] = 'success';
            } else {
                $this->data['message'] = 'Não foi possível inserir aluno no sistema, tente novamente mais tarde!';
                $this->data['message_type'] = 'warning';
            }
        }

        $this->render($this->data);
    }

    private function validarDados($data)
    {
        if (empty($data['name'])) {
            $this->errors[] = 'Campo Nome deve ser preenchido!';
        }

        if (empty($data['birth_date'])) {
            $this->errors[] = 'Campo Data de Nascimento deve ser preenchido!';
        }

        if (empty($data['cpf'])) {
            $this->errors[] = 'Campo CPF deve ser preenchido!';
        }

        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }
}
