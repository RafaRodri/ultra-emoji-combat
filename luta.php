<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/header.php");
?>
<div class="info-form-luta">
  <?php
  require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/controller/consulta.php");

  $Crud = new ClassCrud();
  ?>
</div>

<!--Status mostrado abaixo da foto, após apresentação-->
<div class="row">
  <div class="col-3 text-left infos-desafiado d-none">
    <p class="m-0"><?= $desafiadoNome . " " ?> </p>
    <p class="m-0"><?= $desafiadoSobrenome ?> </p>
    <p class="m-0"><?= $desafiadoVitorias . "-" . $desafiadoDerrotas . "-" . $desafiadoEmpates ?></p>
  </div>
  <div class="col text-center">
    <?php
    if ($statusLuta == 1) {
      ?>
      <input id="evento" type="hidden" name="evento" value="<?= $idEvento ?>"/>
      <input id="desafiante" type="hidden" name="desafiante" value="<?= $desafianteId ?>"/>
      <input id="desafiado" type="hidden" name="desafiado" value="<?= $desafiadoId ?>"/>
      <a href="#" id="startFighting" class="btn btn-success w-50 my-2" data-toggle="modal"
         data-target="#modal">Iniciar</a>
      <?php
    } elseif ($nomeStatus == "encerrada" && $nomeVencedor != "" && $sobrenomeVencedor != "") {
      ?>
      <h2 class="text-success">
        Vencedor: <?= $nomeVencedor . (($apelidoVencedor != "") ? " '" . $apelidoVencedor . "' " : " ") . $sobrenomeVencedor ?></h2>
      <?php
    }
    ?>
  </div>
  <div class="col-3 text-right infos-desafiante d-none">
    <p class="m-0"><?= $desafianteNome . " " ?> </p>
    <p class="m-0"><?= $desafianteSobrenome ?> </p>
    <p class="m-0"><?= $desafianteVitorias . "-" . $desafianteDerrotas . "-" . $desafianteEmpates ?></p>
  </div>
</div>

<!-- Modal -->
<!--<div class="modal fade d-block" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLuta" aria-hidden="true" style="opacity: 1;">-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLuta" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" id="modalLuta">Luta</h5>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <div class="modal-body modalLutaAoVivo">
        <div class="saudacao bg-danger d-none">
          <!--<div class="saudacao bg-danger">-->
          <p>Senhoras e senhores, estamos ao vivo !</p>
          <p>Para esta luta da categoria</p>
          <p>Peso Leve !!!</p>
        </div>
        <div class="apresentaDesafiante d-none">
          <!--<div class="apresentaDesafiante">-->
          <p>De um lado ele,</p>
          <p>Que vem diretamente de <?= $desafiantePais ?>,</p>
          <p>Com <?= $desafianteIdade ?> anos, <?= $desafianteAltura ?>m de altura e <?= $desafiantePeso ?>Kg...</p>
          <p class="nomeDesafiante d-none"><?= $desafianteNome ?>
            <span><?= ($desafianteApelido != "") ? "'" . $desafianteApelido . "' " : ""; ?></span><?= $desafianteSobrenome ?>
          </p>
          <!--<p class="nomeDesafiante">Pretty Boy</p>-->
        </div>
        <div class="apresentaDesafiado d-none">
          <!--<div class="apresentaDesafiado">-->
          <p>Do outro lado,</p>
          <p>Com <?= $desafiadoIdade ?> anos, <?= $desafiadoAltura ?>m de altura e <?= $desafiadoPeso ?>Kg...</p>
          <p>Diretamente de <?= $desafiadoPais ?>...</p>
          <p class="nomeDesafiado d-none"><?= $desafiadoNome ?>
            <span><?= ($desafiadoApelido != "") ? "'" . $desafiadoApelido . "' " : ""; ?></span><?= $desafiadoSobrenome ?>
          </p>
          <!--<p class="nomeDesafiado">Putscript</p>-->
        </div>
        <div class="apresentaPosLutadores d-none">
          <!--<div class="apresentaPosLutadores">-->
          <p>Este é o momento que todos esperavam...</p>
        </div>
        <div class="apresentaItsTime d-none">
          <!--<div class="apresentaItsTime">-->
          <p>IT'S TIIIIIIIME !!!</p>
        </div>
        <div class="apresentaPreResultado d-none">
          <!--<div class="apresentaPreResultado">-->
          <p>Resultado...</p>
        </div>
        <div class="apresentaResultado d-none">
          <!--<div class="apresentaResultado">-->
          <p>Vitória de...</p>
        </div>
        <div class="apresentaVencedor d-none">
          <!--<div class="apresentaVencedor">-->
          <p></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modalFechar" class="btn btn-success" data-dismiss="modal" disabled="disabled">Fechar
        </button>
      </div>
    </div>
  </div>
</div>

<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/footer.php");
?>
<script type="text/javascript" src="js/apresentacao-luta.js"></script>
