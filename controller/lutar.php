<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/include/variaveis.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/crud.php");

$Crud = new ClassCrud();

$eventoId;
$desafiadoId;
$desafianteId;
$vencedor = rand(1, 20);


//call spr_finalizarLuta(3,33,34,1);


if ($vencedor < 2) {
  $apresentacao = $Crud->finalizarLuta($eventoId, $desafianteId, $desafiadoId, 0);
  //$Crud->empatarLuta($desafiadoId);
  //$Crud->empatarLuta($desafianteId);
  //echo"Empatou";
} elseif ($vencedor < 8) {
  $apresentacao = $Crud->finalizarLuta($eventoId, $desafianteId, $desafiadoId, 1);
  //$Crud->perderLuta($desafiadoId);
  //$apresentacao = $Crud->ganharLuta($desafianteId, $eventoId);
  //echo $apresentacao;
} else {
  $apresentacao = $Crud->finalizarLuta($eventoId, $desafiadoId, $desafianteId, 1);
  //$apresentacao = $Crud->ganharLuta($desafiadoId, $eventoId);
  //$Crud->perderLuta($desafianteId);
  //echo $apresentacao;
}

echo $apresentacao;
?>
