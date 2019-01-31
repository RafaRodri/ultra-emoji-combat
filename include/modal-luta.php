<?php
//Não aprovada
if ($motivo != "") {
  ?>
  <div class="row">
    <div class="titulo-modal col-12 text-center">
      <h1 class="text-danger">Luta <?= $nomeStatus ?></h1>
      <h3 class="d-block text-danger">
        <?= $motivo ?>
      </h3>
    </div>
  </div>
  <?php
//Aprovada
} else {
  ?>
  <div class="row">
    <div class="titulo-modal col-12 text-center">
      <h1 class="text-<?= ($statusLuta == 1 ? "success" : "danger") ?>">Luta <?= $nomeStatus ?></h1>
      <h6
        class="mb-3 text-<?= ($statusLuta == 1 ? "success" : "danger") ?>"><?= ($descricao != "") ? ucfirst($descricao) : "" ?></h6>

      <h2 class="m-0"><?= $nomeEvento ?></h2>
      <h3 class="m-0"><?= $data ?></h3>
      <h3 class="m-0"><?= $hora ?></h3>
      <h4>Peso <?= $nomeCategoria ?></h4>
    </div>
  </div>

  <div class="luta-modal row m-0">
    <div class="col-12 col-sm-7 col-md-3 col-lg-4">
      <?php
      $player_img = "{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/img/lutadores/" . $desafiadoFoto . ".png";
      //$player_img="img/lutadores/".$desafiadoFoto.".png";

      if (!file_exists($player_img)) {
        $desafiadoFoto = "default-man";
      }
      ?>
      <img class="w-100" src="img/lutadores/<?= $desafiadoFoto ?>.png"
           alt="<?= " foto de " . $desafiadoNome . " '" . $desafiadoApelido . "' " . $desafiadoSobrenome ?>">
    </div>
    <div class="desafiado col-12 col-sm-5 col-md-3 col-lg-2 p-1">
      <div class="nome-lutador">
        <h3 class="d-none d-md-block m-0"><?= $desafiadoNome ?>
          <span><?= ($desafiadoApelido != "") ? "'" . $desafiadoApelido . "'" : ""; ?></span></h3>
        <h4 class="d-none d-md-block m-0"><?= $desafiadoSobrenome ?></h4>
        <h1 class="d-md-none m-0"><?= $desafiadoNome ?>
          <span><?= ($desafiadoApelido != "") ? "'" . $desafiadoApelido . "'" : ""; ?></span></h1>
        <h1 class="d-md-none m-0"><?= $desafiadoSobrenome ?></h1>
      </div>
      <h4 class="mb-3"><?= $desafiadoPais ?></h4>
      <h4 class="m-0"><?= $desafiadoIdade ?> anos</h4>
      <h4 class="mb-3">
        <span><?= $desafiadoAltura ?>m</span>
        <span><?= number_format($desafiadoPeso, 1, '.', '') ?>Kg</span>
      </h4>
      <h4 class="m-0"><?= $desafiadoVitorias ?>-<?= $desafiadoDerrotas ?>-<?= $desafiadoEmpates ?></h4>
    </div>
    <div class="col-12 d-md-none text-center">
      <h1 class="">Vs</h1>
    </div>
    <div class="col-12 col-sm-5 col-md-3 col-lg-2 p-1 text-right">
      <div class="nome-lutador">
        <h3 class="d-none d-md-block m-0"><?= $desafianteNome ?>
          <span><?= ($desafianteApelido != "") ? "'" . $desafianteApelido . "'" : ""; ?></span></h3>
        <h4 class="d-none d-md-block m-0"><?= $desafianteSobrenome ?></h4>
        <h1 class="d-md-none m-0"><?= $desafianteNome ?>
          <span><?= ($desafianteApelido != "") ? "'" . $desafianteApelido . "'" : ""; ?></span></h1>
        <h1 class="d-md-none m-0"><?= $desafianteSobrenome ?></h1>
      </div>
      <h4 class="mb-3"><?= $desafiantePais ?></h4>
      <h4 class="m-0"><?= $desafianteIdade ?> anos</h4>
      <h4 class="mb-3">
        <span><?= $desafianteAltura ?>m</span>
        <span><?= number_format($desafiantePeso, 1, '.', '') ?>Kg</span>
      </h4>
      <h4 class="m-0"><?= $desafianteVitorias ?>-<?= $desafianteDerrotas ?>-<?= $desafianteEmpates ?></h4>
    </div>
    <div class="col-12 col-sm-7 col-md-3 col-lg-4 text-right">
      <?php
      $player_img = "{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/img/lutadores/" . $desafianteFoto . ".png";
      //$player_img="img/lutadores/".$desafianteFoto.".png";

      if (!file_exists($player_img)) {
        $desafianteFoto = "default-man";
      }
      ?>
      <img class="w-100" src="img/lutadores/<?= $desafianteFoto ?>.png"
           alt="<?= " foto de " . $desafianteNome . " '" . $desafianteApelido . "' " . $desafianteSobrenome ?>">
    </div>
  </div>

  <?php
}
?>
