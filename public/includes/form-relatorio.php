<main class="container">

    <div class="mt-4">
        <a href="index.php">
            <button type="button" class="btn btn-danger">Voltar</button>
        </a>
    </div>

    <h3 class="mt-5">
        <i class="fa-solid fa-clipboard-list"></i>
        Relatório de Chamadas
    </h3>

    <form action="relatorio.php" method="post" target="_blank" class="mx-2 mt-3">
        <div class="row">
            <select class="form-select mb-2" id="idTurma" name="idTurma" required>
                <option value="0" selected>Selecione a turma</option>
                <?= $turmas ?>
            </select>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success" id="gerarRelatorio">Gerar Relatório</button>
        </div>
    </form>

</main>