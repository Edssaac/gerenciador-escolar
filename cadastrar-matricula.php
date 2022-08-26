<?php

    require_once(__DIR__.'/vendor/autoload.php');
    use App\Entity\Aluno;
    use App\Entity\Turma;
    use App\Entity\Matricula;

    $titulo = "Matrícular Aluno";
    $mensagem = "";
    $aluno = new Aluno();
    $turma = new Turma();

    if (count($_POST) > 0) {
        $matricula = new Matricula();
        $matricula->setIdAluno($_POST['idAluno']);
        $matricula->setIdTurma($_POST['idTurma']);
        
        if (!$matricula->vagaDisponivel()) {
            $mensagem = "<div class='alert alert-danger' role='alert'> Não foi possível matrícular o aluno pois não existem vagas na turma! </div>";
        } else if ($matricula->matricular()) {
            $mensagem = "<div class='alert alert-success' role='alert'> Aluno matrículado com sucesso! </div>";
        } else {
            $mensagem = "<div class='alert alert-warning' role='alert'> Não foi possível matrícular o aluno! </div>";
        }
    }

    $turmas = $turma->getTurmas();
    $alunos = $aluno->getAlunosOptions();

    include_once(__DIR__.'/public/includes/header.php');
    include_once(__DIR__.'/public/includes/form-matricula.php');
    include_once(__DIR__.'/public/includes/footer.php');
?>