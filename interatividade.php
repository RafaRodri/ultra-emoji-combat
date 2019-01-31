<?php
//require_once("include/variaveis.php");
//require_once("class/crud.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();

if (!empty($opcao)) {
  switch ($opcao) {
    case 'categoria':
      {
        $BuscaLutador = $Crud->selectSPR("call spr_getLutadoresCategoria(?)", array($valor));
        echo json_encode($BuscaLutador->fetchAll(PDO::FETCH_ASSOC));
        $BuscaLutador->closeCursor();
        break;
      }
  }
}
?>
