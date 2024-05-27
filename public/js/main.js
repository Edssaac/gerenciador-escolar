$(document).ready(function () {
    if ($('.alert').length) {
        let icon = '';
        let title = '';

        if ($('.alert').hasClass('alert-danger')) {
            icon = 'xmark';
            title = 'Erro';
        } else if ($('.alert').hasClass('alert-success')) {
            icon = 'check';
            title = 'Sucesso';
        } else {
            icon = 'triangle-exclamation';
            title = 'Atenção';
        }

        $('.alert').prepend(`<i class="fa-solid fa-${icon}"></i> <b>${title}</b><br>`);
    }
});