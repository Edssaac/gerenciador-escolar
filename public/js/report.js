$("#generate_report").click(function (e) {
    e.preventDefault();

    var idTurma = $("#id_class").val();

    if (idTurma == 0) {
        return;
    }

    $("form").submit();
});