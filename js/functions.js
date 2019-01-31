$(document).ready(function () {
  dataTable();
  comboLutadores();
  mascarar();
});

function dataTable() {
  $('#tabela').dataTable({
    "bJQueryUI": true,  //Identifica que o plugin deve utilizar o tema padrão do seu jQuery, ou seja, o seu jQuery UI configurado.
    "pageLength": 25,
    "oLanguage": {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
}

function comboLutadores() {
  var categoria = $('#inputCategoria').val();
  var desafiado = $('#inputDesafiado').val();
  var desafiante = $('#inputDesafiante').val();

  $.getJSON('interatividade.php?opcao=categoria&valor=' + categoria, function (dados) {

    if (dados.length > 0) {
      var optionDesafiado = '<option value="">Lutadores</option>';
      var optionDesafiante = '<option value="">Lutadores</option>';
      $.each(dados, function (i, obj) {

        if (obj.apelido != '') {
          apelido = '"' + obj.apelido + '" ';
        } else {
          apelido = '';
        }

        if (obj.id == desafiado) {
          optionDesafiado += '<option value="' + obj.id + '" selected>' + obj.nome + ' ' + apelido + obj.sobrenome + '</option>';
        } else {
          optionDesafiado += '<option value="' + obj.id + '">' + obj.nome + ' ' + apelido + obj.sobrenome + '</option>';
        }

        if (obj.id == desafiante) {
          optionDesafiante += '<option value="' + obj.id + '" selected>' + obj.nome + ' ' + apelido + obj.sobrenome + '</option>';
        } else {
          optionDesafiante += '<option value="' + obj.id + '">' + obj.nome + ' ' + apelido + obj.sobrenome + '</option>';
        }

      })
    }

    $('#inputDesafiado').html(optionDesafiado).show();
    $('#inputDesafiante').html(optionDesafiante).show();
  })
}

function carregaLutas() {
  var status = document.forms["formOpcao"]["opcao"].value;
  //alert("clique no radio="+status);

  $("#tableLutas").load("include/table-lutas.php?link=luta&statusLutas=" + status, function () {
    dataTable();
  });
}

function mascarar() {
  $("input[name*='altura']").inputmask({
    mask: ['9.99'],
    keepStatic: true,
  });
  $("input[name*='peso']").inputmask({
    mask: ['99.99', '999.99'],
    keepStatic: true,
  });
}

$(".container").on('submit', '#formCadastro', function (event) {
  event.preventDefault();
  var objeto = $("#objeto").attr('value');

  if (objeto == "luta") {
    var msg = 'Confirmar a requisição para esta luta de ' + document.forms["formCadastro"]["rounds"].value + ' rounds?';
    var divShow = '.info-form-luta';
    var divHide = 'info-form';
  }
  else {
    var msg = 'Confirmar inclusão do status "' + document.forms['formCadastro']['nome'].value + '" ?';
    var divShow = '.info-form';
    var divHide = 'info-form-luta';
  }

  if (confirm(msg)) {
    var Dados = $(this).serialize();

    $.ajax({
      url: 'controller/cadastro.php?acao=' + objeto,
      type: 'post',
      dataType: 'html',
      data: Dados,
      success: function (Dados) {
        //$(divShow).show().html(Dados);
        //$("#formCadastro").load("include/formCadastro.php?link=" + objeto, mascarar);

        setTimeout(showMsg, 200);
        if (objeto != "luta") {
          setTimeout(hideMsg, 4000);
        }

        function showMsg() {
          $('html, body').animate({scrollTop: 0}, 'slow'); //slow, medium, fast
          $(divShow).show().html(Dados);
          $(divShow).attr('style', 'display:block !important');
          $('.' + divHide).toggleClass(divHide);
        }

        function hideMsg() {
          $(divShow).attr('style', 'display:none !important');
        }
      }
    })

    //$(divShow).attr('style', 'display:block !important');
    //$('.'+divHide).toggleClass(divHide);

    //$('#formCadastro')[0].reset();
  } else {
    return false;
  }
});

$("#tableConsultas").on("click", ".deletar", {}, function (event) {
  event.preventDefault();

  var Dados = $(this).serialize();

  var Link = $(this).attr('href');
  var objeto = $("#objeto").attr('value');

  if (confirm("Deseja mesmo apagar esse dado?")) {
    $.ajax({
      url: Link,
      type: 'POST',
      dataType: 'html',
      data: Dados,
      success: function (Dados) {
        $("#tableConsultas").load("include/tableConsulta.php?link=" + objeto, function () {
          dataTable();
        });
        //$("#formCadastro").load("include/formCadastro.php?link=" + objeto);

        setTimeout(showMsg, 200);
        setTimeout(hideMsg, 4000);

        function showMsg() {
          $('html, body').animate({scrollTop: 0}, 'slow'); //slow, medium, fast
          $('#resultado').html(Dados);
          $('#resultado').attr('style', 'display:block !important');
        }

        function hideMsg() {
          $('#resultado').attr('style', 'display:none !important');
        }
      }
    })
  } else {
    return false;
  }
});

$('#inputCategoria').on('change', function () {
  comboLutadores();
});

$("#formOpcao").on("click", ":radio", carregaLutas);

//TRIGGERS
//$("#formOpcao :radio:first-child").trigger("click");
