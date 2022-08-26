<?php

    require_once(__DIR__.'/vendor/autoload.php');
    use App\Entity\Turma;

    $titulo = "Relatório de Chamadas";
    $turma = new Turma();
    $turmas = $turma->getTurmas();

    include_once(__DIR__.'/public/includes/header.php');
    include_once(__DIR__.'/public/includes/form-relatorio.php');
    include_once(__DIR__.'/public/includes/footer.php');
?>