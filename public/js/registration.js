$(document).ready(function () {
    if ($("#id_student option").length > 1) {
        $("#id_class").val($("#selected_id_class").val());

        const selected_id_student = $("#selected_id_student").val();

        if ($("#id_student").find(`option[value="${selected_id_student}"]`).length) {
            $("#id_student").val(selected_id_student);
        }

        $("#id_student").removeAttr("disabled");
    }
});

$("#id_class").on("change", function () {
    var id_class = $("#id_class").val();

    $("#id_student").html(`<option value="0" selected>Selecione a turma</option>`);

    if (id_class == 0) {
        $("#id_student").attr("disabled", true);

        return;
    };

    var data = {
        id_class: id_class
    };

    $.ajax({
        url: "/register/registration/getStudentsOutOfClass",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (response) {
            response.forEach(student => {
                $("#id_student").append(`<option value="${student.id}">${student.name}</option>`);
            });

            $("#id_student").removeAttr("disabled");
        }
    });
});