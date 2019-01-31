$('#startFighting').on('click', abrirModalFight);

function abrirModalFight() {
  var tamanho = $(window).height();
  $(".modal-content").height(tamanho - 50).css({
    border: "2px solid #000"
  });

  var Saudacao = setTimeout(saudacaoTimer, 500);

  function saudacaoTimer() {
    $('.saudacao').attr('style', 'display:block !important');
  }

  var apresentaDesafiante = setTimeout(desafianteTimer, 3000);

  function desafianteTimer() {
    $('.apresentaDesafiante').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var nomeDesafiante = setTimeout(nomeDesafianteTimer, 6500);

  function nomeDesafianteTimer() {
    $('.nomeDesafiante').attr('style', 'display:block !important');
    $('.infos-desafiante').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
    //ROLAR PARA FINAL DA PAGINA
    $('html, body').animate({scrollTop: $(document).height()}, 700);
    //$('html, body').animate({ scrollTop: $('footer').offset().top }, 700);
  }

  var apresentaDesafiado = setTimeout(desafiadoTimer, 8000);

  function desafiadoTimer() {
    $('.apresentaDesafiado').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var nomeDesafiado = setTimeout(nomeDesafiadoTimer, 11500);

  function nomeDesafiadoTimer() {
    $('.nomeDesafiado').attr('style', 'display:block !important');
    $('.infos-desafiado').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var apresentaPosLutadores = setTimeout(posLutadoresTimer, 14000);

  function posLutadoresTimer() {
    $('.apresentaPosLutadores').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var apresentaItsTime = setTimeout(itsTimeTimer, 16000);

  function itsTimeTimer() {
    $('.apresentaItsTime').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var apresentaPreResultado = setTimeout(preResultadoTimer, 20500);

  function preResultadoTimer() {
    $('.apresentaPreResultado').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var apresentaResultado = setTimeout(resultadoTimer, 22500);

  function resultadoTimer() {
    $('.apresentaResultado').attr('style', 'display:block !important');
    $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
  }

  var apresentaVencedor = setTimeout(vencedorTimer, 28000);

  function vencedorTimer() {
    var Dados = $(this).serialize();

    //variaveis
    var param = "?desafiado=" + $("#desafiado").val() + "&desafiante=" + $("#desafiante").val() + "&eventoId=" + $("#evento").val();

    $.ajax({
      url: 'controller/lutar.php' + param,
      type: 'post',
      dataType: 'html',
      data: Dados,
      success: function (Dados) {
        $('.apresentaVencedor').html(Dados);
        $('.apresentaVencedor').attr('style', 'display:block !important');
        $('.modalLutaAoVivo').animate({scrollTop: $('.modalLutaAoVivo')[0].scrollHeight}, 500);
        $('#modalFechar').removeAttr("disabled");

        $('#startFighting').html("Replay");

        //Não entrar mais aqui quando clicar no botão
        $("#startFighting").unbind("click");
      }
    })

  }
}

