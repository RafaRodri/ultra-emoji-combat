<?php
//require_once("include/header.php");
//require_once("class/crud.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/header.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");
?>
  <link rel="stylesheet" href="css/index.css"/>
  <div class="row">
  <div class="col-xl-9 mb-3">
    <div>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/banner/banner1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/banner/banner2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/banner/banner3.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <div class="col-xl-3">
    <div class="row">
      <?php
      $Crud = new ClassCrud();
      $BFetchLutas = $Crud->getDadosLuta(0, 1, 1);
      $i = 1;


      //while ($FetchLutas = $BFetchLutas->fetch(PDO::FETCH_ASSOC)){
      foreach ($BFetchLutas as $FetchLutas) {
      if ($i == 3){
      ?>
      <div class="col-12 col-md-4 col-xl-12 d-sm-none d-md-block d-xl-none">
        <?php
        }else{
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-xl-12">
          <?php
          }
          $i++;
          ?>
          <div class="card w-100 mb-3 text-center text-uppercase" style="width: 18rem;">
            <h3
                class="card-header-luta card-header font-weight-bold"><?= date("d/m", strtotime($FetchLutas['data'])) ?></h3>
            <div class="card-home card-body p-1">
              <div class="hover card w-100 mb-3 text-center text-uppercase">
                <div class="hover-lutadores">
                  <div class="hover-desafiante">
                    <img
                        src="img/lutadores/<?= strtolower($FetchLutas['nomeDesafiado']) . "-" . strtolower($FetchLutas['sobrenomeDesafiado']) ?>.png"/>
                  </div>
                  <div class="hover-desafiado">
                    <img
                        src="img/lutadores/<?= strtolower($FetchLutas['nomeDesafiante']) . "-" . strtolower($FetchLutas['sobrenomeDesafiante']) ?>.png"/>
                  </div>
                </div>
                <a href="luta.php?id=<?= $FetchLutas['id'] ?>&acao=luta&operacao=visualizar"
                   class="btn btn-primary m-2">Detalhes</a>
              </div>

              <h3 class="card-title font-weight-bold">
                <div class="logo-evento">
                  <span>UEC</span><br/>
                  <span><?= $FetchLutas['nomeEvento'] ?></span></
                >
                </span>
              </h3>
              <h5
                  class="font-weight-bold m-0"><?= $FetchLutas['nomeDesafiado'] . " " . $FetchLutas['sobrenomeDesafiado'] ?></h5>
              <p class="m-0">vs</p>
              <h5
                  class="font-weight-bold m-0"><?= $FetchLutas['nomeDesafiante'] . " " . $FetchLutas['sobrenomeDesafiante'] ?></h5>

            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/footer.php");
?>
