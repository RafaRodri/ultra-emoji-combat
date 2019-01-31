<?php
//require_once("class/ClassConexao.php");
//require_once("{$_SERVER['DOCUMENT_ROOT']}/class/ClassConexao.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/conexao.php");
require_once("{$_SERVER['DOCUMENT_ROOT']}/estudo/UEC/class/paises.php");


class ClassCrud extends ClassConexao
{
  private $Crud;
  private $Contador;
  private $Conn;
  private $LastInsertID;

  public function preparedStatements($Query, $Parametros)
  {
    $this->countParametros($Parametros);
    $this->Crud = $this->Conn->prepare($Query);

    if ($this->Contador > 0) {
      for ($i = 1; $i <= $this->Contador; $i++) {
        $this->Crud->bindValue($i, $Parametros[$i - 1]);
      }
    }

    $this->Crud->execute();
    $this->LastInsertID = $this->Conn->lastInsertId();
  }

  private function countParametros($Parametros)
  {
    $this->Contador = count($Parametros);
  }


  public function __construct()
  {
    $this->Conn = $this->conectaDB();
  }

// CRUD Banco de dados
#Insert no Banco de Dados
  public function insertDB($Tabela, $Condicao, $Parametros)
  {
//insert into enquete values (0, 'Sim')
    $this->preparedStatements("insert into {$Tabela} values ({$Condicao})", $Parametros);
    return $this->Crud;
  }

  public function insertSPR($Query, $Parametros)
  {
    $this->preparedStatements($Query, $Parametros);
    return $this->Crud;
  }

#Select no Banco de Dados
  public function selectDB($Campos, $Tabela, $Condicao, $Parametros)
  {
    $this->preparedStatements("select {$Campos} from {$Tabela} {$Condicao}", $Parametros);
    return $this->Crud;
  }

  public function selectSPR($Query, $Parametros)
  {
    $this->preparedStatements($Query, $Parametros);
    return $this->Crud;
  }

  /*public function selectDBNovo ($teste, $Parametros){
  $this->preparedStatements($teste, $Parametros);
  return $this->Crud;
  }
  */

#Delete no Banco de Dados
  public function deleteDB($Tabela, $Condicao, $Parametros)
  {
//delete from cadastro where Id=?
    $this->preparedStatements("delete from {$Tabela} where {$Condicao}", $Parametros);
    return $this->Crud;
  }

  public function deleteSPR($Query, $Parametros)
  {
    $this->preparedStatements($Query, $Parametros);
    return $this->Crud;
  }

#Update no Banco de Dados
  public function updateDB($Tabela, $Set, $Condicao, $Parametros)
  {
//update cadastro set Nome=?,Sexo=?,Cidade=? where Id = ?
    $this->preparedStatements("update {$Tabela} set {$Set} where {$Condicao}", $Parametros);
    return $this->Crud;
  }

  public function updateSPR($Query, $Parametros)
  {
    $this->preparedStatements($Query, $Parametros);
    return $this->Crud;
  }

  public function getLastInsertID()
  {
    return $this->LastInsertID;
  }

  public function getIdade($data)
  {
//list($diaF, $mesF, $anoF) = explode('/', $dataFinal);
    list($ano, $mes, $dia) = explode('-', $data);


// Descobre que dia � hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

// Descobre a unix timestamp da data de nascimento
    $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);


// C�lculo idade
    return $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
  }



  /*public function getDadosLuta($id, $statusLuta){ // $id (0 todas | x luta especifica) e $statusLuta (0 todas | 1 somente lutas com status "aprovada")
  $CamposSelect = "l.id,l.evento as idEvento,e.nome as nomeEvento,p.nome as localEvento,s.status as aprovadoStatus,l.status as status,s.nomeStatus,s.descricao,e.data,l.categoria as idCategoria,cat.nome as categoria,l.rounds,d1.id as idDesafiante,d1.nome as nomeDesafiante,d1.sobrenome as sobrenomeDesafiante,d1.apelido as apelidoDesafiante,l1.apresentacao as apresentacaoDesafiante,p1.nome as paisDesafiante, d1.nascimento as nascDesafiante,d1.altura as alturaDesafiante, d1.peso as pesoDesafiante, l1.vitorias as vitDesafiante,l1.derrotas as derDesafiante, l1.empates as empDesafiante,d2.id as idDesafiado, d2.nome as nomeDesafiado,d2.sobrenome as sobrenomeDesafiado,d2.apelido as apelidoDesafiado,l2.apresentacao as apresentacaoDesafiado,p2.nome as paisDesafiado, d2.nascimento as nascDesafiado,d2.altura as alturaDesafiado, d2.peso as pesoDesafiado, l2.vitorias as vitDesafiado,l2.derrotas as derDesafiado, l2.empates as empDesafiado, l.resultado";
  $TabelasSelect = "luta l, status s, evento e, categoria cat, pessoa d1, pessoa d2, lutador l1, lutador l2, paises p1, paises p2,paises p";

  // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
  if($id == 0){
  // somente lutas com status "aprovada"
  if($statusLuta != 1){
  $CondicoesSelect = "l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id ORDER BY e.data, nomeEvento, localEvento, categoria";
  }
  // todas as lutas
  else{
  $CondicoesSelect = "s.status = 1 AND l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id ORDER BY e.data, nomeEvento, localEvento, categoria";
  }
  }
  // FILTRANDO UM REGISTRO ESPECIFICO POR ID
  else{
  $CondicoesSelect = "l.id = ? AND l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id";
  }

  return $this->selectDB($CamposSelect ,$TabelasSelect ,"where ".$CondicoesSelect,array($id));
  //select
  //    l.id,l.evento as idEvento,e.nome as nomeEvento,p.nome as localEvento,s.status as aprovadoStatus,l.status as status,s.nomeStatus,s.descricao,e.data,l.categoria as idCategoria,cat.nome as categoria,l.rounds,d1.id as idDesafiante,d1.nome as nomeDesafiante,d1.sobrenome as sobrenomeDesafiante,d1.apelido as apelidoDesafiante,l1.apresentacao as apresentacaoDesafiante,p1.nome as paisDesafiante, d1.nascimento as nascDesafiante,d1.altura as alturaDesafiante, d1.peso as pesoDesafiante, l1.vitorias as vitDesafiante,l1.derrotas as derDesafiante, l1.empates as empDesafiante,d2.id as idDesafiado, d2.nome as nomeDesafiado,d2.sobrenome as sobrenomeDesafiado,d2.apelido as apelidoDesafiado,l2.apresentacao as apresentacaoDesafiado,p2.nome as paisDesafiado, d2.nascimento as nascDesafiado,d2.altura as alturaDesafiado, d2.peso as pesoDesafiado, l2.vitorias as vitDesafiado,l2.derrotas as derDesafiado, l2.empates as empDesafiado, l.resultado
  //from
  //    luta l, status s, evento e, categoria cat, pessoa d1, pessoa d2, lutador l1, lutador l2, paises p1, paises p2,paises p
  //where
  //    s.status = 1 AND l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id ORDER BY e.data, nomeEvento, localEvento, categoria

  }
  */

  /*public function getDadosLutador($id){
  //$CamposSelect = "p.id,p.nome,p.sobrenome,p.apelido,l.apresentacao,p.nascimento,p.altura,p.peso,l.vitorias,l.derrotas,l.empates,paises.id as idNacionalidade,paises.nome as nacionalidade,paises.abreviatura,c.nome categoria,c.pesoMinimo as pesoMinCategoria,c.pesoMaximo as pesoMaxCategoria";
  $CamposSelect = "p.id,p.nome,p.sobrenome,p.apelido,l.apresentacao,p.nascimento,p.altura,p.peso,l.vitorias,l.derrotas,l.empates,pa.id as idNacionalidade,pa.nome as nacionalidade,pa.abreviatura,c.nome categoria,c.pesoMinimo as pesoMinCategoria,c.pesoMaximo as pesoMaxCategoria";
  //$TabelasSelect = "pessoa p, lutador l, paises, categoria c";
  $TabelasSelect = "pessoa p JOIN lutador l ON p.id = l.idPessoa JOIN paises pa ON p.nacionalidade = pa.id JOIN categoria c ON l.categoria = c.id ";
  if($id == 0){   // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "ORDER BY nome, sobrenome, vitorias, apelido,nacionalidade";
  }else{   // FILTRANDO UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "WHERE p.id = ?";
  }

  return $this->selectDB($CamposSelect ,$TabelasSelect ,$CondicoesSelect,array($id));
  }*/

  /*public function getDadosEvento($id){
  $CamposSelect = "e.id,s.status as aprovadoStatus,e.status,s.nomeStatus,s.descricao as descStatus,e.nome,e.local as idLocal,p.nome as local, p.abreviatura, e.data";
  $TabelasSelect = "evento e, status s, paises p";
  if($id == 0){   // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "WHERE e.status = s.id AND e.local = p.id ORDER BY data,nome,local";
  }else{   // FILTRANDO UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "WHERE e.id = ? AND e.status = s.id AND e.local = p.id";
  }

  return $this->selectDB($CamposSelect ,$TabelasSelect ,$CondicoesSelect,array($id));
  //select
  //    e.id,s.status,s.nomeStatus,s.descricao as descStatus,e.nome,p.nome as local, p.abreviatura, e.data
  //from
  //    evento e, status s, paises p
  //    where e.id = ? AND e.status = s.id AND e.local = p.id ORDER BY data,nome,local

  }*/

  /*public function getDadosCategoria($id){
  $CamposSelect = "*";
  $TabelasSelect = "categoria";
  if($id == 0){   // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "ORDER BY pesoMinimo";
  }else{   // FILTRANDO UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "WHERE id=?";
  }

  return $this->selectDB($CamposSelect ,$TabelasSelect ,$CondicoesSelect,array($id));
  }*/

  /*public function getDadosPaises($id){
  $CamposSelect = "*";
  $TabelasSelect = "paises";
  if($id == 0){   // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "ORDER BY nome";
  }else{   // FILTRANDO UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "WHERE id=?";
  }

  return $this->selectDB($CamposSelect ,$TabelasSelect ,$CondicoesSelect,array($id));
  }*/

  /*public function getDadosStatus($id){
  $CamposSelect = "*";
  $TabelasSelect = "status";
  if($id == 0){   // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "ORDER BY nomeStatus, descricao";
  }
  else{   // FILTRANDO UM REGISTRO ESPECIFICO POR ID
  $CondicoesSelect = "WHERE id=?";
  }

  return $this->selectDB($CamposSelect ,$TabelasSelect ,$CondicoesSelect,array($id));
  }*/

  /*public function ganharLuta($idLutador,$idLuta){
  $Fetch = $this->getVitorias($idLutador);

  $numVitorias = $Fetch['vitorias'];
  $numVitorias++;

  $this->updateDB("lutador","vitorias=?","id_pessoa=?",array($numVitorias,$idLutador));
  $this->updateDB("luta","resultado=?","id=?",array($idLutador,$idLuta));

  return $Fetch['apresentacao'];
  }
  public function getVitorias($idLutador){
  $BFetch = $this->selectDB("vitorias,apresentacao","lutador","where id_pessoa=?",array($idLutador));
  return $BFetch->fetch(PDO::FETCH_ASSOC);
  }

  public function perderLuta($idLutador){
  $numDerrotas = $this->getDerrotas($idLutador);
  $numDerrotas++;
  $this->updateDB("lutador","derrotas=?","id_pessoa=?",array($numDerrotas,$idLutador));
  }
  public function getDerrotas($idLutador){
  $BFetch = $this->selectDB("derrotas","lutador","where id_pessoa=?",array($idLutador));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  return $Fetch[derrotas];
  }

  public function empatarLuta($idLutador){
  $numEmpates = $this->getEmpates($idLutador);
  $numEmpates++;
  $this->updateDB("lutador","empates=?","id_pessoa=?",array($numEmpates,$idLutador));
  }
  public function getEmpates($idLutador){
  $BFetch = $this->selectDB("empates","lutador","where id_pessoa=?",array($idLutador));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  return $Fetch[empates];
  }

  public function encerrarLuta($idLuta){
  $BFetch = $this->selectDB("id","status","where nomeStatus=?",array("encerrada"));
  $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
  $novoStatus = $Fetch['id'];

  $this->updateDB("luta","status=?","id=?",array($novoStatus,$idLuta));
  }*/


//PARA A VERSAO UEC2_0
  /*2_0 OK*/
//public function getDadosLutaHome(){
//    $Select = "CALL spr_getDadosLuta(?,?,?)";

//    return $this->selectSPR($Select,array(0,1,1));
//}

  /*2_0 OK*/
  public function getDadosLuta($id, $statusLuta, $ifHome)
  { // $id (0 todas | x luta especifica) e $statusLuta (0 todas | 1 somente lutas com status "aprovada")
    $Select = "CALL spr_getDadosLuta(?,?,?)";

//// SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
//if($id == 0){
//    // somente lutas com status "aprovada"
//    if($statusLuta != 1){
//        $CondicoesSelect = "l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id ORDER BY e.data, nomeEvento, localEvento, categoria";
//    }
//    // todas as lutas
//    else{
//        $CondicoesSelect = "s.status = 1 AND l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id ORDER BY e.data, nomeEvento, localEvento, categoria";
//    }
//}
//// FILTRANDO UM REGISTRO ESPECIFICO POR ID
//else{
//    $CondicoesSelect = "l.id = ? AND l.status = s.id AND l.evento = e.id AND e.local = p.id AND l.categoria = cat.id AND l.desafiante = d1.id AND l.desafiado = d2.id AND d1.id = l1.id_pessoa AND d2.id = l2.id_pessoa AND d1.nacionalidade = p1.id AND d2.nacionalidade = p2.id";
//}

    return $this->selectSPR($Select, array($id, $statusLuta, $ifHome));
  }

  /* POSS�VEL EXCLUS�O */
//public function getDadosLutaNovo($id, $statusLuta){ // $id (0 todas | x luta especifica) e $statusLuta (0 todas | 1 somente lutas com status "aprovada")
//    $CamposSelect = "l.id,l.rounds,s.id AS status,s.status AS aprovadoStatus,s.nomeStatus,s.descricao,e.id AS idEvento,e.nome AS nomeEvento,e.data,p.nome AS localEvento,p.abreviatura AS pais,c.id AS idCategoria,c.nome AS categoria,c.pesoMinimo,c.pesoMaximo";
//    $TabelasSelect = "luta l JOIN status s ON l.status = s.id JOIN evento e ON l.evento = e.id JOIN categoria c ON l.categoria = c.id JOIN paises p ON e.local = p.id";

//    // SEM FILTRAR UM REGISTRO ESPECIFICO POR ID
//    if($id == 0){
//        // somente lutas com status "aprovada"
//        if($statusLuta != 1){
//            $CondicoesSelect = "";
//        }
//        // todas as lutas
//        else{
//            $CondicoesSelect = "";
//        }
//    }
//    // FILTRANDO UM REGISTRO ESPECIFICO POR ID
//    else{
//        $CondicoesSelect = "l.id = ?";
//    }


//    //$this->Conn->beginTransaction();

//    //    $select[0] = $this->selectDB("select l.id,l.rounds,s.id AS status,s.status AS aprovadoStatus,s.nomeStatus,s.descricao,e.id AS idEvento,e.nome AS nomeEvento,e.data,p.nome AS localEvento,p.abreviatura AS pais,c.id AS idCategoria,c.nome AS categoria,c.pesoMinimo,c.pesoMaximo from luta l JOIN status s ON l.status = s.id JOIN evento e ON l.evento = e.id JOIN categoria c ON l.categoria = c.id JOIN paises p ON e.local = p.id where l.id = ?",array($id));
//    //    $select[0]->execute();
//    //    if($select[0]->rowCount() == 0){
//    //        die("Erro ocorrido nas informa��es da luta.");
//    //    }
//    //    $select[1] = $this->selectDB("SELECT d1.idPessoa AS idDesafiante, p1.nome AS nomeDesafiante,p1.sobrenome AS sobrenomeDesafiante,p1.apelido AS apelidoDesafiante,p1.nascimento AS nascDesafiante,p1.altura AS alturaDesafiante,p1.peso AS pesoDesafiante,l1.apresentacao AS apresentacaoDesafiante, l1.vitorias AS vitDesafiante, l1.derrotas AS derDesafiante,l1.empates AS empDesafiante,pa1.nome AS paisDesafiante, pa1.abreviatura FROM luta_desafiante d1 JOIN pessoa p1 ON d1.idPessoa = p1.id JOIN lutador l1 ON d1.idPessoa = l1.idPessoa JOIN paises pa1 ON p1.nacionalidade = pa1.id WHERE idLuta = ?",array($id));
//    //    $select[1]->execute();
//    //    if($select[1]->rowCount() == 0){
//    //        $this->Conn->rollBack();
//    //        die("Erro ocorrido nas informa��es do desafiante.");
//    //    }
//    //    $select[2] = $this->selectDB("SELECT d2.idPessoa AS idDesafiado,p2.nome AS nomeDesafiado,p2.sobrenome AS sobrenomeDesafiado,p2.apelido AS apelidoDesafiado,p2.nascimento AS nascDesafiado,p2.altura AS alturaDesafiado,p2.peso AS pesoDesafiado,l2.apresentacao AS apresentacaoDesafiado, l2.vitorias AS vitDesafiado, l2.derrotas AS derDesafiado, l2.empates AS empDesafiado,pa2.nome AS paisDesafiado, pa2.abreviatura FROM luta_desafiado d2 JOIN pessoa p2 ON d2.idPessoa = p2.id JOIN lutador l2 ON d2.idPessoa = l2.idPessoa JOIN paises pa2 ON p2.nacionalidade = pa2.id WHERE idLuta = ?",array($id));
//    //    $select[2]->execute();
//    //    if($select[2]->rowCount() == 0){
//    //        $this->Conn->rollBack();
//    //        die("Erro ocorrido nas informa��es do desafiado.");
//    //    }


//    //$this->Conn->commit();

//    //$select[3] = $this->selectDB("SELECT idPessoa AS resultado FROM luta_vencedor WHERE idLuta = ?",array($id));
//    //$select[3]->execute();


//    //return $select;

//    return $this->selectDB("select l.id,l.rounds,s.id AS status,s.status AS aprovadoStatus,s.nomeStatus,s.descricao,e.id AS idEvento,e.nome AS nomeEvento,e.data,p.nome AS localEvento,p.abreviatura AS pais,c.id AS idCategoria,c.nome AS categoria,c.pesoMinimo,c.pesoMaximo from luta l JOIN status s ON l.status = s.id JOIN evento e ON l.evento = e.id JOIN categoria c ON l.categoria = c.id JOIN paises p ON e.local = p.id where l.id = ?;",
//                                array($id));
//}

  /* POSS�VEL EXCLUS�O */
//public function getDadosVencedor($idLuta){
//    return $this->selectDB("*","pessoa","WHERE id=?",array($idLuta));
//}

  /*2_0 OK*/
  public function getDadosLutador($id)
  {
    $Select = "CALL spr_getDadosLutador(?)";

    return $this->selectSPR($Select, array($id));
  }

  /*2_0 OK*/
  public function getDadosEvento($id)
  {
    $Select = "CALL spr_getDadosEvento(?)";

    return $this->selectSPR($Select, array($id));
  }

  /*2_0 OK*/
  public function getDadosCategoria($id)
  {
    $Select = "CALL spr_getDadosCategoria(?)";

    return $this->selectSPR($Select, array($id));
  }

///*2_0 OK*/
//public function getDadosPaises($id){
//$Select = "CALL spr_getDadosPaises(?)";

//return $this->selectSPR($Select,array($id));
//}

  /*2_1 OK*/
  public function getDadosPaises()
  {
    $url = 'http://restcountries.eu/rest/v2/all?fields=name;alpha3Code;numericCode';
    $json = file_get_contents($url, true);
    $data = json_decode($json);

    $func = function ($item) {
      $pais = new ClassPaises();
      $pais->alpha3Code = $item->alpha3Code;
      $pais->id = (property_exists($item, 'numericCode')) ? intval($item->numericCode) : null;
      $pais->nome = $item->name;
      return $pais;
    };

    return (array_map($func, $data));

  }

  /*2_1 OK*/
  public function getDadosPais($alpha)
  {
    $url = 'http://restcountries.eu/rest/v2/alpha/' . $alpha . '?fields=name';
    $json = file_get_contents($url, true);
    $data = json_decode($json);

    return $data->name;
  }

  /*2_0 OK*/
  public function getDadosStatus($id)
  {
    $Select = "CALL spr_getDadosStatus(?)";

    return $this->selectSPR($Select, array($id));
  }

  /*2_0 OK*/
  public function finalizarLuta($id, $idVencedor, $idPerdedor, $ifEmpate)
  {
//$ifEmpate     = 0-EMPATE | 1-TEVE VENCEDOR
    $Select = "CALL spr_finalizarLuta(?,?,?,?)";

    $BFetch = $this->selectSPR($Select, array($id, $idVencedor, $idPerdedor, $ifEmpate));

    $Fetch = $BFetch->fetch(PDO::FETCH_ASSOC);
    return $Fetch['apresentacao'];
  }


}


