<?php

namespace App\Controller\Register;

use App\Controller;
use App\Model\ClassModel;
use App\Model\StudentModel;
use App\Model\RegistrationModel;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Matrícular Aluno';
        $this->data['content'] = 'Register/Registration';

        $this->addScript('registration');
    }

    public function index()
    {
        $class = new ClassModel();

        $this->data['classes'] = $class->getClasses();

        $this->render($this->data);
    }

    private function getStudentsAvailableForClass($idClass)
    {
        $student = new StudentModel();

        return $student->getStudentsAvailableForClass($idClass);;
    }

    public function getStudentsOutOfClass()
    {
        if (isset($_POST['id_class']) && is_numeric($_POST['id_class'])) {
            $availableStudents = $this->getStudentsAvailableForClass($_POST['id_class']);
        } else {
            $availableStudents = [];
        }

        header('Content-Type: application/json');
        echo json_encode($availableStudents);
    }

    public function register()
    {
        if (!$this->validateData($_POST)) {
            $this->data['message'] = $this->errors;
            $this->data['message_type'] = 'warning';

            if (isset($_POST['id_class']) && is_numeric($_POST['id_class'])) {
                $this->data['students'] = $this->getStudentsAvailableForClass($_POST['id_class']);

                $this->data['id_student'] = $_POST['id_student'] ?? 0;
                $this->data['id_class'] = $_POST['id_class'];
            }

            $this->errors = [];
        } else {
            $registration = new RegistrationModel();

            if ($registration->register($_POST)) {
                $this->data['message'] = 'Aluno matrículado com sucesso!';
                $this->data['message_type'] = 'success';
            } else {
                $this->data['message'] = 'Não foi possível matrícular o aluno na turma!';
                $this->data['message_type'] = 'warning';
            }
        }

        $class = new ClassModel();

        $this->data['classes'] = $class->getClasses();

        $this->render($this->data);
    }

    private function validateData($data)
    {
        if (empty($data['id_class'])) {
            $this->errors[] = 'Campo Turma deve ser preenchido!';
        }

        if (empty($data['id_student'])) {
            $this->errors[] = 'Campo Aluno deve ser preenchido!';
        }

        $registration = new RegistrationModel();

        if (!$registration->checkAvailableVacancy($data['id_class'])) {
            $this->errors[] = 'Turma não possui vaga disponível!';
        }

        if ($registration->checkStudentInClass($data['id_class'], $data['id_student'])) {
            $this->errors[] = 'O aluno selecionado já possui matrícula na turma!';
        }

        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }
}
