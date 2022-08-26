<?php

    require_once(__DIR__.'/vendor/autoload.php');
    use App\Entity\Aluno;

    $titulo = "Cadastrar Aluno";
    $mensagem = "";

    if (count($_POST) > 0) {
        $aluno = new Aluno();
        $aluno->setNome($_POST['nome']);
        $aluno->setDataNascimento($_POST['dataNascimento']);
        $aluno->setCpf($_POST['cpf']);
        
        if ($aluno->cadastrar()) {
            $mensagem = "<div class='alert alert-success' role='alert'> Aluno cadastrado com sucesso! </div>";
        } else {
            $mensagem = "<div class='alert alert-warning' role='alert'> Não foi possível cadastrar o aluno! </div>";
        }
    }

    include_once(__DIR__.'/public/includes/header.php');
    include_once(__DIR__.'/public/includes/form-aluno.php');
    include_once(__DIR__.'/public/includes/footer.php');
?>