<?php
header('Content-Type: text/html; charset=utf8');
?>
<!DOCTYPE html>
<html>
<head>
  <title>UEC - Ultra Emoji Combat</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="foundation-icons/foundation-icons.css">


  <meta name="viewport" content="width=device-width">
</head>

<body>
  <div id="tudo">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand font-weight-bold" href="index.php">UEC - Ultra Emoji Combat</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropLutador" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Lutador
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropLutador">
              <a class="dropdown-item" href="buscar.php?link=lutador">Atletas</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="cadastro.php?link=lutador">Cadastrar</a>
              <a class="dropdown-item" href="consulta.php?link=lutador">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropLuta" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Luta
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropLuta">
              <!--<a class="dropdown-item" href="agendar.php">Agendar luta</a>-->
              <a class="dropdown-item" href="cadastro.php?link=luta">Agendar luta</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="consulta.php?link=luta">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropEvento" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Evento
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropEvento">
              <a class="dropdown-item" href="cadastro.php?link=evento">Cadastrar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="consulta.php?link=evento">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropCategoria" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Categoria
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropCategoria">
              <a class="dropdown-item" href="cadastro.php?link=categoria">Cadastrar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="consulta.php?link=categoria">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropPaises" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Paises
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropPaises">
              <a class="dropdown-item disabled" href="cadastro.php?link=paises">Cadastrar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="consulta.php?link=paises">Consultar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropStatus" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">Status
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropStatus">
              <a class="dropdown-item" href="cadastro.php?link=status">Cadastrar</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="consulta.php?link=status">Consultar</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div id="corpo">
      <div class="container my-3">

        <!--<div class="info-form d-none"></div>
        <div id="resultado" class="info-form-delete d-none"></div>-->
        <div id="resultado" class="info-form d-none"></div>
        