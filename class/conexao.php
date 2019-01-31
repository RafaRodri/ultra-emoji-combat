<?php

abstract class ClassConexao
{
  //Realizará a conexão com o banco de dados
  protected function conectaDB()
  {
    try {
      //$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
      $Con = new PDO("mysql:host=localhost;dbname=ultra-emoji", "root", "102030");//, $opcoes
      return $Con;
    } catch (PDOException $Erro) {
      return $Erro->getMessage();
    }
  }
}