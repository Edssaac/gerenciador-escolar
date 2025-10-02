<body>

    <article class="container my-5">
        <h3 class="text-center mb-3">
            <?= $data["class"]["description"] ?>
        </h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Chamada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["students"] as $student) { ?>
                    <tr>
                        <td><?= $student["name"] ?></td>
                        <td><?= $student["birth_date"] ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
                <?php if (empty($data["students"])) { ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum aluno matrículado nesta turma.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </article>

</body>