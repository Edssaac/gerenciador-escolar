<main class="container">

    <div class="mt-4">
        <a href="/">
            <button type="button" class="btn btn-danger">Voltar</button>
        </a>
    </div>

    <h3 class="mt-5">
        <i class="fa-solid fa-clipboard-list"></i>
        Relatório de Chamadas
    </h3>

    <form method="post" action="/relatorio/chamada/relatorio" target="_blank" class="mt-5">
        <div class="row mb-5">
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
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success" id="generate_report">Gerar Relatório</button>
        </div>
    </form>

</main>