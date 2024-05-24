<main class="container">

    <div class="mt-4">
        <a href="/">
            <button type="button" class="btn btn-danger">Voltar</button>
        </a>
    </div>

    <h3 class="mt-5">
        <i class="fa-solid fa-user-large"></i>
        Cadastrar Aluno
    </h3>

    <?php if (isset($data['message'])) { ?>
        <div class='alert alert-<?= $data['message_type'] ?> mt-4' role='alert'>
            <i class="fa-solid fa-<?= $data['message_icon'] ?>"></i>
            <?= $data['message'] ?>
        </div>
    <?php } ?>

    <form method="post" action="/register/student/register" class="mt-5">
        <div class="row align-items-end mb-5">
            <div class="col-12 mb-3">
                <label for="name" class="mb-1">Nome Completo:</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="250">
            </div>
            <div class="col-6 mb-3">
                <label for="birth_date" class="mb-1">Data de Nascimento:</label>
                <input type="text" class="form-control" id="birth_date" name="birth_date" required>
            </div>
            <div class="col-6 mb-3">
                <label for="cpf" class="mb-1">Cadastro de Pessoa Física (CPF):</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>

</main>