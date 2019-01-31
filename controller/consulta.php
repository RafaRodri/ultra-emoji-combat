<?php
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

  $BFetchInfos = $Crud->getDadosLuta($Id, 0, 0);
  $FetchInfos = $BFetchInfos->fetch(PDO::FETCH_ASSOC);

  if ($BFetchInfos->rowCount() > 0) {
    $statusLuta = $FetchInfos['aprovadoStatus'];
    $nomeStatus = $FetchInfos['nomeStatus'];
    $descricao = $FetchInfos['descricao'];
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

  require_once("include/modal-luta.php");
} /*
elseif($acao == "lutador"){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $apelido = $_POST['apelido'];
    $nacionalidade = $_POST['nacionalidade'];
    $nascimento = date("Y-m-d", strtotime($_POST['nascimento']));
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    if($_POST['apresentacao'] != ""){
        $apresentacao=$_POST['apresentacao'];
    }else{
        $apresentacao=$nome." ".$sobrenome;
    }


    if($Crud->getIdade($nascimento) < 18){
        echo"Somente maiores de 18 anos";

    }else{

        if(is_numeric ($altura) && is_numeric ($peso)) {
            if($_POST['operacao'] == "editar"){
                //Seleciona categorias dispon�veis
                $BFetchCategorias=$Crud->selectDB("*","categoria","",array());
                while($FetchCategorias=$BFetchCategorias->fetch(PDO::FETCH_ASSOC)){
                    if($peso >= $FetchCategorias['pesoMinimo'] && $peso <= $FetchCategorias['pesoMaximo']){
                        $categoria = $FetchCategorias['id'];
                    }
                }

                //Dentro dos limites de peso
                if($categoria != 0){
                    $BFetch=$Crud->updateSPR("call spr_updateLutador(?,?,?,?,?,?,?,?,?)",
                        array($Id,$nome,$sobrenome,$apelido,$apresentacao,$nacionalidade,$nascimento,$altura,$peso));
                    $error = $BFetch->errorInfo();
                    $errorMsg=$error['2'];

                    $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

                    if(isset($errorMsg)){
                        echo $errorMsg;
                    }else{
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
                }

                //Fora dos limites de peso
                else{
                    echo "N�o se encaixa em nenhuma categoria dispon�vel";
                }

            }
            else{
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
                $BFetch=$Crud->insertSPR("call spr_insertLutador(?,?,?,?,?,?,?,?)",array($nome,$sobrenome,$apelido,$apresentacao,$nacionalidade,$nascimento,$altura,$peso));
                $error = $BFetch->errorInfo();
                $errorMsg=$error['2'];

                $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

                if(isset($errorMsg)){
                    echo $errorMsg;
                }else{
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
        }
        else {
            if(is_numeric ($altura)) {
                echo "Informe o peso em quilos. <br />Exemplo: 99.9";
            }
            else{
                echo "Informe a altura em cent�metros. <br />Exemplo: 199";
            }
        }
    }

}


elseif($acao == "evento"){
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $datahora = $_POST['data'].' '.$_POST['hora'];

    if($_POST['operacao'] == "editar"){
        $status = $_POST['status'];

        $BFetch=$Crud->updateSPR("call spr_updateEvento(?,?,?,?,?)",array($Id,$status,$nome,$local,$datahora));
        $error = $BFetch->errorInfo();
        $errorMsg=$error['2'];

        $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

        if(isset($errorMsg)){
            echo $errorMsg;
        }else{
            echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
        //$BFetch=$Crud->updateDB("evento","status=?,nome=?,local=?,data=?","id = ?",array($status,$nome,$local,$datahora,$Id));

        //if($BFetch->rowCount() > 0){
        //    echo"Altera��o realizada com sucesso";
        //}else{
        //    echo"Altera��o n�o realizada";
        //}
    }else{
        $BFetch=$Crud->insertSPR("call spr_insertEvento(?,?,?)",array($nome,$local,$datahora));
        $error = $BFetch->errorInfo();
        $errorMsg=$error['2'];

        $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

        if(isset($errorMsg)){
            echo $errorMsg;
        }else{
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


elseif($acao == "categoria"){
    $nome = $_POST['nome'];
    $pesoMinimo = $_POST['pesoMin'];
    $pesoMaximo = $_POST['pesoMax'];

    if(is_numeric ($pesoMinimo) && is_numeric ($pesoMaximo) && $pesoMinimo < $pesoMaximo) {

        //VERIFICA SE A FAIXA DE PESO INFORMADA EST� LIVRE PARA SE CRIAR UMA NOVA CATEGORIA
        //SEM QUE HAJA CONFLITO NO LIMITE DE PESOS
        $validaCategoria = true;
        $BFetchValidaCategoria = $Crud->getDadosCategoria(0);
        while($FetchValidaCategoria = $BFetchValidaCategoria->fetch(PDO::FETCH_ASSOC)){
            if($Id != $FetchValidaCategoria['id']){
                if($pesoMinimo >= $FetchValidaCategoria['pesoMinimo'] && $pesoMinimo <= $FetchValidaCategoria['pesoMaximo']){
                    $validaCategoria = false;
                    $MsgValidaCategoria = "Erro:<br />O peso m�nimo informado, j� est� dentro de outra categoria";
                    break;
                }else{
                    if($pesoMaximo >= $FetchValidaCategoria['pesoMinimo'] && $pesoMaximo <= $FetchValidaCategoria['pesoMaximo']){
                        $validaCategoria = false;
                        $MsgValidaCategoria = "Erro:<br />O peso m�ximo informado, j� est� dentro de outra categoria";
                        break;
                    }
                }
            }
        }
        $BFetchValidaCategoria->closeCursor();

        //CATEGORIA PERMITIDA (SEM CONFLITO NOS LIMITES DE PESO)
        if($validaCategoria){
            if($_POST['operacao'] == "editar"){
                $BFetch=$Crud->updateSPR("call spr_updateCategoria(?,?,?,?)",array($Id,$nome,$pesoMinimo,$pesoMaximo));
                $error = $BFetch->errorInfo();
                $errorMsg=$error['2'];

                $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

                if(isset($errorMsg)){
                    echo $errorMsg;
                }else{
                    echo $Fetch['Msg'];
                }
                $BFetch->closecursor();
                //$BFetch=$Crud->updateDB("categoria","nome=?,pesoMinimo=?,pesoMaximo=?","id = ?",array($nome,$pesoMinimo,$pesoMaximo,$Id));

                //if($BFetch->rowCount() > 0){
                //    echo"Altera��o realizada com sucesso";
                //}else{
                //    echo"Altera��o n�o realizada";
                //}
            }
            else{
                $BFetch=$Crud->insertSPR("call spr_insertCategoria(?,?,?)",array($nome,$pesoMinimo,$pesoMaximo));
                $error = $BFetch->errorInfo();
                $errorMsg=$error['2'];

                $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

                if(isset($errorMsg)){
                    echo $errorMsg;
                }else{
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


        }
        //CATEGORIA INDEFERIDA (CONFLITO NOS LIMITES DE PESO)
        else{
            echo $MsgValidaCategoria;
        }

    }else {
        if(!is_numeric($pesoMinimo)) {
            echo "Informe o peso m�nimo para a categoria em quilos. <br />Exemplo: 99.99";
        }
        elseif(!is_numeric($pesoMaximo)) {
            echo "Informe o peso m�ximo para a categoria em quilos. <br />Exemplo: 99.99";
        }
        else{
            echo "O peso m�ximo deve ser maior que o peso m�nimo";
        }
    }
}


elseif($acao == "paises"){
    $nome = $_POST['nome'];
    $abreviatura = strtoupper ($_POST['abreviatura']);

    if($_POST['operacao'] == "editar"){
        $BFetch=$Crud->updateSPR("call spr_updatePaises(?,?,?)",array($Id,$nome,$abreviatura));
        $error = $BFetch->errorInfo();
        $errorMsg=$error['2'];

        $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

        if(isset($errorMsg)){
            echo $errorMsg;
        }else{
            echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
        //$BFetch=$Crud->updateDB("paises","nome=?,abreviatura=?","id = ?",array($nome,$abreviatura,$Id));

        //if($BFetch->rowCount() > 0){
        //    echo"Altera��o realizada com sucesso";
        //}else{
        //    echo"Altera��o n�o realizada";
        //}
    }else{
        $BFetch=$Crud->insertSPR("call spr_insertPaises(?,?)",array($nome,$abreviatura));
        $error = $BFetch->errorInfo();
        $errorMsg=$error['2'];

        $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

        if(isset($errorMsg)){
            echo $errorMsg;
        }else{
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


elseif($acao == "status"){
    $permissao = $_POST['permissao'];     //0=nao (false)
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    if($_POST['operacao'] == "editar"){
        //$BFetch=$Crud->insertDB("status","?,?,?,?",array(0,$permissao,$nome,$descricao));
        $BFetch=$Crud->updateSPR("call spr_updateStatus(?,?,?,?)",array($Id,$permissao,$nome,$descricao));
        $error = $BFetch->errorInfo();
        $errorMsg=$error['2'];

        $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

        if(isset($errorMsg)){
            echo $errorMsg;
        }else{
            echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
        //$BFetch=$Crud->updateDB("status","status=?,nomeStatus=?,descricao=?","id = ?",array($permissao,$nome,$descricao,$Id));
        ////UPDATE `status` SET `status` = '1', `nomeStatus` = 'n�o aprovadaa', `descricao` = 'Por motivos X, luta n�o foi aprovada' WHERE `status`.`id` = 6

        //if($BFetch->rowCount() > 0){
        //    echo"Altera��o realizada com sucesso";
        //}else{
        //    echo"Altera��o n�o realizada";
        //}
    }else{
        //$BFetch=$Crud->insertDB("status","?,?,?,?",array(0,$permissao,$nome,$descricao));
        $BFetch=$Crud->insertSPR("call spr_insertStatus(?,?)",array($nome,$descricao));
        $error = $BFetch->errorInfo();
        $errorMsg=$error['2'];

        $Fetch=$BFetch->fetch(PDO::FETCH_ASSOC);

        if(isset($errorMsg)){
            echo $errorMsg;
        }else{
            echo $Fetch['Msg'];
        }
        $BFetch->closecursor();
    }

}

*/
else {
  echo "A��o n�o informada";
}


?>
