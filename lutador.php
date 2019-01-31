<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/header.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();

$BFetchLutador = $Crud->getDadosLutador($Id);
$Fetch = $BFetchLutador->fetch(PDO::FETCH_ASSOC);
?>

  <div class="row lutador">
    <div class="col-12 col-md-7 col-lg-6 col-xl-5">

      <?php
      $foto = strtolower($Fetch['nome'] . "-" . $Fetch['sobrenome']);
      $player_img = "img/lutadores/" . $foto . ".png";
      if (!file_exists($player_img)) {
        $foto = "default-man";
      }
      ?>

      <img class="align-self-start w-100 mr-3" src="img/lutadores/<?= $foto ?>.png"
           alt="<?= " foto de " . $Fetch['nome'] . " '" . $Fetch[' apelido'] . "' " . $Fetch['nome'] ?>">
    </div>
    <div class="col-12 col-md-5 col-lg-6 col-xl-7">
      <div class="media-body text-uppercase font-weight-bold">
        <div class="row">
          <div class="col">
            <h1
              class="mt-0"><?= $Fetch['nome'] . ' ' . (($Fetch['apelido'] != "") ? '"' . $Fetch['apelido'] . '"' : "") . ' ' . $Fetch['sobrenome'] ?></h1>
            <hr/>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p class="mb-0 text-secondary">País</p>
            <h3><?= $Crud->getDadosPais($Fetch['alpha3Code']) ?></h3>
            <hr/>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <p class="mb-0 text-secondary">Idade</p>
            <h3 class="text-lowercase d-md-none d-lg-block"><?= $Crud->getIdade($Fetch['nascimento']) ?> anos</h3>
            <h5 class="text-lowercase d-none d-md-block d-lg-none"><?= $Crud->getIdade($Fetch['nascimento']) ?>
              anos</h5>
            <hr/>
          </div>
          <div class="col-4">
            <p class="mb-0 text-secondary">Altura</p>
            <h3 class="text-lowercase d-md-none d-lg-block"><?= $Fetch['altura'] ?> m</h3>
            <h5 class="text-lowercase d-none d-md-block d-lg-none"><?= $Fetch['altura'] ?> m</h5>
            <hr/>
          </div>
          <div class="col-4">
            <p class="mb-0 text-secondary">Peso</p>
            <h3 class="text-lowercase d-md-none d-lg-block"><?= number_format($Fetch['peso'], 1, '.', '') ?> Kg</h3>
            <h5 class="text-lowercase d-none d-md-block d-lg-none"><?= number_format($Fetch['peso'], 1, '.', '') ?>
              Kg</h5>
            <hr/>
          </div>
        </div>
        <div class="row px-1 justify-content-center">
          <div class="col">
          </div>
          <div class="col">
            <a href="#">
              <h1 class="fi-social-facebook" title="social facebook" aria-hidden="true"></h1>
            </a>
          </div>
          <div class="col">
            <a href="#">
              <h1 class="fi-social-twitter" title="social twitter" aria-hidden="true"></h1>
            </a>
          </div>
          <div class="col">
            <a href="#">
              <h1 class="fi-social-instagram" title="social instagram" aria-hidden="true"></h1>
            </a>
          </div>
          <div class="col">
          </div>
          <!--<div class="col border border-success text-center">
              <h1 class="fi-social-google-plus" title="social google-plus" aria-hidden="true"></h1>
          </div>-->
        </div>
      </div>
    </div>
  </div>

<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/footer.php");
?>