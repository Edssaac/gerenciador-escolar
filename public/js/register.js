$(document).ready(function () {
    $("#birth_date").mask("99/99/9999", { placeholder: "DD/MM/AAAA" });
    $("#cpf").mask("000.000.000-00", { placeholder: "___.___.___-__" });
    $("#year").mask("0000", { placeholder: "AAAA" });
});