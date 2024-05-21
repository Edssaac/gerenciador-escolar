<?php

namespace App\Controller\Cadastrar;

use App\Controller;
use App\Model\TurmaModel;
use App\Model\AlunoModel;
use App\Model\MatriculaModel;

class MatriculaController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Matrícular Aluno';
        $this->data['content'] = 'cadastrar/matricula';

        $turma = new TurmaModel();

        $this->data['classes'] = $turma->getTurmas();

        $this->render($this->data);
    }

    private function obterAlunosDisponiveisPorTurma($idClass) {
        $student = new AlunoModel();

        return $student->getAlunosDisponiveisPorTurma($idClass);;
    }

    public function obterAlunosForaDeTurma()
    {
        if (isset($_POST['id_class']) && is_numeric($_POST['id_class'])) {
            $availableStudents = $this->obterAlunosDisponiveisPorTurma($_POST['id_class']);
        } else {
            $availableStudents = [];
        }

        header('Content-Type: application/json');
        echo json_encode($availableStudents);
    }

    public function cadastrar()
    {
        if (!$this->validarDados($_POST)) {
            $this->data['message'] = $this->errors;
            $this->data['message_type'] = 'warning';

            if (isset($_POST['id_class']) && is_numeric($_POST['id_class'])) {
                $this->data['students'] = $this->obterAlunosDisponiveisPorTurma($_POST['id_class']);

                $this->data['id_student'] = $_POST['id_student'] ?? 0;
                $this->data['id_class'] = $_POST['id_class'];
            }

            $this->errors = [];
        } else {
            $matricula = new MatriculaModel();

            if ($matricula->matricular($_POST)) {
                $this->data['message'] = 'Aluno matrículado com sucesso!';
                $this->data['message_type'] = 'success';
            } else {
                $this->data['message'] = 'Não foi possível matrícular o aluno na turma!';
                $this->data['message_type'] = 'warning';
            }
        }

        $this->data['title'] = 'Matrícular Aluno';
        $this->data['content'] = 'cadastrar/matricula';

        $turma = new TurmaModel();

        $this->data['classes'] = $turma->getTurmas();

        $this->render($this->data);
    }

    private function validarDados($data)
    {
        if (empty($data['id_class'])) {
            $this->errors[] = 'Campo Turma deve ser preenchido!';
        }

        if (empty($data['id_student'])) {
            $this->errors[] = 'Campo Aluno deve ser preenchido!';
        }

        $matricula = new MatriculaModel();

        if (!$matricula->verificarVagaDisponivel($data['id_class'])) {
            $this->errors[] = 'Turma não possui vaga disponível!';
        }

        if (!$matricula->verificarAlunoNaTurma($data['id_class'], $data['id_student'])) {
            $this->errors[] = 'O aluno selecionado já possui matrícula na turma!';
        }

        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }
}
