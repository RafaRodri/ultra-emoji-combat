<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();
?>

<div id="divDataTable" class="row mx-auto border">
  <table id="tabela" class="table table-striped">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Status</th>
        <th scope="col">Evento</th>
        <th scope="col">Local</th>
        <th scope="col">Data</th>
        <th scope="col">Horário</th>
        <th scope="col">Categoria</th>
        <th scope="col">Rounds</th>
        <th scope="col">Desafiante</th>
        <th scope="col">Desafiado</th>
      </tr>
    </thead>
    <tbody>

      <?php
      if (!isset($statusLutas) || $statusLutas == "") {
        $statusLutas = 0;
      }

      $BFetchLuta = $Crud->getDadosLuta($Id, $statusLutas, 0);
      while ($Fetch = $BFetchLuta->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td class="icons">
            <a href="luta.php?id=<?= $Fetch['id'] ?>&acao=luta&operacao=visualizar">
              <img src="img/visualizar.png" alt="Visualizar">
            </a>
            <a href="cadastro.php?link=luta&operacao=editar&id=<?= $Fetch['id'] ?>">
              <img src="img/editar.png" alt="Editar">
            </a>
            <a href="controller/controllerDeletar.php?id=<?= $Fetch['id'] ?>&link=<?= $link ?>" class="deletar">
              <img src="img/lixeira.png" alt="Deletar">
            </a>
          </td>
          <?php
          if ($Fetch['aprovadoStatus'] == 1) {
            ?>
            <td class="circle text-success"></td>
            <?php
          } else {
            ?>
            <td class="circle text-danger"></td>
            <?php
          }
          ?>
          <th scope="row"><?= $Fetch['nomeEvento'] ?></th>
          <td class=""><?= $Fetch['localEvento'] ?></td>
          <td class=""><?= date("d/m", strtotime($Fetch['data'])) ?></td>
          <td class=""><?= date("H:i", strtotime($Fetch['data'])) ?></td>
          <td class=""><?= $Fetch['categoria'] ?></td>
          <td class=""><?= $Fetch['rounds'] ?></td>
          <td class=""><?= $Fetch['nomeDesafiante'] ?> <?= $Fetch['sobrenomeDesafiante'] ?></td>
          <td class=""><?= $Fetch['nomeDesafiado'] ?> <?= $Fetch['sobrenomeDesafiado'] ?></td>
        </tr>
        <?php
      }
      $BFetchLuta->closeCursor();
      ?>

    </tbody>
  </table>
  <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>"/>
</div>

