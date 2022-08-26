<main class="container">

    <div class="mt-4">
        <a href="index.php">
            <button type="button" class="btn btn-danger">Voltar</button>
        </a>
    </div>

    <h3 class="mt-5">
        <i class="fa-solid fa-user-large"></i>
        Cadastrar Aluno
    </h3>

    <?= $mensagem ?>

    <form method="post" class="mt-3">
        <div class="row">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" required maxlength="250">
            </div>
            <div class="col-6 mb-2">
                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>
            </div>
            <div class="col-6 mb-2">
                <input type="text" class="form-control" placeholder="CPF" id="cpf" name="cpf" required>
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </form>

</main>