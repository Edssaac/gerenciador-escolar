<?php

    require_once(__DIR__.'/vendor/autoload.php');
    use App\Entity\Aluno;
    use App\Entity\Turma;

    $titulo = "Relatório de Chamadas";
    $alunos = "";

    if (isset($_POST['idTurma'])) {
        $aluno = new Aluno();
        $alunos = $aluno->getAlunosChamada();
    } else {
        $turma = new Turma();
        $turmas = $turma->getTurmas();
    
        include_once(__DIR__.'/public/includes/header.php');
        include_once(__DIR__.'/public/includes/form-relatorio.php');
        include_once(__DIR__.'/public/includes/footer.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/bootstrap-grid.min.css">

    <title>Relatório de Chamadas</title>
</head>

<body>

    <article class="container my-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Chamada</th>
                </tr>
            </thead>
            <tbody>
                <?= $alunos ?>
            </tbody>
        </table>
    </article>

</body>