<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/header.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");
?>

  <div class="row">
    <?php
    $Crud = new ClassCrud();

    $BFetchLutador = $Crud->getDadosLutador(0);
    while ($Fetch = $BFetchLutador->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="col-md-6 col-lg-4">
        <div class="card mx-auto mb-5 border border-dark" style="width: 18rem;">
          <?php
          // ----------------------------------
          // FOTO DEVE TER PROPORÇÃO DE 285x340
          // ----------------------------------
          $foto = strtolower($Fetch['nome'] . "-" . $Fetch['sobrenome']);
          $player_img = "img/lutadores/mini/" . $foto . ".png";
          if (!file_exists($player_img)) {
            $foto = "default-man";
          }
          ?>
          <img class="card-img-top" src="img/lutadores/mini/<?= $foto ?>.png"
               alt="<?= "Foto de " . $Fetch['nome'] . " '" . $Fetch['apelido'] . "' " . $Fetch['nome'] ?>">

          <div class="card-atletas card-body p-2">
            <h5 class="card-title">
              <span><?= $Fetch['nome'] ?></span>
              <span><?= (($Fetch['apelido'] != "") ? '"' . $Fetch['apelido'] . '"' : "") ?><br/></span>
              <span class="w-100"><?= $Fetch['sobrenome'] ?></span>
            </h5>
            <p class="card-text m-0"><?= $Fetch['alpha3Code'] ?></p>
            <p class="card-text m-0">Categoria: <?= $Fetch['categoria'] ?></p>
            <a href="lutador.php?id=<?= $Fetch['id'] ?>" class="btn btn-primary mt-3">Perfil</a>
          </div>
        </div>
      </div>


      <?php
    }
    $BFetchLutador->closeCursor();
    ?>

  </div>

<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/footer.php");
?>
