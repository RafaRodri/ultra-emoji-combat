<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();


// Cadastrar Lutador
if ($link == "lutador") {
  if ($operacao == "editar") {  //update de cadastro
    $BFetchLutador = $Crud->getDadosLutador($Id);
    $FetchLutador = $BFetchLutador->fetch(PDO::FETCH_ASSOC);
    $BFetchLutador->closeCursor();
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNome">Nome</label>
        <input name="nome" type="text" class="form-control" id="inputNome" value="<?= $FetchLutador['nome'] ?>"
               required="required"/>
      </div>
      <div class="form-group col-md-4">
        <label for="inputSobrenome">Sobrenome</label>
        <input name="sobrenome" type="text" class="form-control" id="inputSobrenome"
               value="<?= $FetchLutador['sobrenome'] ?>" required="required"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputApelido">Apelido</label>
        <input name="apelido" type="text" class="form-control" value="<?= $FetchLutador['apelido'] ?>"
               id="inputApelido"/>
      </div>
      <div class="form-group col-md-4">
        <label for="inputApresentacao">Nome de Apresentação</label>
        <input name="apresentacao" type="text" class="form-control" value="<?= $FetchLutador['apresentacao'] ?>"
               id="inputApresentacao"/>
        <small class="form-text text-muted">Como o locutor anuncia.</small>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNacionalidade">Nacionalidade</label>
        <select name="nacionalidade" id="inputNacionalidade" class="form-control" required="required">
          <option value="">Países</option>
          <?php
          $BFetchLutadorPaises = $Crud->getDadosPaises();
          foreach ($BFetchLutadorPaises as $paises) {
            echo '<option value=' . $paises->id . '-' . $paises->alpha3Code . '>' . $paises->nome . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputNascimento">Data de Nascimento</label>
        <input name="nascimento" type="date" class="form-control" id="inputNascimento"
               value="<?= (isset($FetchLutador['nascimento']) ? date("Y-m-d", strtotime($FetchLutador['nascimento'])) : "") ?>"
               required="required"/>
      </div>
    </div>

    <!--<div class="form-row justify-content-md-center">
    <div class="form-group col-1">
        <label for="inputAltura">Altura</label>
        <input name="altura" type="text" class="form-control" id="inputAltura" data-mask="999" value="<?= $FetchLutador['altura'] ?>" required="required" />
        <small id="alturaHelp" class="form-text text-muted">em centímetros</small>
    </div>
    <div class="form-group col-1">
        <label for="inputPeso">Peso</label>
        <input name="peso" type="text" class="form-control" id="inputPeso" data-mask="9?99.99" value="<?= $FetchLutador['peso'] ?>" required="required" />
        <small id="pesoHelp" class="form-text text-muted">em kg</small>
    </div>
</div>-->

    <div class="form-row justify-content-md-center mt-5">
      <div class="form-group d-none col-xl-block col-xl-1"></div>
      <div class="form-group col-md-3 col-xl-2">
        <div class="input-group">
          <input name="altura" type="text" class="form-control" id="inputAltura" value="<?= $FetchLutador['altura'] ?>"
                 pattern="[0-9]{1}\.[0-9]{2}" title="Exemplo.: 0.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">cm</span>
          </div>
        </div>
      </div>
      <div class="form-group col-md-3 col-xl-2">
        <div class="input-group">
          <input name="peso" type="text" class="form-control" id="inputPeso"
                 value="<?= number_format($FetchLutador['peso'], 2, '.', '') ?>"
                 pattern="[0-9]{2,3}\.[0-9]{2}" title="Exemplo.: 00.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">Kg</span>
          </div>
        </div>
      </div>
      <div class="form-group d-none col-md-block col-md-1 col-xl-2"></div>
    </div>
    <!--<div class="form-row">
        <div class="form-group col-4">
            <label for="inputVitorias">Vitórias</label>
            <input name="vitorias" type="text" class="form-control" id="Vitorias" data-mask="99" />
        </div>
        <div class="form-group col-4">
            <label for="inputDerrotas">Derrotas</label>
            <input name="derrotas" type="text" class="form-control" id="inputDerrotas" data-mask="99" />
        </div>
        <div class="form-group col-4">
            <label for="inputEmpates">Empates</label>
            <input name="empates" type="text" class="form-control" id="inputEmpates" data-mask="99" />
        </div>
    </div>-->
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <?php
        if ($BFetchLutador->rowCount() > 0) {
          ?>
          <input id="operacao" name="operacao" type="hidden" value="editar"/>
          <?php
        }
        ?>
        <input name="id" type="hidden" value="<?= $FetchLutador['id'] ?>"/>
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary">Cadastrar Lutador</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
      </div>
    </div>

    <?php
  }
  else {  //novo cadastro
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNome">Nome</label>
        <input name="nome" type="text" class="form-control" id="inputNome" required="required"/>
      </div>
      <div class="form-group col-md-4">
        <label for="inputSobrenome">Sobrenome</label>
        <input name="sobrenome" type="text" class="form-control" id="inputSobrenome" required="required"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputApelido">Apelido</label>
        <input name="apelido" type="text" class="form-control" id="inputApelido"/>
      </div>
      <div class="form-group col-md-4">
        <label for="inputApresentacao">Nome de Apresentação</label>
        <input name="apresentacao" type="text" class="form-control" id="inputApresentacao"/>
        <small class="form-text text-muted">Como o locutor anuncia.</small>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNacionalidade">Nacionalidade</label>
        <select name="nacionalidade" id="inputNacionalidade" class="form-control" required="required">
          <option value="">Países</option>
          <?php
          $BFetchLutadorPaises = $Crud->getDadosPaises();
          foreach ($BFetchLutadorPaises as $paises) {
            echo '<option value=' . $paises->id . '-' . $paises->alpha3Code . '>' . $paises->nome . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputNascimento">Data de Nascimento</label>
        <input name="nascimento" type="date" class="form-control" id="inputNascimento" required="required"/>
      </div>
    </div>

    <div class="form-row justify-content-md-center mt-5">
      <div class="form-group d-none col-xl-block col-xl-1"></div>
      <div class="form-group col-md-3 col-xl-2">
        <div class="input-group">
          <input name="altura" type="text" class="form-control" id="inputAltura"
                 pattern="[0-9]{1}\.[0-9]{2}" title="Exemplo.: 0.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">cm</span>
          </div>
        </div>
      </div>
      <div class="form-group col-md-3 col-xl-2">
        <div class="input-group">
          <input name="peso" type="text" class="form-control" id="inputPeso"
                 pattern="[0-9]{2,3}\.[0-9]{2}" title="Exemplo.: 00.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">Kg</span>
          </div>
        </div>
      </div>
      <div class="form-group d-none col-md-block col-md-1 col-xl-2"></div>
    </div>
    <!--<div class="form-row">
    <div class="form-group col-4">
    <label for="inputVitorias">Vitórias</label>
    <input name="vitorias" type="text" class="form-control" id="Vitorias" data-mask="99" />
    </div>
    <div class="form-group col-4">
    <label for="inputDerrotas">Derrotas</label>
    <input name="derrotas" type="text" class="form-control" id="inputDerrotas" data-mask="99" />
    </div>
    <div class="form-group col-4">
    <label for="inputEmpates">Empates</label>
    <input name="empates" type="text" class="form-control" id="inputEmpates" data-mask="99" />
    </div>
    </div>-->
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary">Cadastrar Lutador</button>
        <button type="reset" class="btn btn-primary">Limpar</button>
      </div>
    </div>
    <?php
  }
}

// Cadastrar Luta
elseif ($link == "luta") {
  if ($operacao == "editar") {  //update de cadastro
    $BFetchLuta = $Crud->getDadosLuta($Id, 0, 0);
    $FetchLuta = $BFetchLuta->fetch(PDO::FETCH_ASSOC);
    $BFetchLuta->closeCursor();
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4">
        <label for="inputEvento">Evento</label>
        <select name="evento" id="inputEvento" class="form-control" required="required">
          <option value="">Eventos</option>
          <?php
          $BFetchLutaEventos = $Crud->getDadosEvento(0);
          while ($FetchLutaEventos = $BFetchLutaEventos->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option
              value="<?= $FetchLutaEventos['id'] ?>" <?php echo ($FetchLuta['idEvento'] == $FetchLutaEventos['id']) ? "selected" : "" ?>><?= $FetchLutaEventos['nome'] ?></option>
            <?php
          }
          $BFetchLutaEventos->closeCursor();
          ?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="inputCategoria">Categoria</label>
        <select name="categoria" id="inputCategoria" class="form-control" required="required">
          <option value="">Categorias</option>
          <?php
          $BFetchLutaCategorias = $Crud->getDadosCategoria(0);
          while ($FetchLutaCategoria = $BFetchLutaCategorias->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option
              value="<?= $FetchLutaCategoria['id'] ?>" <?php echo ($FetchLuta['idCategoria'] == $FetchLutaCategoria['id']) ? "selected" : "" ?>><?= $FetchLutaCategoria['nome'] ?></option>
            <?php
          }
          $BFetchLutaCategorias->closeCursor();
          ?>
        </select>
      </div>
      <div class="form-group col-md-1">
        <label for="inputRound">Rounds</label>
        <input name="rounds" type="number" id="inputRound" min="1" max="5" step="2" value="<?= $FetchLuta['rounds'] ?>"
               class="form-control"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4">
        <label for="inputDesafiado">Desafiado</label>
        <select name="desafiado" id="inputDesafiado" class="form-control" required="required">
          <option value="">Lutadores</option>
          <?php
          $BFetchLutaDesafiado = $Crud->getDadosLutador(0);
          //$error = $BFetchLutaDesafiado->errorInfo();
          // Cannot execute queries while other unbuffered queries are active.  Consider using PDOStatement::fetchAll().
          //Alternatively, if your code is only ever going to run against mysql, you may enable query buffering by setting
          //the PDO::MYSQL_ATTR_USE_BUFFERED_QUERY attribute.
          while ($FetchLutaDesafiado = $BFetchLutaDesafiado->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option
              value="<?= $FetchLutaDesafiado['id'] ?>" <?php echo ($FetchLuta['idDesafiado'] == $FetchLutaDesafiado['id']) ? "selected" : "" ?>>
              <?= $FetchLutaDesafiado['nome'] ?>
              <?= ($FetchLutaDesafiado['apelido'] != "") ? '"' . $FetchLutaDesafiado['apelido'] . '"' : ""; ?>
              <?= $FetchLutaDesafiado['sobrenome'] ?>
            </option>
            <?php
          }
          $BFetchLutaDesafiado->closeCursor();
          ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputDesafiante">Desafiante</label>
        <select name="desafiante" id="inputDesafiante" class="form-control" required="required">
          <option value="">Lutadores</option>
          <?php
          $BFetchLutaDesafiante = $Crud->getDadosLutador(0);
          while ($FetchLutaDesafiante = $BFetchLutaDesafiante->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option
              value="<?= $FetchLutaDesafiante['id'] ?>" <?php echo ($FetchLuta['idDesafiante'] == $FetchLutaDesafiante['id']) ? "selected" : "" ?>>
              <?= $FetchLutaDesafiante['nome'] ?>
              <?= ($FetchLutaDesafiante['apelido'] != "") ? '"' . $FetchLutaDesafiante['apelido'] . '"' : ""; ?>
              <?= $FetchLutaDesafiante['sobrenome'] ?>
            </option>
            <?php
          }
          $BFetchLutaDesafiante->closeCursor();
          ?>
        </select>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <!--<div class="form-group col-md-3">
      <label for="inputData">Data</label>
      <input name="data" type="date" id="inputData" class="form-control" required="required" />
      </div>
      <div class="form-group col-md-2">
      <label for="inputHora">Horário</label>
      <input name="hora" type="time" id="inputHora" class="form-control" required="required" />
      </div>-->
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group col-md-6">
        <?php
        if ($BFetchLuta->rowCount() > 0){
        ?>
        <label for="inputStatusLuta">Status</label>
        <select name="status" id="inputStatusLuta" class="form-control" required="required">
          <?php
          $BFetchLutaStatus = $Crud->getDadosStatus(0);
          while ($FetchLutaStatus = $BFetchLutaStatus->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option
              value="<?= $FetchLutaStatus['id'] ?>" <?php echo ($FetchLuta['status'] == $FetchLutaStatus['id']) ? "selected" : "" ?>>
              <?= ucfirst($FetchLutaStatus['nomeStatus']) . strtolower($FetchLutaStatus['descricao'] != "" ? " - " . $FetchLutaStatus['descricao'] : "") ?>
            </option>
            <?php
          }
          $BFetchLutaStatus->closeCursor();
          ?>
          <input id="operacao" name="operacao" type="hidden" value="editar"/>
          <?php
          }
          ?>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input name="id" type="hidden" value="<?= $FetchLuta['id'] ?>"/>
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Marcar Luta</button>
      </div>
    </div>


    <?php
  } else {  //cadastro novo
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4">
        <label for="inputEvento">Evento</label>
        <select name="evento" id="inputEvento" class="form-control" required="required">
          <option value="">Eventos</option>
          <?php
          $BFetchLutaEventos = $Crud->getDadosEvento(0);
          while ($FetchLutaEventos = $BFetchLutaEventos->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?= $FetchLutaEventos['id'] ?>"><?= $FetchLutaEventos['nome'] ?></option>
            <?php
          }
          $BFetchLutaEventos->closeCursor();
          ?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="inputCategoria">Categoria</label>
        <select name="categoria" id="inputCategoria" class="form-control" required="required">
          <option value="">Categorias</option>
          <?php
          $BFetchLutaCategorias = $Crud->getDadosCategoria(0);
          while ($FetchLutaCategorias = $BFetchLutaCategorias->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?= $FetchLutaCategorias['id'] ?>"><?= $FetchLutaCategorias['nome'] ?></option>
            <?php
          }
          $BFetchLutaCategorias->closeCursor();
          ?>
        </select>
      </div>
      <div class="form-group col-md-1">
        <label for="inputRound">Rounds</label>
        <input name="rounds" type="number" id="inputRound" min="1" max="5" step="2" value="3" class="form-control"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4">
        <label for="inputDesafiado">Desafiado</label>
        <select name="desafiado" id="inputDesafiado" class="form-control" required="required">
          <option value="">Lutadores</option>
          <?php
          $BFetchLutaDesafiado = $Crud->getDadosLutador(0);
          while ($FetchLutaDesafiado = $BFetchLutaDesafiado->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?= $FetchLutaDesafiado['id'] ?>">
              <?= $FetchLutaDesafiado['nome'] ?>
              <?= ($FetchLutaDesafiado['apelido'] != "") ? '"' . $FetchLutaDesafiado['apelido'] . '"' : ""; ?>
              <?= $FetchLutaDesafiado['sobrenome'] ?>
            </option>
            <?php
          }
          $BFetchLutaDesafiado->closeCursor();
          ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputDesafiante">Desafiante</label>
        <select name="desafiante" id="inputDesafiante" class="form-control" required="required">
          <option value="">Lutadores</option>
          <?php
          $BFetchLutaDesafiante = $Crud->getDadosLutador(0);
          while ($FetchLutaDesafiante = $BFetchLutaDesafiante->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?= $FetchLutaDesafiante['id'] ?>">
              <?= $FetchLutaDesafiante['nome'] ?>
              <?= ($FetchLutaDesafiante['apelido'] != "") ? '"' . $FetchLutaDesafiante['apelido'] . '"' : ""; ?>
              <?= $FetchLutaDesafiante['sobrenome'] ?>
            </option>
            <?php
          }
          $BFetchLutaDesafiante->closeCursor();
          ?>
        </select>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <!--<div class="form-group col-md-3">
      <label for="inputData">Data</label>
      <input name="data" type="date" id="inputData" class="form-control" required="required" />
      </div>
      <div class="form-group col-md-2">
      <label for="inputHora">Horário</label>
      <input name="hora" type="time" id="inputHora" class="form-control" required="required" />
      </div>-->
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Marcar Luta</button>
      </div>
    </div>
    <?php
  }
}

// Cadastrar Evento
elseif ($link == "evento") {
  if ($operacao == "editar") {  //update de cadastro
    $BFetchEvento = $Crud->getDadosEvento($Id);
    $FetchEvento = $BFetchEvento->fetch(PDO::FETCH_ASSOC);
    $BFetchEvento->closeCursor();
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNomeEvento">Nome</label>
        <input name="nome" type="text" class="form-control" id="inputNomeEvento" required="required"
               value="<?= $FetchEvento['nome'] ?>"/>
      </div>
      <div class="form-group col-md-3">
        <label for="inputLocalEvento">Local</label>
        <select name="local" id="inputLocalEvento" class="form-control" required="required">
          <option value="">Países</option>
          <?php
          $BFetchEventoPaises = $Crud->getDadosPaises();
          foreach ($BFetchEventoPaises as $paises) {
            ?>
            <option
              value="<?php echo "$paises->id-$paises->alpha3Code" ?>" <?php echo ($FetchEvento['idLocal'] == $paises->id) ? "selected" : "" ?>><?= $paises->nome ?></option>
            <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputDataEvento">Data</label>
        <input name="data" type="date" id="inputDataEvento" class="form-control" required="required"
               value="<?= (isset($FetchEvento['data']) ? date("Y-m-d", strtotime($FetchEvento['data'])) : "") ?>"/>
      </div>
      <div class="form-group col-md-3">
        <label for="inputHoraEvento">Horário</label>
        <input name="hora" type="time" id="inputHoraEvento" class="form-control" required="required"
               value="<?= (isset($FetchEvento['data']) ? date("H:i", strtotime($FetchEvento['data'])) : "") ?>"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-6 text-left">
        <?php
        if ($BFetchEvento->rowCount() > 0){
        ?>
        <label for="inputStatusEvento">Status</label>
        <select name="status" id="inputStatusEvento" class="form-control" required="required">
          <?php
          $BFetchEventoStatus = $Crud->getDadosStatus(0);
          while ($FetchEventoStatus = $BFetchEventoStatus->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option
              value="<?= $FetchEventoStatus['id'] ?>" <?php echo ($FetchEvento['status'] == $FetchEventoStatus['id']) ? "selected" : "" ?>>
              <?= ucfirst($FetchEventoStatus['nomeStatus']) . strtolower($FetchEventoStatus['descricao'] != "" ? " - " . $FetchEventoStatus['descricao'] : "") ?>
            </option>
            <?php
          }
          $BFetchEventoStatus->closeCursor();
          ?>
          <input id="operacao" name="operacao" type="hidden" value="editar"/>
          <?php
          }
          ?>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4 text-left">
        <input name="id" type="hidden" value="<?= $FetchEvento['id'] ?>"/>
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Marcar Evento</button>
      </div>
    </div>
    <?php
  }
  else {  //cadastro novo
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNomeEvento">Nome</label>
        <input name="nome" type="text" class="form-control" id="inputNomeEvento" required="required"/>
      </div>
      <div class="form-group col-md-3">
        <label for="inputLocalEvento">Local</label>
        <select name="local" id="inputLocalEvento" class="form-control" required="required">
          <option value="">Países</option>
          <?php
          $BFetchEventoPaises = $Crud->getDadosPaises();
          foreach ($BFetchEventoPaises as $paises) {
            ?>
            <option value="<?php echo "$paises->id-$paises->alpha3Code" ?>"><?= $paises->nome ?></option>
            <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputDataEvento">Data</label>
        <input name="data" type="date" id="inputDataEvento" class="form-control" required="required"/>
      </div>
      <div class="form-group col-md-3">
        <label for="inputHoraEvento">Horário</label>
        <input name="hora" type="time" id="inputHoraEvento" class="form-control" required="required"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4 text-left">
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Marcar Evento</button>
      </div>
    </div>
    <?php
  }
}

// Cadastrar Categoria
elseif ($link == "categoria") {
  if ($operacao == "editar") {  //update de cadastro
    $BFetchCategorias = $Crud->getDadosCategoria($Id);
    $FetchCategorias = $BFetchCategorias->fetch(PDO::FETCH_ASSOC);
    $BFetchCategorias->closeCursor();
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4">
        <label for="inputNomeCategoria">Categoria</label>
        <input name="nome" type="text" class="form-control" id="inputNomeCategoria" required="required"
               value="<?= $FetchCategorias['nome'] ?>"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-2">
        <label for="inputPesoMin">Peso mínimo</label>
        <div class="input-group">
          <input name="pesoMin" type="text" class="form-control" id="inputPesoMin"
                 value="<?= number_format($FetchCategorias['pesoMinimo'], 2, '.', '') ?>"
                 pattern="[0-9]{2,3}\.[0-9]{2}" title="Exemplo.: 00.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">Kg</span>
          </div>
        </div>
      </div>
      <div class="form-group col-md-2">
        <label for="inputPesoMax">Peso máximo</label>
        <div class="input-group">
          <input name="pesoMax" type="text" class="form-control" id="inputPesoMax"
                 value="<?= number_format($FetchCategorias['pesoMaximo'], 2, '.', '') ?>"
                 pattern="[0-9]{2,3}\.[0-9]{2}" title="Exemplo.: 00.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">Kg</span>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input name="id" type="hidden" value="<?= $FetchCategorias['id'] ?>"/>
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <?php
        if ($BFetchCategorias->rowCount() > 0) {
          ?>
          <input id="operacao" name="operacao" type="hidden" value="editar"/>
          <?php
        }
        ?>
        <button type="submit" class="btn btn-primary w-100">Cadastrar Categoria</button>
      </div>
    </div>
    <?php
  } else {  //cadastro novo
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-4">
        <label for="inputNomeCategoria">Categoria</label>
        <input name="nome" type="text" class="form-control" id="inputNomeCategoria" required="required"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-2">
        <label for="inputPesoMin">Peso mínimo</label>
        <div class="input-group">
          <input name="pesoMin" type="text" class="form-control" id="inputPesoMin"
                 pattern="[0-9]{2,3}\.[0-9]{2}" title="Exemplo.: 00.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">Kg</span>
          </div>
        </div>
      </div>
      <div class="form-group col-md-2">
        <label for="inputPesoMax">Peso máximo</label>
        <div class="input-group">
          <input name="pesoMax" type="text" class="form-control" id="inputPesoMax"
                 pattern="[0-9]{2,3}\.[0-9]{2}" title="Exemplo.: 00.00" required="required"/>
          <div class="input-group-append">
            <span class="input-group-text">Kg</span>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Cadastrar Categoria</button>
      </div>
    </div>
    <?php
  }
}

// Cadastrar Paises
elseif ($link == "paises") {
  if ($operacao == "editar") {  //update de cadastro
    $BFetchPaises = $Crud->getDadosPaises($Id);
    $FetchPaises = $BFetchPaises->fetch(PDO::FETCH_ASSOC);
    $BFetchPaises->closeCursor();
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNomePais">
          País
        </label>
        <input name="nome" type="text" class="form-control" id="inputNomePais" required="required"
               value="<?= $FetchPaises['nome'] ?>"/>
      </div>
      <div class="form-group col-md-1">
        <label for="inputPaisAb">Abreviatura</label>
        <input name="abreviatura" type="text" class="form-control" id="inputPaisAb" pattern="[A-Z]{2}"
               title="Exemplo.: AZ"
               maxlength="2" required="required" value="<?= $FetchPaises['abreviatura'] ?>"/>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input name="id" type="hidden" value="<?= $FetchPaises['id'] ?>"/>
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <?php
        if ($BFetchPaises->rowCount() > 0) {
          ?>
          <input id="operacao" name="operacao" type="hidden" value="editar"/>
          <?php
        }
        ?>
        <button type="submit" class="btn btn-primary w-100">Cadastrar País</button>
      </div>
    </div>
    <?php
  } else {  //cadastro novo
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-3">
        <label for="inputNomePais">País</label>
        <input name="nome" type="text" class="form-control" id="inputNomePais" required="required"/>
      </div>
      <div class="form-group col-md-1">
        <label for="inputPaisAb">Abreviatura</label>
        <input name="abreviatura" type="text" class="form-control" id="inputPaisAb" pattern="[A-Z]{2}"
               title="Exemplo.: AZ"
               maxlength="2" required="required"/>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Cadastrar País</button>
      </div>
    </div>
    <?php
  }
}

// Cadastrar Status
elseif ($link == "status") {
  if ($operacao == "editar") {  //update de cadastro
    $BFetchStatus = $Crud->getDadosStatus($Id);
    $FetchStatus = $BFetchStatus->fetch(PDO::FETCH_ASSOC);
    $BFetchStatus->closeCursor();
    ?>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-2">
        <label for="inputPermissao">Permitida</label>
        <select name="permissao" id="inputPermissao" class="form-control">
          <?php
          $i = 0;
          while ($i <= 1) {
            if ($i == 0) {
              ?>
              <option value="0" <?= ($FetchStatus['status'] == $i ? "selected" : "") ?>>Não</option>
              <?php
            } else {
              ?>
              <option value="1" <?= ($FetchStatus['status'] == $i ? "selected" : "") ?>>Sim</option>
              <?php
            }
            $i++;
          }
          ?>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputNomeStatus">Nome do status</label>
        <input name="nome" type="text" class="form-control" id="inputNomeStatus" required="required"
               value="<?= $FetchStatus['nomeStatus'] ?>"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputDescStatus">Descrição</label>
        <textarea name="descricao" class="form-control" id="inputDescStatus"><?= $FetchStatus['descricao'] ?></textarea>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input name="id" type="hidden" value="<?= $FetchStatus['id'] ?>"/>
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <?php
        if ($BFetchStatus->rowCount() > 0) {
          ?>
          <input id="operacao" name="operacao" type="hidden" value="editar"/>
          <?php
        }
        ?>
        <button type="submit" class="btn btn-primary w-100">Cadastrar Status</button>
      </div>
    </div>
    <?php
  } else {  //cadastro novo
    ?>
    <div class="form-row justify-content-md-center">
      <!--<div class="form-group col-md-2">
<label for="inputPermissao">Permitida</label>
<select name="permissao" id="inputPermissao" class="form-control">
    <?php
      $i = 0;
      while ($i <= 1) {
        if ($i == 0) {
          ?>
    <option value="0">Não</option>
    <?php
        } else {
          ?>
    <option value="1" selected>Sim</option>
    <?php
        }
        $i++;
      }
      ?>
</select>
</div>-->
      <div class="form-group col-md-6">
        <label for="inputNomeStatus">Nome do status</label>
        <input name="nome" type="text" class="form-control" id="inputNomeStatus" required="required"/>
      </div>
    </div>
    <div class="form-row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputDescStatus">Descrição</label>
        <textarea name="descricao" class="form-control" id="inputDescStatus"></textarea>
      </div>
    </div>
    <div class="form-row justify-content-center text-center">
      <div class="form-group">
        <input id="objeto" name="objeto" type="hidden" value="<?= $link ?>"/>
        <button type="submit" class="btn btn-primary w-100">Cadastrar Status</button>
      </div>
    </div>


    <?php
  }
} else {
  echo "<h1 style='color:#f00;'>REDIRECIONAR PARA INDEX</h1>";
}
?>
