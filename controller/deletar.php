<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();

$msg = "N�o foi poss�vel executar a remo��o solicitada";


if ($link == "lutador") {
  $BFetch = $Crud->deleteSPR("call spr_deleteLutador(?)", array($Id));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  if ($BFetch->rowCount() > 0) {
    $msg = $Fetch['Msg'];
  }
  $BFetch->closeCursor();

} elseif ($link == "luta") {
  $BFetch = $Crud->deleteSPR("call spr_deleteLuta(?)", array($Id));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  if ($BFetch->rowCount() > 0) {
    $msg = $Fetch['Msg'];
  }
  $BFetch->closeCursor();

} elseif ($link == "evento") {
  $BFetch = $Crud->deleteSPR("call spr_deleteEvento(?)", array($Id));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  if ($BFetch->rowCount() > 0) {
    $msg = $Fetch['Msg'];
  }
  $BFetch->closeCursor();

} elseif ($link == "categoria") {
  $BFetch = $Crud->deleteSPR("call spr_deleteCategoria(?)", array($Id));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  if ($BFetch->rowCount() > 0) {
    $msg = $Fetch['Msg'];
  }
  $BFetch->closeCursor();


} elseif ($link == "paises") {
  $BFetch = $Crud->deleteSPR("call spr_deletePaises(?)", array($Id));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  if ($BFetch->rowCount() > 0) {
    $msg = $Fetch['Msg'];
  }
  $BFetch->closeCursor();


} elseif ($link == "status") {
  $BFetch = $Crud->deleteSPR("call spr_deleteStatus(?)", array($Id));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  if ($BFetch->rowCount() > 0) {
    $msg = $Fetch['Msg'];
  }
  $BFetch->closeCursor();
  //$BFetch = $Crud->deleteDB("status","id =?", array($Id));
  //if($BFetch->rowCount() > 0){
  //    $msg = 'O "status" selecionado, foi removido com sucesso.';
  //}
} else {

}
echo $msg;
?>
