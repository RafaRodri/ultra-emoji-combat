<?php

if (isset($_POST['id'])) {
  $Id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['id'])) {
  $Id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_POST['Id'])) {
  $Id = filter_input(INPUT_POST, 'Id', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['Id'])) {
  $Id = filter_input(INPUT_GET, 'Id', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $Id = 0;
}

if (isset($_POST['desafiado'])) {
  $desafiadoId = filter_input(INPUT_POST, 'desafiado', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['desafiado'])) {
  $desafiadoId = filter_input(INPUT_GET, 'desafiado', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $desafiadoId = 0;
}

if (isset($_POST['desafiante'])) {
  $desafianteId = filter_input(INPUT_POST, 'desafiante', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['desafiante'])) {
  $desafianteId = filter_input(INPUT_GET, 'desafiante', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $desafianteId = 0;
}

if (isset($_POST['eventoId'])) {
  $eventoId = filter_input(INPUT_POST, 'eventoId', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['eventoId'])) {
  $eventoId = filter_input(INPUT_GET, 'eventoId', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $eventoId = 0;
}

if (isset($_POST['link'])) {
  $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['link'])) {
  $link = filter_input(INPUT_GET, 'link', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_POST['Link'])) {
  $link = filter_input(INPUT_POST, 'Link', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['Link'])) {
  $link = filter_input(INPUT_GET, 'Link', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $link = "";
}

if (isset($_POST['acao'])) {
  $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['acao'])) {
  $acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_POST['Acao'])) {
  $acao = filter_input(INPUT_POST, 'Acao', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['Acao'])) {
  $acao = filter_input(INPUT_GET, 'Acao', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $acao = "";
}

if (isset($_POST['operacao'])) {
  $operacao = filter_input(INPUT_POST, 'operacao', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['operacao'])) {
  $operacao = filter_input(INPUT_GET, 'operacao', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_POST['Operacao'])) {
  $operacao = filter_input(INPUT_POST, 'Operacao', FILTER_SANITIZE_SPECIAL_CHARS);
} elseif (isset($_GET['Operacao'])) {
  $operacao = filter_input(INPUT_GET, 'Operacao', FILTER_SANITIZE_SPECIAL_CHARS);
} else {
  $operacao = "";
}

$statusLutas = isset($_GET['statusLutas']) ? $_GET['statusLutas'] : '';

$opcao = isset($_GET['opcao']) ? $_GET['opcao'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';

$motivo = isset($_GET['motivo']) ? $_GET['motivo'] : '';
$descricao = isset($_GET['descricao']) ? $_GET['descricao'] : '';
?>