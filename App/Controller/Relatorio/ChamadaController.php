<?php

namespace App\Controller\Relatorio;

use App\Controller;
use App\Model\TurmaModel;
use App\Model\AlunoModel;

class ChamadaController extends Controller
{
    public function index()
    {
        $this->data = [];

        $this->data['title'] = 'Relatório de Chamadas';
        $this->data['content'] = 'relatorio/chamada_form';

        $turma = new TurmaModel();

        $this->data['classes'] = $turma->getTurmas();

        $this->render($this->data);
    }

    public function relatorio()
    {
        $this->data = [];

        $this->data['title'] = 'Relatório de Chamadas';
        $this->data['content'] = 'relatorio/chamada';

        $aluno = new AlunoModel();

        $this->data['students'] = $aluno->getAlunosChamada($_POST['id_class']);

        $this->render($this->data);
    }
}
