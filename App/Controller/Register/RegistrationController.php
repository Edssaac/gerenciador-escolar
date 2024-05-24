<?php

namespace App\Controller\Register;

use App\Controller;
use App\Model\ClassModel;
use App\Model\RegistrationModel;

/**
 * Controller responsável por representar uma matrícula.
 */
class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Matrícular Aluno';
        $this->data['content'] = 'Register/Registration';

        $this->addScript('registration');
    }

    public function index(): void
    {
        $class = new ClassModel();

        $this->data['classes'] = $class->getClasses();

        $this->render($this->data);
    }

    /**
     * Método responsável por obter os alunos que não estão matriculados em uma determinada turma.
     *  
     * @param int $idClass
     * @return array
     */
    private function getStudentsAvailableForClass(int $idClass): array
    {
        $student = new RegistrationModel();

        return $student->getStudentsAvailableForClass($idClass);
    }

    /**
     * Método responsável por obter os alunos que não estão matriculados em uma determinada turma.
     *  
     * @return void
     */
    public function getStudentsOutOfClass(): void
    {
        if (isset($_POST['id_class']) && is_numeric($_POST['id_class'])) {
            $availableStudents = $this->getStudentsAvailableForClass($_POST['id_class']);
        } else {
            $availableStudents = [];
        }

        header('Content-Type: application/json');
        echo json_encode($availableStudents);
    }

    /**
     * Método responsável por realizar tentativa de matricular um aluno em uma turma.
     *  
     * @return void
     */
    public function register(): void
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

    /**
     * Método responsável por realizar validações nos dados passados.
     *  
     * @param array $data
     * @return void
     */
    private function validateData(array $data): bool
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
