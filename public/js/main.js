$(document).ready(function () {
  $('#cpf').mask('000.000.000-00');
  $('#ano').mask('0000');
});


$( "#gerarRelatorio" ).click(function(e) {
  e.preventDefault();
  var idTurma = $("#idTurma").val();
  
  if (idTurma == 0) {
    return;
  }

  $("form").submit();
});