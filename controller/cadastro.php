<?php
//require_once("../include/variaveis.php");
//require_once("../class/classcrud.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();

if (isset($_POST['acao'])) {
  $acao = $_POST['acao'];
} elseif (isset($_GET['acao'])) {
  $acao = $_GET['acao'];
} else {
  echo "<h1 style='color:#f00;'>REDIRECIONAR PARA INDEX</h1>";
}


if ($acao == "luta") {
  $evento = $_POST['evento'];
  $desafiante = $_POST['desafiante'];
  $desafiado = $_POST['desafiado'];
  $categoria = $_POST['categoria'];
  $rounds = $_POST['rounds'];

  if ($operacao == 'visualizar' || $rounds == 3 || $rounds == 5) {

    //SE LUTADOR IGUAL
    if ((isset($desafiado) && isset($desafiante) && $desafiado != $desafiante) || $operacao == "visualizar") {
      ////BUSCA LIMITES DE PESO DA CATEGORIA
      //$BFetchCategorias=$Crud->selectDB("*","categoria","where id=?",array($categoria));
      //$FetchCategorias=$BFetchCategorias->fetch(PDO::FETCH_ASSOC);
      //$pesoMinPerm = $FetchCategorias['pesoMinimo'];
      //$pesoMaxPerm = $FetchCategorias['pesoMaximo'];

      ////BUSCA PESO DO DESAFIADO
      //$PesoDesafiado=$Crud->selectDB("nome, sobrenome, peso","pessoa","where id=?",array($desafiado));
      //$FetchPesoDesafiado=$PesoDesafiado->fetch(PDO::FETCH_ASSOC);

      ////BUSCA PESO DO DESAFIANTE
      //$PesoDesafiante=$Crud->selectDB("nome, sobrenome, peso","pessoa","where id=?",array($desafiante));
      //$FetchPesoDesafiante=$PesoDesafiante->fetch(PDO::FETCH_ASSOC);

      $BuscaPesoDesafiado = $Crud->selectSPR("call spr_validaPeso(?,?)", array($categoria, $desafiado));
      $ValidaPesoDesafiado = $BuscaPesoDesafiado->fetch(PDO::FETCH_ASSOC);
      $DesafiadoValidado = $ValidaPesoDesafiado['validacao'];
      $DesafiadoNome = $ValidaPesoDesafiado['nome'];
      $DesafiadoSobrenome = $ValidaPesoDesafiado['sobrenome'];
      $BuscaPesoDesafiado->closeCursor();

      $BuscaPesoDesafiante = $Crud->selectSPR("call spr_validaPeso(?,?)", array($categoria, $desafiante));
      $ValidaPesoDesafiante = $BuscaPesoDesafiante->fetch(PDO::FETCH_ASSOC);
      $DesafianteValidado = $ValidaPesoDesafiante['validacao'];
      $DesafianteNome = $ValidaPesoDesafiante['nome'];
      $DesafianteSobrenome = $ValidaPesoDesafiante['sobrenome'];
      $BuscaPesoDesafiante->closeCursor();

      //VERIFICA��O DE PESO DOS LUTADORES
      //if($FetchPesoDesafiado['peso'] < $pesoMinPerm || $FetchPesoDesafiado['peso'] > $pesoMaxPerm){
      if ($DesafiadoValidado == 0) {
        //SE DESAFIANTE TAMB�M EST� FORA DO PESO DA CATEGORIA
        //if($FetchPesoDesafiante['peso'] < $pesoMinPerm || $FetchPesoDesafiante['peso'] > $pesoMaxPerm){
        if ($DesafianteValidado == 0) {
          $motivo = "Tanto o desafiante " . $DesafianteNome . " " . $DesafianteSobrenome . ", como o desafiado " . $DesafiadoNome . " " . $DesafiadoSobrenome . ",<br />est�o fora do limite de peso desta categoria.";
          $nomeStatus = "N�o aprovada !!!";
        } else {
          $motivo = "O lutador " . $DesafiadoNome . " " . $DesafiadoSobrenome . ", est� fora do limite de peso desta categoria.";
          $nomeStatus = "N�o aprovada !!!";
        }
      } else {
        //SE DESAFIANTE EST� DENTRO DO PESO DA CATEGORIA
        //if($FetchPesoDesafiante['peso'] < $pesoMinPerm || $FetchPesoDesafiante['peso'] > $pesoMaxPerm){
        if ($DesafianteValidado == 0) {
          $motivo = "O lutador " . $DesafianteNome . " " . $DesafianteSobrenome . ", est� fora do limite de peso desta categoria.";
          $nomeStatus = "N�o aprovada !!!";
        } else {


          //LUTADORES DENTRO DO PESO
          //CADASTRAR
          if ($operacao != "editar" && $operacao != "visualizar") {
            //call spr_insertLuta(18,1,3,41,42);
            $BFetch = $Crud->insertSPR("call spr_insertLuta(?,?,?,?,?)", array($evento, $categoria, $rounds, $desafiado, $desafiante));
            $error = $BFetch->errorInfo();
            $errorMsg = $error['2'];

            $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
            $StatusOperacao = $Fetch['statusOperacao'];
            if (isset($errorMsg)) {
              $nomeStatus = "N�o aprovada !!!";
              $motivo = $errorMsg;
            } else {
              $Id = $Fetch['idLuta'];
              if ($StatusOperacao == 0) {
                $nomeStatus = "N�o aprovada !!!";
                $motivo = $Fetch['Msg'];
              }
            }
            $BFetch->closeCursor();
            //// Selecionar op��o de luta APROVADA
            //$BFetchStatus = $Crud->selectDB("id","status","where nomeStatus=?",array("aprovada"));
            //$status=$BFetchStatus->fetch(PDO::FETCH_ASSOC)['id'];

            //// Cadastrar luta no DB
            //$BFetch=$Crud->insertDB("luta","?,?,?,?,?,?,?,?",array(0,$status,$evento,$desafiante,$desafiado,$categoria,$rounds,null));

            //$Id = $Crud->getLastInsertID();
          } //ATUALIZAR
          elseif ($operacao == "editar") {   //  $operacao == "editar"
            $status = $_POST['status'];

            // Atualizar luta no DB
            //$BFetch=$Crud->updateDB("luta","status=?,evento=?,desafiante=?,desafiado=?,categoria=?,rounds=?","id = ?",
            //    array($status,$evento,$desafiante,$desafiado,$categoria,$rounds,$Id));

            //IN id int(11),
            //IN idStatus tinyint(2),
            //IN idEvento int(11),
            //IN idCategoria int(11),
            //IN rounds tinyint(1),
            //IN desafiado int(11),
            //IN desafiante int(11))
            $BFetchUpdate = $Crud->updateSPR("call spr_updateLuta(?,?,?,?,?,?,?)", array($Id, $status, $evento, $categoria, $rounds, $desafiado, $desafiante));
            $error = $BFetchUpdate->errorInfo();
            $errorMsg = $error['2'];

            $FetchUpdate = $BFetchUpdate->fetch(PDO::FETCH_ASSOC);
            $StatusOperacao = $FetchUpdate['statusOperacao'];

            if (isset($errorMsg)) {
              $motivo = $errorMsg;
              $nomeStatus = "n�o alterada";
            } elseif ($StatusOperacao == 0) {
              $motivo = $FetchUpdate['Msg'];
              $nomeStatus = "n�o alterada";
            }
            $BFetchUpdate->closeCursor();
          }

          if ($StatusOperacao > 0) {
            $BFetchInfos = $Crud->getDadosLuta($Id, 0, 0);
            $FetchInfos = $BFetchInfos->fetch(PDO::FETCH_ASSOC);
            //$FetchInfos=$BFetchInfos[0]->fetch(PDO::FETCH_ASSOC);

            //$FetchDesafiante=$BFetchInfos[1]->fetch(PDO::FETCH_ASSOC);
            //$FetchDesafiado=$BFetchInfos[2]->fetch(PDO::FETCH_ASSOC);

            //$FetchVencedor=$BFetchInfos[3]->fetch(PDO::FETCH_ASSOC);

            //if($BFetchInfos->rowCount() == 0){
            //    $motivo = "N�o foi poss�vel agendar esta luta.";
            //    $nomeStatus="Cadastro n�o realizado";
            //}

            if ($BFetchInfos->rowCount() > 0) {
              $statusLuta = $FetchInfos['aprovadoStatus'];
              $nomeStatus = strtolower($FetchInfos['nomeStatus']);
            }
          }
        }
      }
    } else {
      $motivo = "O mesmo lutador foi selecionado duas vezes.";
      $nomeStatus = "N�o aprovada !!!";
    }
  }

  else {
    $motivo = "Informe se a luta ser� de 3 ou de 5 rounds";
    $nomeStatus = "N�o aprovada !!!";
  }

  $idEvento = $FetchInfos['id'];
  $nomeEvento = $FetchInfos['nomeEvento'];
  $data = date("d/m/Y", strtotime($FetchInfos['data']));
  $hora = date("H:i", strtotime($FetchInfos['data']));
  $nomeCategoria = $FetchInfos['categoria'];

  $desafianteId = $FetchInfos['idDesafiante'];
  $desafianteNome = $FetchInfos['nomeDesafiante'];
  $desafianteSobrenome = $FetchInfos['sobrenomeDesafiante'];
  $desafianteFoto = strtolower($desafianteNome . "-" . $desafianteSobrenome);
  $desafianteApelido = $FetchInfos['apelidoDesafiante'];
  $desafianteApresentacao = $FetchInfos['apresentacaoDesafiante'];
  $desafiantePais = $FetchInfos['paisDesafiante'];
  $desafianteIdade = $Crud->getIdade($FetchInfos['nascDesafiante']);
  $desafianteAltura = $FetchInfos['alturaDesafiante'];
  $desafiantePeso = $FetchInfos['pesoDesafiante'];
  $desafianteVitorias = $FetchInfos['vitDesafiante'];
  $desafianteDerrotas = $FetchInfos['derDesafiante'];
  $desafianteEmpates = $FetchInfos['empDesafiante'];

  $desafiadoId = $FetchInfos['idDesafiado'];
  $desafiadoNome = $FetchInfos['nomeDesafiado'];
  $desafiadoSobrenome = $FetchInfos['sobrenomeDesafiado'];
  $desafiadoFoto = strtolower($desafiadoNome . "-" . $desafiadoSobrenome);
  $desafiadoApelido = $FetchInfos['apelidoDesafiado'];
  $desafiadoApresentacao = $FetchInfos['apresentacaoDesafiado'];
  $desafiadoPais = $FetchInfos['paisDesafiado'];
  $desafiadoIdade = $Crud->getIdade($FetchInfos['nascDesafiado']);
  $desafiadoAltura = $FetchInfos['alturaDesafiado'];
  $desafiadoPeso = $FetchInfos['pesoDesafiado'];
  $desafiadoVitorias = $FetchInfos['vitDesafiado'];
  $desafiadoDerrotas = $FetchInfos['derDesafiado'];
  $desafiadoEmpates = $FetchInfos['empDesafiado'];


  $idVencedor = $FetchInfos['resultado'];
  if ($idVencedor != "") {
    //$BFetchVencedor = $Crud->getDadosVencedor($idVencedor);
    //$FetchVencedor = $BFetchVencedor->fetch(PDO::FETCH_ASSOC);

    if ($idVencedor == $desafianteId) {
      $nomeVencedor = $desafianteNome;
      $sobrenomeVencedor = $desafianteSobrenome;
      $apelidoVencedor = $desafianteApelido;
    } else {
      $nomeVencedor = $desafiadoNome;
      $sobrenomeVencedor = $desafiadoSobrenome;
      $apelidoVencedor = $desafiadoApelido;
    }
  }
  if (isset($BFetchInfos)) {
    $BFetchInfos->closecursor();
  }

  //require_once("include/modalLuta.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/modalLuta.php");
}

elseif ($acao == "lutador") {
  $nome = $_POST['nome'];
  $sobrenome = $_POST['sobrenome'];
  $apelido = $_POST['apelido'];
  $nacionalidade = $_POST['nacionalidade'];
  $nacionalidade = explode('-', $nacionalidade);
  $nascimento = date("Y-m-d", strtotime($_POST['nascimento']));
  $altura = $_POST['altura'];
  $peso = $_POST['peso'];
  if ($_POST['apresentacao'] != "") {
    $apresentacao = $_POST['apresentacao'];
  } else {
    $apresentacao = $nome . " " . $sobrenome;
  }


  if ($Crud->getIdade($nascimento) < 18) {
    echo "Somente maiores de 18 anos";

  } else {

    if (is_numeric($altura) && is_numeric($peso)) {
      if (isset($_POST['operacao']) && $_POST['operacao'] == "editar") {
        ////Seleciona categorias dispon�veis
        //$BFetchCategorias=$Crud->selectDB("*","categoria","",array());
        //while($FetchCategorias=$BFetchCategorias->fetch(PDO::FETCH_ASSOC)){
        //    if($peso >= $FetchCategorias['pesoMinimo'] && $peso <= $FetchCategorias['pesoMaximo']){
        //        $categoria = $FetchCategorias['id'];
        //    }
        //}

        //Dentro dos limites de peso
        //if($categoria != 0){
        $BFetch = $Crud->updateSPR("call spr_updateLutador(?,?,?,?,?,?,?,?,?,?)",
          array($Id, $nome, $sobrenome, $apelido, $apresentacao, $nacionalidade[0], $nacionalidade[1], $nascimento, $altura, $peso));
        $error = $BFetch->errorInfo();
        $errorMsg = $error['2'];

        $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

        $BFetch->closeCursor();

        if (isset($errorMsg)) {
          echo $errorMsg;
        } else {
          //Atualiza��o de lutas que n�o se encaixa mais no peso permitido
          if ($Fetch['statusOperacao'] == 1 && $Fetch['mudouCategoria'] > 0) {
            /*N�O TO CONSEGUINDO IF COM ACENTUA�AO (== "n�o aprovada")*/
            //$BFetchStatusLutas = $Crud->selectSPR("call spr_getDadosStatus(?);",array(0));
            //while($FetchStatusLutas = $BFetchStatusLutas->fetch(PDO::FETCH_ASSOC)){
            //    $testando = $FetchStatusLutas['nomeStatus'];
            //    if($FetchStatusLutas['nomeStatus'] == 'aprovada'){
            //        $IdLutaAprovada = $FetchStatusLutas['id'];
            //    }
            //    elseif($testando == 'n�o aprovada'){
            //        if($FetchStatusLutas['descricao'] == 'O LUTADOR DESAFIADO PARA ESTA LUTA, EST� FORA DO LIMITE DE PESO DA CATEGORIA'){
            //            $IdLutaDesafiadoFora = $FetchStatusLutas['id'];
            //        }
            //        elseif($FetchStatusLutas['descricao'] == 'O LUTADOR DESAFIANTE DESTA LUTA, EST� FORA DO LIMITE DE PESO DA CATEGORIA'){
            //            $IdLutaDesafianteFora = $FetchStatusLutas['id'];
            //        }
            //        elseif($FetchStatusLutas['descricao'] == 'OS DOIS LUTADORES EST�O FORA DO LIMITE DE PESO DESTA CATEGORIA'){
            //            $IdLutaAmbosFora = $FetchStatusLutas['id'];
            //        }
            //    }
            //}
            //$BFetchStatusLutas->closeCursor();

            $AtualCategoria = $Fetch['categoriaAtual'];
            $IdLutaAprovada = '2';
            $IdLutaAmbosFora = '11';
            $IdLutaDesafiadoFora = '12';
            $IdLutaDesafianteFora = '13';

            $BFetchBuscaLutas = $Crud->selectSPR("call spr_getLutasLutador(?,?,?);", array($Id, 0, "aprovada"));
            $FetchBuscaLutas = $BFetchBuscaLutas->fetchall(PDO::FETCH_ASSOC);
            $BFetchBuscaLutas->closeCursor();

            foreach ($FetchBuscaLutas as $listarLutas) {
              $LutaId = $listarLutas['id'];
              $LutaIdStatus = $listarLutas['idStatus'];
              $LutaStatus = $listarLutas['nomeStatus'];
              $LutaDescStatus = $listarLutas['descricao'];


              $LutaCategoria = $listarLutas['categoria'];
              $LutaDesafiado = $listarLutas['desafiado'];

              if ($LutaIdStatus == $IdLutaAprovada) {
                if ($AtualCategoria != $LutaCategoria) {
                  if ($Id == $LutaDesafiado) {
                    //INSERIR QUE APENAS DESAFIADO EST� FORA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaDesafiadoFora, $LutaId));
                  } else {
                    //INSERIR QUE APENAS DESAFIANTE EST� FORA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaDesafianteFora, $LutaId));
                  }
                }
              } elseif ($LutaIdStatus == $IdLutaDesafianteFora) {
                if ($Id != $LutaDesafiado) {
                  if ($AtualCategoria == $LutaCategoria) {
                    //INSERIR QUE AGORA EST� APROVADA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaAprovada, $LutaId));
                  }
                } else {
                  if ($AtualCategoria != $LutaCategoria) {
                    //INSERIR QUE AMBOS EST�O FORA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaAmbosFora, $LutaId));
                  }
                }

              } elseif ($LutaIdStatus == $IdLutaDesafiadoFora) {
                if ($Id == $LutaDesafiado) {
                  if ($AtualCategoria == $LutaCategoria) {
                    //INSERIR QUE AGORA EST� APROVADA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaAprovada, $LutaId));
                  }
                } else {
                  if ($AtualCategoria != $LutaCategoria) {
                    //INSERIR QUE AMBOS EST�O FORA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaAmbosFora, $LutaId));
                  }
                }

              } elseif ($LutaIdStatus == $IdLutaAmbosFora) {
                if ($Id == $LutaDesafiado) {
                  if ($AtualCategoria == $LutaCategoria) {
                    //INSERIR QUE APENAS DESAFIANTE EST� FORA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaDesafianteFora, $LutaId));
                  }
                } else {
                  if ($AtualCategoria == $LutaCategoria) {
                    //INSERIR QUE APENAS DESAFIADO EST� FORA
                    $Crud->updateDB("luta", "status = ?", "id = ?", array($IdLutaDesafiadoFora, $LutaId));
                  }
                }

              }

              //else{
              //    echo "ERRO DESCONHECIDO";
              //}
            }
          }
          echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
        //$BFetch=$Crud->updateDB("pessoa","nome=?,sobrenome=?,apelido=?,nacionalidade=?,nascimento=?,altura=?,peso=?","id = ?",
        //    array($nome,$sobrenome,$apelido,$nacionalidade,$nascimento,$altura,$peso,$Id));
        //$BFetch->errorInfo();
        //$BFetchL=$Crud->updateDB("lutador","apresentacao=?,categoria=?","id_pessoa = ?",
        //    array($apresentacao,$categoria,$Id));
        //$BFetchL->errorInfo();

        //if($BFetch->rowCount() > 0 || $BFetchL->rowCount() > 0){
        //    echo"Altera��o realizada com sucesso";
        //}else{
        //    echo"Altera��o n�o realizada";
        //}
        //}

        //Fora dos limites de peso
        //else{
        //    echo "N�o se encaixa em nenhuma categoria dispon�vel";
        //}

      }

      else {
        ////Seleciona categorias dispon�veis
        //$BFetchCategorias=$Crud->selectDB("*","categoria","",array());
        //while($FetchCategorias=$BFetchCategorias->fetch(PDO::FETCH_ASSOC)){
        //    if($peso >= $FetchCategorias['pesoMinimo'] && $peso <= $FetchCategorias['pesoMaximo']){
        //        $categoria = $FetchCategorias['id'];
        //    }
        //}

        ////Dentro dos limites de peso
        //if($categoria != 0){
        //$BFetchPessoa=$Crud->insertDB("pessoa","?,?,?,?,?,?,?,?",array(0,$nome,$sobrenome,$apelido,$nacionalidade,$nascimento,$altura,$peso));
        ////INSERT INTO `pessoa` (`id`, `nome`, `sobrenome`, `apelido`, `nacionalidade`, `nascimento`, `altura`, `peso`) VALUES (NULL, 'Rafael', 'Rodrigues', 'Rafa', '1', '1992-02-07', '1.81', '78.8')


        //$Id = $Crud->getLastInsertID();


        //$BFetchLutador=$Crud->insertDB("lutador","?,?,?,?,?,?,?",array(0,$Id,$apresentacao,$categoria,0,0,0));
        ////INSERT INTO `lutador` (`id`, `id_pessoa`, `apresentacao`, `categoria`, `vitorias`, `derrotas`, `empates`) VALUES (NULL, '1', 'The Pitbull', '1', NULL, NULL, NULL)

        //call spr_insertLutador('Nome','Sobrenome','Nominho','Apresenta��aaaaao',14,'1992-02-07',1.99,149.49);
        $BFetch = $Crud->insertSPR("call spr_insertLutador(?,?,?,?,?,?,?,?,?)", array($nome, $sobrenome, $apelido, $apresentacao, $nacionalidade[0], $nacionalidade[1], $nascimento, $altura, $peso));
        $error = $BFetch->errorInfo();
        $errorMsg = $error['2'];

        $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

        if (isset($errorMsg)) {
          echo $errorMsg;
        } else {
          echo $Fetch['Msg'];
        }
        //if($BFetchLutador->rowCount() > 0){
        //    echo"Cadastro realizado com sucesso";
        //}else{
        //    echo"Cadastro n�o realizado";
        //}
        //}

        ////Fora dos limites de peso
        //else{
        //    echo "N�o se encaixa em nenhuma categoria dispon�vel";
        //}
      }
    } else {
      if (is_numeric($altura)) {
        echo "Informe o peso em quilos. <br />Exemplo: 99.9";
      } else {
        echo "Informe a altura em cent�metros. <br />Exemplo: 199";
      }
    }
  }

}

elseif ($acao == "evento") {
  $nome = $_POST['nome'];
  $local = $_POST['local'];
  $datahora = $_POST['data'] . ' ' . $_POST['hora'];

  if ($operacao == "editar") {
    $local = explode('-', $local);
    $status = $_POST['status'];

    $BFetch = $Crud->updateSPR("call spr_updateEvento(?,?,?,?,?,?)", array($Id, $status, $nome, $local[0], $local[1], $datahora));
    $error = $BFetch->errorInfo();
    $errorMsg = $error['2'];

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

    if (isset($errorMsg)) {
      echo $errorMsg;
    } else {
      echo $Fetch['Msg'];
    }
    $BFetch->closecursor();
    //$BFetch=$Crud->updateDB("evento","status=?,nome=?,local=?,data=?","id = ?",array($status,$nome,$local,$datahora,$Id));

    //if($BFetch->rowCount() > 0){
    //    echo"Altera��o realizada com sucesso";
    //}else{
    //    echo"Altera��o n�o realizada";
    //}
  }
  else {
    $local = explode('-', $local);
    $BFetch = $Crud->insertSPR("call spr_insertEvento(?,?,?,?)", array($nome, $local[0], $local[1], $datahora));
    $error = $BFetch->errorInfo();
    $errorMsg = $error['2'];

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

    if (isset($errorMsg)) {
      echo $errorMsg;
    } else {
      echo $Fetch['Msg'];
    }
    //$status = 2;    //Aprovado (ao ser criado)
    //$BFetch=$Crud->insertDB("evento","?,?,?,?,?",array(0,$status,$nome,$local,$datahora));
    ////INSERT INTO `evento` (`id`, `status`, `nome`, `local`, `data`) VALUES (NULL, '2', 'UEC 003', '2', '2019-02-23 21:00:00')

    //if($BFetch->rowCount() > 0){
    //    echo"Cadastro realizado com sucesso";
    //}else{
    //    echo"Cadastro n�o realizado";
    //}
  }
}

elseif ($acao == "categoria") {
  $nome = $_POST['nome'];
  $pesoMinimo = $_POST['pesoMin'];
  $pesoMaximo = $_POST['pesoMax'];

  if (is_numeric($pesoMinimo) && is_numeric($pesoMaximo) && $pesoMinimo < $pesoMaximo) {

    //VERIFICA SE A FAIXA DE PESO INFORMADA EST� LIVRE PARA SE CRIAR UMA NOVA CATEGORIA
    //SEM QUE HAJA CONFLITO NO LIMITE DE PESOS
    $validaCategoria = true;
    $BFetchValidaCategoria = $Crud->getDadosCategoria(0);
    while ($FetchValidaCategoria = $BFetchValidaCategoria->fetch(PDO::FETCH_ASSOC)) {
      if ($Id != $FetchValidaCategoria['id']) {
        if ($pesoMinimo >= $FetchValidaCategoria['pesoMinimo'] && $pesoMinimo <= $FetchValidaCategoria['pesoMaximo']) {
          $validaCategoria = false;
          $MsgValidaCategoria = "Erro:<br />O peso m�nimo informado, j� est� dentro de outra categoria";
          break;
        } else {
          if ($pesoMaximo >= $FetchValidaCategoria['pesoMinimo'] && $pesoMaximo <= $FetchValidaCategoria['pesoMaximo']) {
            $validaCategoria = false;
            $MsgValidaCategoria = "Erro:<br />O peso m�ximo informado, j� est� dentro de outra categoria";
            break;
          }
        }
      }
    }
    $BFetchValidaCategoria->closeCursor();

    //CATEGORIA PERMITIDA (SEM CONFLITO NOS LIMITES DE PESO)
    if ($validaCategoria) {
      if ($_POST['operacao'] == "editar") {
        $BFetch = $Crud->updateSPR("call spr_updateCategoria(?,?,?,?)", array($Id, $nome, $pesoMinimo, $pesoMaximo));
        $error = $BFetch->errorInfo();
        $errorMsg = $error['2'];

        $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

        if (isset($errorMsg)) {
          echo $errorMsg;
        } else {
          echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
        //$BFetch=$Crud->updateDB("categoria","nome=?,pesoMinimo=?,pesoMaximo=?","id = ?",array($nome,$pesoMinimo,$pesoMaximo,$Id));

        //if($BFetch->rowCount() > 0){
        //    echo"Altera��o realizada com sucesso";
        //}else{
        //    echo"Altera��o n�o realizada";
        //}
      } else {
        $BFetch = $Crud->insertSPR("call spr_insertCategoria(?,?,?)", array($nome, $pesoMinimo, $pesoMaximo));
        $error = $BFetch->errorInfo();
        $errorMsg = $error['2'];

        $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

        if (isset($errorMsg)) {
          echo $errorMsg;
        } else {
          echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
        //$BFetch=$Crud->insertDB("categoria","?,?,?,?",array(0,$nome,$pesoMinimo,$pesoMaximo));

        //if($BFetch->rowCount() > 0){
        //    echo"Cadastro realizado com sucesso";
        //}else{
        //    echo"Cadastro n�o realizado";
        //}
      }


    } //CATEGORIA INDEFERIDA (CONFLITO NOS LIMITES DE PESO)
    else {
      echo $MsgValidaCategoria;
    }

  } else {
    if (!is_numeric($pesoMinimo)) {
      echo "Informe o peso m�nimo para a categoria em quilos. <br />Exemplo: 99.99";
    } elseif (!is_numeric($pesoMaximo)) {
      echo "Informe o peso m�ximo para a categoria em quilos. <br />Exemplo: 99.99";
    } else {
      echo "O peso m�ximo deve ser maior que o peso m�nimo";
    }
  }
}

elseif ($acao == "paises") {
  $nome = $_POST['nome'];
  $abreviatura = strtoupper($_POST['abreviatura']);

  if ($_POST['operacao'] == "editar") {
    $BFetch = $Crud->updateSPR("call spr_updatePaises(?,?,?)", array($Id, $nome, $abreviatura));
    $error = $BFetch->errorInfo();
    $errorMsg = $error['2'];

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

    if (isset($errorMsg)) {
      echo $errorMsg;
    } else {
      echo $Fetch['Msg'];
    }
    $BFetch->closecursor();
    //$BFetch=$Crud->updateDB("paises","nome=?,abreviatura=?","id = ?",array($nome,$abreviatura,$Id));

    //if($BFetch->rowCount() > 0){
    //    echo"Altera��o realizada com sucesso";
    //}else{
    //    echo"Altera��o n�o realizada";
    //}
  } else {
    $BFetch = $Crud->insertSPR("call spr_insertPaises(?,?)", array($nome, $abreviatura));
    $error = $BFetch->errorInfo();
    $errorMsg = $error['2'];

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

    if (isset($errorMsg)) {
      echo $errorMsg;
    } else {
      echo $Fetch['Msg'];
    }
    $BFetch->closecursor();
    //$BFetch=$Crud->insertDB("paises","?,?,?",array(0,$nome,$abreviatura));
    ////INSERT INTO `paises` (`id`, `nome`, `abreviatura`) VALUES (NULL, 'Brasil', 'BR')

    //if($BFetch->rowCount() > 0){
    //    echo"Cadastro realizado com sucesso";
    //}else{
    //    echo"Cadastro n�o realizado";
    //}
  }
}

elseif ($acao == "status") {
  $permissao = isset($_POST['permissao'])?$_POST['permissao']:null;     //0=nao (false)
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];

  if (isset($_POST['operacao']) && $_POST['operacao'] == "editar") {
    //$BFetch=$Crud->insertDB("status","?,?,?,?",array(0,$permissao,$nome,$descricao));
    $BFetch = $Crud->updateSPR("call spr_updateStatus(?,?,?,?)", array($Id, $permissao, $nome, $descricao));
    $error = $BFetch->errorInfo();
    $errorMsg = $error['2'];

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

    if (isset($errorMsg)) {
      echo $errorMsg;
    } else {
      echo $Fetch['Msg'];
    }
    $BFetch->closecursor();
    //$BFetch=$Crud->updateDB("status","status=?,nomeStatus=?,descricao=?","id = ?",array($permissao,$nome,$descricao,$Id));
    ////UPDATE `status` SET `status` = '1', `nomeStatus` = 'n�o aprovadaa', `descricao` = 'Por motivos X, luta n�o foi aprovada' WHERE `status`.`id` = 6

    //if($BFetch->rowCount() > 0){
    //    echo"Alteração realizada com sucesso";
    //}else{
    //    echo"Alteração não realizada";
    //}
  } else {
    //$BFetch=$Crud->insertDB("status","?,?,?,?",array(0,$permissao,$nome,$descricao));
    $BFetch = $Crud->insertSPR("call spr_insertStatus(?,?)", array($nome, $descricao));
    $error = $BFetch->errorInfo();
    $errorMsg = $error['2'];

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);

    if (isset($errorMsg)) {
      echo $errorMsg;
    } else {
      echo $Fetch['Msg'];
    }
    $BFetch->closecursor();
  }

}

else {
  echo "A��o n�o informada";
}
?>
