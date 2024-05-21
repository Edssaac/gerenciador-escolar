<main class="container">

    <div class="mt-4">
        <a href="/">
            <button type="button" class="btn btn-danger">Voltar</button>
        </a>
    </div>

    <h3 class="mt-5">
        <i class="fa-solid fa-address-card"></i>
        Matrícular Aluno
    </h3>

    <?php if (isset($data['message'])) { ?>
        <div class='alert alert-<?= $data['message_type'] ?> mt-4' role='alert'>
            <?= $data['message'] ?>
        </div>
    <?php } ?>

    <form method="post" action="/cadastrar/matricula/cadastrar" class="mt-5">
        <div class="row align-items-end mb-5">
            <label for="id_class" class="mb-1">Turma:</label>
            <select class="form-select mb-3 mx-2" id="id_class" name="id_class" required>
                <option value="0" selected>Selecione a turma</option>
                <?php foreach ($data['classes'] as $class) { ?>
                    <option value="<?= $class['id'] ?>"><?= $class['description'] ?></option>
                <?php } ?>
            </select>
            <?php if (isset($data['id_class'])) { ?>
                <input type="number" name="selected_id_class" id="selected_id_class" value="<?= $data['id_class'] ?>" hidden>
            <?php } ?>

            <label for="id_student" class="mb-1">Aluno:</label>
            <select class="form-select mb-3 mx-2" id="id_student" name="id_student" required disabled>
                <option value="0" selected>Selecione o aluno</option>
                <?php foreach ($data['students'] as $student) { ?>
                    <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
                <?php } ?>
            </select>
            <?php if (isset($data['id_student'])) { ?>
                <input type="number" name="selected_id_student" id="selected_id_student" value="<?= $data['id_student'] ?>" hidden>
            <?php } ?>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Matricular</button>
        </div>
    </form>

</main>