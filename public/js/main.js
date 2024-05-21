$(document).ready(function () {
    $('#birth_date').mask("99/99/9999", { placeholder: 'DD/MM/AAAA' });
    $('#cpf').mask('000.000.000-00', { placeholder: '___.___.___-__' });
    $('#year').mask('0000', { placeholder: 'AAAA' });

    if ($("#id_student option").length > 1) {
        $("#id_class").val($('#selected_id_class').val());

        if ($('#id_student').find('option[value="' + $('#selected_id_student').val() + '"]').length) {
            $("#id_student").val($('#selected_id_student').val());
        }

        $("#id_student").removeAttr('disabled');
    }

});

$('#id_class').on('change', function () {
    var id_class = $('#id_class').val();

    $('#id_student').html('<option value="0" selected>Selecione a turma</option>');

    if (id_class == 0) {
        $('#id_student').attr('disabled', true);

        return;
    };

    var data = {
        id_class: id_class
    };

    $.ajax({
        url: '/cadastrar/matricula/obterAlunosForaDeTurma',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            response.forEach(student => {
                $('#id_student').append(`<option value="${student.id}">${student.name}</option>`);
            });

            $('#id_student').removeAttr('disabled');
        }
    });
});

$("#generate_report").click(function (e) {
    e.preventDefault();

    var idTurma = $("#id_class").val();

    if (idTurma == 0) {
        return;
    }

    $("form").submit();
});