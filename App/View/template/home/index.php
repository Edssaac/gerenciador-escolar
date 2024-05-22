<main class="container my-5">

    <?php if (isset($data['message'])) { ?>
        <div class='alert alert-<?= $data['message_type'] ?> mt-4' role='alert'>
            <?= $data['message'] ?>
        </div>
    <?php } ?>

    <div class="row row-cols-1 row-cols-md-2 g-4">

        <div class="col">
            <div class="card">
                <img src="/public/images/darksalmon.png" class="card-img-top" alt="Cadastrar Aluno">
                <div class="card-body">
                    <a href="cadastrar/aluno">
                        <button class="btn btn-primary w-100" type="button">Cadastrar Aluno</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="/public/images/indianred.png" class="card-img-top" alt="Cadastrar Turma">
                <div class="card-body">
                    <a href="cadastrar/turma">
                        <button class="btn btn-primary w-100" type="button">Cadastrar Turma</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="/public/images/maroon.png" class="card-img-top" alt="Matrícular Aluno">
                <div class="card-body">
                    <a href="/cadastrar/matricula">
                        <button class="btn btn-primary w-100" type="button">Matrícular Aluno</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="/public/images/orangered.png" class="card-img-top" alt="Relatório de Chamadas">
                <div class="card-body">
                    <a href="relatorio/chamada">
                        <button class="btn btn-primary w-100" type="button">Relatório de Chamadas</button>
                    </a>
                </div>
            </div>
        </div>

    </div>

</main>