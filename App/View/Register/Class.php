<main class="container">

    <div class="mt-4">
        <a href="/">
            <button type="button" class="btn btn-danger">Voltar</button>
        </a>
    </div>

    <h3 class="mt-5">
        <i class="fa-solid fa-chalkboard"></i>
        Cadastrar Turma
    </h3>

    <?php if (isset($data["message"])) { ?>
        <div class="alert alert-<?= $data["message_type"] ?> mt-4" role="alert">
            <?= $data["message"] ?>
        </div>
    <?php } ?>

    <form method="post" action="/register/class/register" class="mt-5">
        <div class="row align-items-end mb-5">
            <div class="col-12 mb-3">
                <label for="description" class="mb-1">Descrição:</label>
                <input type="text" class="form-control" id="description" name="description" required maxlength="250">
            </div>
            <div class="col-6 mb-3">
                <label for="year" class="mb-1">Ano:</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>
            <div class="col-6 mb-3">
                <label for="vacancies" class="mb-1">Vagas:</label>
                <input type="number" class="form-control" id="vacancies" name="vacancies" required>
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>

</main>