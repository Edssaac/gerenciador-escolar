<?php

    require_once(__DIR__.'/vendor/autoload.php');
    use App\Entity\Turma;

    $titulo = "Cadastrar Turma";
    $mensagem = "";

    if (count($_POST) > 0) {
        $turma = new Turma();
        $turma->setDescricao($_POST['descricao']);
        $turma->setAno($_POST['ano']);
        $turma->setVagas($_POST['vagas']);
        
        if ($turma->cadastrar()) {
            $mensagem = "<div class='alert alert-success' role='alert'> Turma cadastrada com sucesso! </div>";
        } else {
            $mensagem = "<div class='alert alert-warning' role='alert'> Não foi possível cadastrar a turma! </div>";
        }
    }

    include_once(__DIR__.'/public/includes/header.php');
    include_once(__DIR__.'/public/includes/form-turma.php');
    include_once(__DIR__.'/public/includes/footer.php');
?>