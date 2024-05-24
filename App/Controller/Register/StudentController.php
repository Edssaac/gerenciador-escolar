<?php

namespace App\Controller\Register;

use App\Controller;
use App\Model\StudentModel;

/**
 * Controller responsável por representar um aluno.
 */
class StudentController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Cadastrar Aluno';
        $this->data['content'] = 'Register/Student';

        $this->addScript('register');
    }

    public function index(): void
    {
        $this->render($this->data);
    }

    /**
     * Método responsável por realizar tentativa de cadastro de aluno.
     *  
     * @return void
     */
    public function register(): void
    {
        if (!$this->validateData($_POST)) {
            $this->data['message'] = $this->errors;
            $this->data['message_type'] = 'warning';

            $this->errors = [];
        } else {
            $student = new StudentModel();

            $_POST['birth_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $_POST['birth_date'])));
            $_POST['cpf'] = preg_replace("/[^0-9]/", "", $_POST['cpf']);

            if ($student->register($_POST)) {
                $this->data['message'] = 'Aluno cadastrado com sucesso!';
                $this->data['message_type'] = 'success';
            } else {
                $this->data['message'] = 'Não foi possível cadastrar o aluno!';
                $this->data['message_type'] = 'warning';
            }
        }

        $this->render($this->data);
    }

    /**
     * Método responsável por realizar validações nos dados passados.
     *  
     * @param array $data
     * @return void
     */
    private function validateData(array $data): bool
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
