<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/paises.php");

$Crud = new ClassCrud();
?>

<!--<div id="resultado" class="info-form-delete d-none"></div>-->
<?php
// Consultar Lutador
if ($link == "lutador") {
  ?>
  <div id="divDataTable" class="row mx-auto border">
    <table id="tabela" class="table table-striped">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Nome</th>
          <th scope="col">Nacionalidade</th>
          <th scope="col">Idade</th>
          <th scope="col">Altura</th>
          <th scope="col">Peso</th>
          <th scope="col">Categoria</th>
          <th scope="col">Vitórias</th>
          <th scope="col">Derrotas</th>
          <th scope="col">Empates</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $BFetchLutador = $Crud->getDadosLutador($Id);
        while ($Fetch = $BFetchLutador->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <tr>
            <td class="icons">
              <a href="lutador.php?id=<?= $Fetch['id'] ?>">
                <img src="img/visualizar.png" alt="Visualizar">
              </a>
              <a href="cadastro.php?link=lutador&operacao=editar&id=<?= $Fetch['id'] ?>">
                <img src="img/editar.png" alt="Editar">
              </a>
              <a href="controller/controllerDeletar.php?id=<?= $Fetch['id'] ?>&link=<?= $link ?>" class="deletar">
                <img src="img/lixeira.png" alt="Deletar">
              </a>
            </td>
            <th scope="row"><?= $Fetch['nome'] ?> <?= $Fetch['sobrenome'] ?></th>
            <td class=""><?= $Fetch['alpha3Code'] ?></td>
            <td class=""><?= $Crud->getIdade($Fetch['nascimento']) ?>
            <td class="text-right"><?= number_format($Fetch['altura'], 2, '.', '') ?> m</td>
            <td class="text-right"><?= number_format($Fetch['peso'], 2, '.', '') ?> Kg</td>
            <td class=""><?= $Fetch['categoria'] ?>
            <td class=""><?= $Fetch['vitorias'] ?>
            <td class=""><?= $Fetch['derrotas'] ?>
            <td class=""><?= $Fetch['empates'] ?>
          </tr>
          <?php
        }
        $BFetchLutador->closeCursor();
        ?>
      </tbody>
    </table>
    <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>"/>
  </div>

  <?php
}

// Consultar  Luta
elseif ($link == "luta") {
  ?>
  <div class="row">
    <div class="col pb-4">
      <!--<div class="btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-primary ">
              <input id="proximas-lutas" type="checkbox" checked autocomplete="off">
              Exibir somente as próximas lutas
          </label>
      </div>-->
      Exibir somente as próximas lutas:
      <form name="formOpcao" id="formOpcao">
        <input type="radio" name="opcao" id="opsim" value="1"/><label for="opsim">SIM</label>
        <input type="radio" name="opcao" id="opnao" value="0" checked/><label for="opnao">NÃO</label>
      </form>
      <!--<div id="proximas-lutas" class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-primary active">
              <input type="radio" name="options" value="sim" onchange="carregaLutas()" autocomplete="off" checked>
              Sim
          </label>
          <label class="btn btn-primary">
              <input type="radio" name="options" value="nao" onclick="carregaLutas()" autocomplete="off">
              Não
          </label>
      </div>-->
    </div>
  </div>


  <div id="tableLutas">
    <?php
    // require_once("include/tableLutas.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/table-lutas.php");
    ?>
  </div>
  <!--<div id="divDataTable" class="row mx-auto border">
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
  $BFetchLuta = $Crud->getDadosLuta($Id, 0, 0);
  while ($Fetch = $BFetchLuta->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <tr>
                <td class="icons">
                    <a href="luta.php?id=<?= $Fetch['id'] ?>&acao=luta&operacao=visualizar">
                        <img src="Img/Visualizar.png" alt="Visualizar"></a>
                    <a href="cadastro.php?link=luta&operacao=editar&id=<?= $Fetch['id'] ?>">
                        <img src="Img/Editar.png" alt="Editar"></a>
                    <a href="controller/controllerDeletar.php?id=<?= $Fetch['id'] ?>&link=<?= $link ?>" class="deletar">
                        <img src="Img/Lixeira.png" alt="Deletar"></a>
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
    <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>" />
</div>-->
  <?php
}

// Consultar  Evento
elseif ($link == "evento") {
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
        </tr>
      </thead>
      <tbody>
        <?php
        $BFetchEvento = $Crud->getDadosEvento($Id);
        while ($Fetch = $BFetchEvento->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <tr>
            <td class="icons">
              <a href="#">
                <img src="img/visualizar.png" alt="Visualizar">
              </a>
              <a href="cadastro.php?link=evento&operacao=editar&id=<?= $Fetch['id'] ?>">
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
            <th scope="row"><?= $Fetch['nome'] ?></th>

            <?php
            $BFetchPais = $Crud->getDadosPais($Fetch['alpha3']);
            ?>
            <td class=""><?= $BFetchPais ?></td>
            <td class=""><?= date("d/m/y", strtotime($Fetch['data'])) ?></td>
            <td class=""><?= date("H:i", strtotime($Fetch['data'])) ?></td>
          </tr>
          <?php
        }
        $BFetchEvento->closeCursor();
        ?>
      </tbody>
    </table>
    <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>"/>
  </div>

  <?php
}

// Consultar  Categoria
elseif ($link == "categoria") {
  ?>
  <div id="divDataTable" class="row mx-auto border">
    <table id="tabela" class="table table-striped">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Categoria</th>
          <th scope="col" class="text-right">Peso Mínimo</th>
          <th scope="col" class="text-right">Peso Máximo</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $BFetchCategoria = $Crud->getDadosCategoria(0);
        while ($Fetch = $BFetchCategoria->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <tr>
            <td class="icons">
              <a href="#">
                <img src="img/visualizar.png" alt="Visualizar">
              </a>
              <a href="cadastro.php?link=categoria&operacao=editar&id=<?= $Fetch['id'] ?>">
                <img src="img/editar.png" alt="Editar">
              </a>
              <a href="controller/controllerDeletar.php?id=<?= $Fetch['id'] ?>&link=<?= $link ?>" class="deletar">
                <img src="img/lixeira.png" alt="Deletar">
              </a>
            </td>
            <th scope="row"><?= $Fetch['nome'] ?></th>
            <td class="text-right"><?= $Fetch['pesoMinimo'] ?> Kg</td>
            <td class="text-right"><?= $Fetch['pesoMaximo'] ?> Kg</td>
          </tr>
          <?php
        }
        $BFetchCategoria->closeCursor();
        ?>
      </tbody>
    </table>
    <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>"/>
  </div>

  <?php
}

// Consultar  Países
elseif ($link == "paises") {
  ?>
  <div id="divDataTable" class="row mx-auto border">
    <table id="tabela" class="table table-striped">
      <thead>
        <tr>
          <!-- Somente na versão 1, quando os países vinham do DB
          <th scope="col"></th>-->
          <th scope="col">País</th>
          <th scope="col">Sigla</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $BFetchPaises = $Crud->getDadosPaises();
        foreach ($BFetchPaises as $paises) {
          //while($Fetch=$BFetchPaises->fetch(PDO::FETCH_ASSOC)){
          ?>
          <tr>
            <!-- Somente na versão 1, quando os países vinham do DB
                <td class="icons">
                    <a href="#">
                        <img src="Img/Visualizar.png" alt="Visualizar">
                    </a>
                    <a href="cadastro.php?link=paises&operacao=editar&id=<?= $paises->id ?>">
                        <img src="Img/Editar.png" alt="Editar">
                    </a>
                    <a href="controller/controllerDeletar.php?id=<?= $paises->id ?>&link=<?= $link ?>" class="deletar">
                        <img src="Img/Lixeira.png" alt="Deletar">
                    </a>
                </td>-->
            <th scope="row"><?= $paises->nome ?></th>
            <td class=""><?= strtoupper($paises->alpha3Code) ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>"/>
  </div>

  <?php
}

// Consultar  Status
elseif ($link == "status") {
  ?>
  <div id="divDataTable" class="row mx-auto border">
    <table id="tabela" class="table table-striped">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Status</th>
          <th scope="col">Categoria</th>
          <th scope="col">Descrição</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $BFetchStatus = $Crud->getDadosStatus(0);
        while ($Fetch = $BFetchStatus->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <tr>
            <td class="icons">
              <a href="#">
                <img src="img/visualizar.png" alt="Visualizar">
              </a>
              <a href="cadastro.php?link=status&operacao=editar&id=<?= $Fetch['id'] ?>">
                <img src="img/editar.png" alt="Editar">
              </a>
              <a href="controller/controllerDeletar.php?id=<?= $Fetch['id'] ?>&link=<?= $link ?>" class="deletar">
                <img src="img/lixeira.png" alt="Deletar">
              </a>
            </td>
            <?php
            if ($Fetch['status'] == 0) {
              ?>
              <td class="circle text-danger"></td>
              <?php
            } else {
              ?>
              <td class="circle text-success"></td>
              <?php
            }
            ?>
            <th scope="row"><?= ucfirst($Fetch['nomeStatus']) ?></th>
            <td class=""><?= ucfirst($Fetch['descricao']) ?></td>
          </tr>
          <?php
        }
        $BFetchStatus->closeCursor();
        ?>
      </tbody>
    </table>
    <input name="objeto" id="objeto" type="hidden" value="<?= $link ?>"/>
  </div>

  <?php
} else {
  echo "<h1 style='color:#f00;'>REDIRECIONAR PARA INDEX</h1>";
}
?>

